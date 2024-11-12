<?php

use App\Http\Resources\Backend\MediaResource;
use App\Models\LogAdmin;
use App\Models\LogUser;
use App\Models\Media;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function filterString($filtername)
{
	if(request('sort') == 'asc'){
		return $filtername.'&sort=desc';
	}
	return $filtername.'&sort=asc';
}

function limitWord($str, $limit)
{
	$word = Str::words($str, $limit, '...');
	return $word;
}


function uniquecode($model,$field,$length = 10)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersNumber = strlen($characters);
    $codeLength = $length;

    $code = '';

    while (strlen($code) < $codeLength) {
        $position = rand(0, $charactersNumber - 1);
        $character = $characters[$position];
        $code = $code.$character;
    }

    if ($model::where($field, $code)->exists()) {
       uniquecode($model,$field);
    }

	return $code;
}


function getImage($image)
{
	if($image){
		$image = json_decode($image)[0] ?? null;
		// $image =  $image ?  url('/storage'.$image->path) : null;
		$image =  $image ? env('S3_URL') . '/' . $image->url : null;
		return $image;
	}
	return asset('/images/default.png');
}

function currentUrl($number)
{
	$currentpage = request()->segment($number);
	return $currentpage;
}
function get_client_ip()
{
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if (isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if (isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if (isset($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

function readCSV($csvFile, $array)
{
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle)) {
		$line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
	}
	fclose($file_handle);
	return $line_of_text;
}


function toTitle($str){
	return ucfirst(str_replace('-', ' ', $str));
}


function type()
{
	$type = request('type');
	$arrTypes = pageTypes();

	if (is_null($type)) {
		return false;
	}
	if(in_array($type,$arrTypes)){

		return $type;
	}
	return abort(404);
}

function redeemType()
{
	$type = request('type');
	$arrTypes = redeemTypes();

	if (is_null($type)) {
		return false;
	}
	if(in_array($type,$arrTypes)){

		return $type;
	}
	return abort(404);
}

function languages($key)
{
    if($key == 'meta') {
        return [
            'en' => [
                'title' => null,
                'image' => null,
                'description' => null,
            ],
            'id' => [
                'title' => null,
                'image' => null,
                'description' => null,
            ],
            'sc' => [
                'title' => null,
                'image' => null,
                'description' => null,
            ],
        ];
    }
	return [
		'en' => null,
		'id' => null,
		'sc' => null,
	];
}

function translate($model,$key)
{
	return empty($model->getTranslations($key)) ? languages($key) : $model->getTranslations($key);
}

function pageTypes()
{
	return [
		'menu','home','blog','static','component','main-menu','footer-menu','faq','how-to','event','quiz'
	];
}

function redeemTypes()
{
	return [
		'redeem', 'order'
	];
}

function vueFormExist($name,$folder,$default = 'form'){
    $file = base_path().'/resources/js/Admin/Views/'.$folder.'/'.$name.'.vue';
    if(!file_exists($file)){
        return $folder.'/'.$default;
    }
	return $folder.'/'.$name;
}


function uploadLocal($request ,$folder='user', $user= null)
{
    try {
        $files = $request->file;
        $medias=[];
        foreach ($files as $key => $file) {
            $date = Carbon::now()->format('dmY-his');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            if (!is_dir(storage_path('/app/public/uploads/' . $folder))) {
               $folder_full  = storage_path('/app/public/uploads/' . $folder);
               if (!is_dir($folder_full)) mkdir($folder_full, 0777, true);
            }
            $path = storage_path('/app/public/uploads/' . $folder);

            $download =  $folder . '/';
            $media = new Media();
            if($user!=''){
                $media->user_id = $user->id;
                $mitra = $user->mitras->first();
                $media->mitra_id = $mitra->id ?? null;
            }
            $media->extension = $extension;
            $media->folder    = $folder;
            $media->name      = str_replace($extension, '', $fileName) ;
            $media->size      = $fileSize;
            $media->filename  = $fileName;
            $media->save();

            $destinationPath = $path;
            $original        = $media->slug . '-' . $date . '.' . $media->extension;
            $file->move($destinationPath, $original);
            Cache::tags(['medias'])->flush();

            $filePath = '/uploads/'.$download . $original;
            $media->filename  = $original;
            $media->path = $filePath;
            $media->url = env('ASSET_URL').$filePath;
            $media->update();
            $medias[] = MediaResource::make($media)->resolve();
        }
        $return['status'] = true;
        $return['data'] =  $medias;
        $return['message'] = 'succses';
        return $return;
    } catch (Exception $e) {

        $return['status'] = false;
        $return['data'] =  [];
        $return['message'] = $e->getMessage();
        return $return;
    }

}

function uploadS3($request ,$folder='user', $user= null)
{
    try {
        $files = $request->file;
        $medias=[];
        foreach ($files as $key => $file) {
            $date = Carbon::now()->format('dmY-his');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            if (!is_dir(storage_path('/app/public/uploads/' . $folder))) {
               $folder_full  = storage_path('/app/public/uploads/' . $folder);
               if (!is_dir($folder_full)) mkdir($folder_full, 0777, true);
            }
            $path = storage_path('/app/public/uploads/' . $folder);

            $download =  $folder . '/';
            $media = new Media();
            if($user!=''){
                $media->user_id = $user->id;
                $mitra = $user->mitras->first();
                $media->mitra_id = $mitra->id ?? null;
            }
            $media->extension = $extension;
            $media->folder    = $folder;
            $media->name      = str_replace($extension, '', $fileName) ;
            $media->size      = $fileSize;
            $media->filename  = $fileName;
            $media->save();

            $destinationPath = $path;
            $original        = $media->slug . '-' . $date . '.' . $media->extension;
            Storage::disk('public')->put(env('APP_URL') . '/uploads/' . $download . $original, file_get_contents($file));
            Cache::tags(['medias'])->flush();

            $filePath = '/uploads/'.$download . $original;
            $media->filename  = $original;
            $media->path = $filePath;
            $media->url = env('APP_URL') . $filePath;
            $media->update();
            $medias[] = MediaResource::make($media)->resolve();
        }
        $return['status'] = true;
        $return['data'] =  $medias;
        $return['message'] = 'succses';
        return $return;
    } catch (Exception $e) {

        $return['status'] = false;
        $return['data'] =  [];
        $return['message'] = $e->getMessage();
        return $return;
    }
}

function getLoginDateAdmin()
{
	$log = LogAdmin::where('admin_id', Auth::guard('admin')->user()->id ?? null)->where('action', 'Login')->whereNull('logout_at')->latest('created_at')->first();
	return !is_null($log) ? $log->login_at : Carbon::now();
}

function createLogAdmin($module = null, $action = null, $subject = null, $module_changes = [], $logout_at = null)
{
    $log = [];
    $log['admin_id'] = Auth::guard('admin')->user()->id ?? null;
    $log['ip_address'] = get_client_ip();
    $log['module'] = $module;
    $log['action'] = $action;
    $log['subject'] = $subject;
    $log['method'] = Request::method();
    $log['module_changes'] = json_encode($module_changes);
    $log['url'] = Request::fullUrl();
    $log['agent'] = Request::header('user-agent');
    $log['login_at'] = getLoginDateAdmin();
    $log['logout_at'] = $logout_at;

    LogAdmin::create($log);
    Cache::tags(['log_admins'])->flush();
}

function createLogUser($user_id = null, $module = null, $action = null, $activity = null, $module_changes = [])
{
    $log = [];
    $log['user_id'] = $user_id;
    $log['ip_address'] = get_client_ip();
    $log['module'] = $module;
    $log['action'] = $action;
    $log['activity'] = $activity;
    $log['method'] = Request::method();
    $log['module_changes'] = json_encode($module_changes);
    $log['url'] = Request::fullUrl();
    $log['agent'] = Request::header('user-agent');

    LogUser::create($log);
    Cache::tags(['log_users'])->flush();
}

function uniquePassport($model,$field)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersNumber = strlen($characters);
    $codeLength = 12;

    $code = '';

    while (strlen($code) < $codeLength) {
        $position = rand(0, $charactersNumber - 1);
        $character = $characters[$position];
        $code = $code.$character;
    }

    $code = strtoupper('Z-'.$code);

    if ($model::where($field, $code)->exists()) {
        uniquePassport($model,$field);
    }

	return $code;
}
