<?php

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

function pageTypes()
{
	return [
		'menu','home', 'static','component',
	];
}

function reactFormExist($name,$folder,$default = 'form'){
    $file = base_path().'/resources/js/Pages/Views/'.$folder.'/'.$name.'.jsx';
    if(!file_exists($file)){
        return $folder.'/'.$default;
    }
	return $folder.'/'.$name;
}

function toTitle($str){
	return ucfirst(str_replace('-', ' ', $str));
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