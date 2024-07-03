<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Facades\App\Http\Repositories\LogUserRepository;
use App\Http\Requests\LogUser\LogUserRequest;
use App\Http\Resources\Backend\LogUserResource;
use App\Models\LogUser;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class LogUserController extends Controller
{
    public function index()
    {
        $log_users = LogUserRepository::paginate(20);
        return Inertia::render('Views/log-user/index', [
           'log_users' => LogUserResource::collection($log_users),
           'title' =>  request('trash') ? 'Trash' : 'Log User',
           'trash' => request('trash') ?  true : false,
           'breadcumb' => [
             [
                 'text' => 'Dashboard',
                 'url' => route('dashboard'),
             ],
             [
                 'text' => 'Log User',
                 'url' => route('log-user.index')
             ],
           ],
         ]);
    }

    public function show(LogUser $log_user)
    {
        return Inertia::render('Views/log-user/show', [
           'log_user' => LogUserResource::make($log_user),
           'title' =>  request('trash') ? 'Trash' : 'Log User',
           'trash' => request('trash') ?  true : false,
           'breadcumb' => [
             [
                 'text' => 'Dashboard',
                 'url' => route('dashboard'),
             ],
             [
                 'text' => 'Log User',
                 'url' => route('log-user.index')
             ],
           ],
         ]);
    }

    /**
    * create view
    */
    public function create()
    {
        $log_user = new LogUser;
        return Inertia::render('Views/log-user/form', [
            'log_user' => $log_user,
            'method' => 'store',
            'title' => 'Create' ,
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Log User',
                    'url' => route('log-user.index')
                ],
                [
                    'text' => 'Create Log User',
                    'url' => route('log-user.create')
                ],
            ],
        ]);
    }

    /**
    * store data
    */
    public function store(LogUserRequest $request, LogUser $log_user)
    {
        $log_user = LogUser::create($request->all());

        Cache::tags(['log_users'])->flush();
        return redirect()->route('log-user.index')->with('message', 'Log User has been created');
    }

    /**
    * Edit view
    */
    public function edit(LogUser $log_user)
    {
        return Inertia::render('Views/log-user/form', [
            'log_user' => $log_user,
            'method' => 'update',
            'title' => 'Edit City',
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Log User',
                    'url' => route('log-user.index')
                ],
                [
                    'text' => 'Edit Log User',
                    'url' => route('log-user.edit',['city'=> $log_user->id])
                ],
            ],
        ]);
    }

    /**
    * Update Data
    */
    public function update(LogUserRequest $request, LogUser $log_user)
    {
        $log_user->update($request->all());
        Cache::tags(['log_users'])->flush();
        return redirect()->back()->with('message', 'Log User has been updated');
    }

    /**
    * Remove the specified resource from storage temporary.
    */
    public function delete($log_user)
    {
        $log_user = LogUser::find($log_user);
        if(!$log_user){
            return abort(404);
        }
        $log_user->delete();

        Cache::tags(['log_users'])->flush();
        return redirect()->back()->with('message', 'Log User hase been deleted');
    }

    /**
     * Remove data permanently
     */
    public function destroy($log_user)
    {
        $log_user = LogUser::withTrashed()->find($log_user);
        if(!$log_user){
            return abort(404);
        }
        $log_user->forceDelete();

        Cache::tags(['log_users'])->flush();
        return redirect()->back()->with('message', 'Log User hase been destroyed');
    }

    public function destroyAll()
    {
        $ids = explode(',',request('selected'));
        $log_users = LogUser::whereIn('_id',$ids)->withTrashed()->get();
        foreach ($log_users as $log_user) {
            $log_user->forceDelete();
        }
        Cache::tags(['log_users'])->flush();
        return redirect()->back()->with('message', 'Log User hase been destroyed');
    }

    /**
     * Restore Data from trash
     */
    public function restore($log_user)
    {
        $log_user = LogUser::withTrashed()->find($log_user);
        if(!$log_user){
            return abort(404);
        }
        $log_user->restore();
        Cache::tags(['log_users'])->flush();
        return redirect()->back()->with('message', 'Log User hase been restored');
    }
}
