<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdatePointRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\Backend\PointHistoryResource;
use App\Http\Resources\Backend\UserResource;
use App\Models\GroupParty;
use App\Models\Member;
use App\Models\PointHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Facades\App\Http\Repositories\UserRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        if(request('trash')==1){
            $users = UserRepository::paginateTrash(20);
        }else{
            $users = UserRepository::paginate(20);
        }
        return Inertia::render('Views/user/index', [
            'users' => UserResource::collection($users),
            'title' => request('trash') ? 'Trash' : 'Users ',
            // 'count_trash' =>  UserRepository::countTrash(),
            'trash' => request('trash') ? true : false,
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => '/backend'
                ],
                [
                    'text' => 'Users',
                    'url' => '/backend/user'
                ],
            ],
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('Views/user/show', [
            'user' => UserResource::make($user),
            'title' =>  request('trash') ? 'Trash' : 'User',
            'trash' => request('trash') ?  true : false,
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Users',
                    'url' => route('user.index')
                ],
            ],
        ]);
    }

    public function edit(User $user)
    {
        return Inertia::render('Views/user/form', [
            'user' => UserResource::make($user),
            'title' => 'Edit User',
            'method' => 'update',
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Users',
                    'url' => route('user.index')
                ],
            ],
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $cidb_profile = $this->cidbProfile($user);

        if (count($cidb_profile['data']->Phone)) {
            $data['phone_id'] = $cidb_profile['data']->Phone[0]->PhoneID;
        } else {
            $data['phone_id'] = null;
        }

        if (count($cidb_profile['data']->Address)) {
            $data['address_id'] = $cidb_profile['data']->Address[0]->AddressID;
        } else {
            $data['address_id'] = null;
        }

        $cidb_update = $this->cidbUpdate($data, $user);

        if ($cidb_update['success']) {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->dob = $request->dob;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->update();

            // createLogUser('User', 'Update', $user->first_name . ' has updated the profile', $user->getChanges());
            Cache::tags(['users'])->flush();

            return redirect()->back()->with('message', toTitle($user->first_name . ' hase been updated!'));
        } else {
            return redirect()->back()->with('message', toTitle($user->first_name . ' fail to updated!'));
        }
    }

    /**
    * Remove the specified resource from storage temporary.
    */
    public function delete($user)
    {
        $user = User::find($user);
        $user->delete();

        Cache::tags(['users'])->flush();
        return redirect()->back()->with('message', toTitle($user->name . ' hase been deleted'));
    }

    /**
     * Remove data permanently
     */
    public function destroy($user)
    {
        $user = User::withTrashed()->find($user);
        $user->forceDelete();

        Cache::tags(['users'])->flush();
        return redirect()->back()->with('message', toTitle($user->name. ' hase been destroyed'));
    }

    public function destroyAll()
    {
    $ids = explode(',',request('selected'));
    $users = User::whereIn('id',$ids)->withTrashed()->get();
    foreach ($users as $user) {
        $user->forceDelete();
    }
    Cache::tags(['users'])->flush();
    return redirect()->back()->with('message', toTitle($user->name) . ' has been destroyed');
    }

    /**
     * Restore Data from trash
     */
    public function restore($user)
    {
    $user = User::withTrashed()->find($user);
    $user->restore();
    Cache::tags(['users'])->flush();
    return redirect()->back()->with('message', toTitle($user->name) . ' has been restored');
    }

    public function pointHistory(User $user)
    {
        $histories = PointHistory::latest('created_at')->where('user_id', $user->id)->paginate(20);
        return Inertia::render('Views/user/point-history', [
            'histories' => PointHistoryResource::collection($histories),
            'title' =>  request('trash') ? 'Trash' : $user->first_name . ' ' . $user->last_name,
            'trash' => request('trash') ?  true : false,
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Users',
                    'url' => route('user.index')
                ],
                [
                    'text' => $user->first_name . ' ' . $user->last_name,
                    'url' => route('user.pointHistory', [$user])
                ],
            ],
        ]);
    }

    public function updateStatusVerification($id, Request $request)
    {
        $user = User::find($id);
        $user->agree = $request->verification ? true : false;
        $user->agree_ktp = $request->verification ? true : false;
        $user->update();

        Cache::tags(['users'])->flush();
        return redirect()->back()->with('message', toTitle($user->first_name) . ' has been update user verification');
    }

    public function updatePoint(UserUpdatePointRequest $request, User $user)
    {
        $history = new PointHistory();
        $history->user_id = $user->id;
        $history->type = $request->option;
        $history->point = (int)$request->point;
        $history->last_point = $user->point;
        $history->message = $request->message;
        $history->save();

        if ($request->option == 'increment') {
            $user->increment('point',(int)$request->point);
        } else {
            $user->decrement('point',(int)$request->point);
        }

        $member = Member::where('user_id', $user->id)->first();
        if (!is_null($member)) {
            $party = GroupParty::find($member->group_party_id);
            if ($request->option == 'increment') {
                $party->increment('point', (int) $request->point);
            } else {
                $party->decrement('point', (int) $request->point);
            }
        }

        $history->current_point = $user->point;
        $history->update();

        $history_type = $history->type == 'increment' ? 'added' : 'reduced';
        $admin = auth()->guard('admin')->user()->name;

        createLogAdmin('User', 'Update Point', "{$admin} has {$history_type} {$history->point} points to {$user->first_name} {$user->last_name}" ?? null, $history->getChanges());

        Cache::tags(['point_histories', 'users'])->flush();
        return redirect()->route('user.index')->with('message', $user->first_name . ' point ' . $request->option . ' successfully.');
    }

    /**
     * Export data
     */
    public function export()
    {
        $start_date = request('start_date') ? Carbon::parse(request('start_date')) : null;
        $end_date = request('end_date') ? Carbon::parse(request('end_date'))->endOfDay() : null;
        
        $users = User::query();
        
        if (!is_null($start_date) && !is_null($end_date)) {
            $users  = $users->where(function($query) use ($start_date, $end_date) {
                $query->where('created_at','>=', $start_date)
                ->where('created_at','<=', $end_date);
            });
        } else if (!is_null($start_date) && is_null($end_date)) {
            $users  = $users->where('created_at','>=', $start_date);
        } else if (is_null($start_date) && !is_null($end_date)) {
            $users = $users->where('created_at','<=', $end_date);
        }

        $users  = $users->get();
        $fileName = 'User Data - Guinness ID ('. Carbon::now()->format('d F Y H:i:s') .').xlsx';

        return Excel::download(new UserExport($users, $start_date, $end_date), $fileName);
    }

    private function cidbUpdate($request, $user)
    {
        $base_url = env('CIDB_URL') . '/' . env('CIDB_APP_ID') . '/' . env('CIDB_VERSION_ID') . '/consumers';
        $security_token = base64_encode(env('CIDB_SECURITY_TOKEN'));
        // $auth_token = base64_encode($request['email'] . ':' . $request['password'] . ':' . env('CIDB_PROMO_CODE'));
        $auth_token = base64_encode($request['email'] . ':' . env('CIDB_PROMO_CODE'));
        $headers = [
            'Proxy-Authorization' => 'Basic ' . $security_token,
            'Authorization' => 'Basic ' . $auth_token
        ];

        if (!is_null($request['phone'])) {
            if (isset($request['phone_id'])) {
                $phone = [
                    [
                        'PhoneID' => $request['phone_id'],
                        'PhoneNumber' => $request['phone'],
                        'PhoneType' => 1,
                        'ModifyFlag' => "U",
                    ]
                ];
            } else {
                $phone = [
                    [
                        'PhoneNumber' => $request['phone'],
                        'PhoneType' => 1,
                        'ModifyFlag' => "I",
                    ]
                ];
            }
        } else {
            $phone = [
                [
                    'PhoneID' => $request['phone_id'],
                    'PhoneNumber' => $request['phone'],
                    'PhoneType' => 1,
                    'ModifyFlag' => "D",
                ]
            ];
        }

        if (!is_null($request['address'])) {
            if (isset($request['address_id'])) {
                $address = [
                    [
                        'AddressID' => $request['address_id'],
                        'Address1' => $request['address'],
                        'Country' => 'ID',
                        'AddressType' => 1,
                        'ModifyFlag' => "U",
                    ]
                ];
            } else {
                $address = [
                    [
                        'Address1' => $request['address'],
                        'Country' => 'ID',
                        'AddressType' => 1,
                        'ModifyFlag' => "I",
                    ]
                ];
            }
        } else {
            $address = [
                [
                    'AddressID' => $request['address_id'],
                    'Address1' => $request['address'],
                    'Country' => 'ID',
                    'AddressType' => 1,
                    'ModifyFlag' => "D",
                ]
            ];
        }

        // Consumer Profile Data
        $body['ConsumerProfile']['FirstName'] = $request['first_name'];
        $body['ConsumerProfile']['LastName'] = $request['last_name'];
        $body['ConsumerProfile']['DOB'] = Carbon::parse($request['dob'])->format('Y-m-d');
        $body['ConsumerProfile']['Phone'] = $phone;
        $body['ConsumerProfile']['Address'] = $address;
        $body['ConsumerProfile']['PromoCode'] = [env('CIDB_PROMO_CODE')];
        $body['ConsumerProfile']['Emails'] = [
            [
                'EmailId' => $user->email,
                'EmailCategory' => 1,
                'IsDefaultFlag' => 1,
                'ModifyFlag' => "U"
            ]
        ];

        $body['WebsiteUrl'] = env('CIDB_WEBSITE_URL');
        $body['AliasConsumerID'] = (int)$user->consumer_id;

        $http_client = new Client([
            'headers' => $headers,
            'verify' => false
        ]);

        try {
            // Get Consumer ID
            $response = $http_client->put($base_url, [
                'content-type' => 'application/json',
                'body' => json_encode($body)
            ]);

            $response_status = $response->getStatusCode();

            if ($response_status == 200) {
                $return['success'] = true;
                return $return;
            } else {
                $return['success'] = false;
                $return['errors'] = ['password' => ['Update profil gagal, coba lagi']];
                return $return;
            }
        } catch (ClientException $e) {
            $err_response = $e->getResponse();
            $err_response_body = json_decode($err_response->getBody()->getContents());

            $err_status = $err_response->getStatusCode();
            $err_message = $err_response_body->errdoList[0]->errMessage;
            $err_code = $err_response_body->errdoList[0]->errCode;

            $return['success'] = false;
            $return['errors'] = ['password' => [$err_message]];

            return $return;
        }
    }

    public function cidbProfile($user)
    {
        $security_token = base64_encode(env('CIDB_SECURITY_TOKEN'));
        $base_url = env('CIDB_URL') . '/' . env('CIDB_APP_ID') . '/' . env('CIDB_VERSION_ID') . '/consumers/profile';

        $headers = [
            'Proxy-Authorization' => 'Basic ' . $security_token,
        ];

        $data['WebsiteUrl'] = env('CIDB_WEBSITE_URL');
        $data['AliasConsumerID'] = (int)$user->consumer_id;

        $http_client = new Client([
            'headers' => $headers,
            'verify' => false
        ]);

        try {
            // Get Consumer Profile
            $response = $http_client->post($base_url, [
                'content-type' => 'application/json',
                'body' => json_encode($data)
            ]);

            $response_data = json_decode($response->getBody()->getContents());

            $return['success'] = true;
            $return['data'] = $response_data->ConsumerProfile;

            return $return;
        } catch (ClientException $e) {
            $err_response = $e->getResponse();
            $err_response_body = json_decode($err_response->getBody()->getContents());

            $err_status = $err_response->getStatusCode();
            $err_message = $err_response_body->errdoList[0]->errMessage;

            $return['success'] = true;
            $return['errors'] = $err_message;

            return $return;
        }
    }
}
