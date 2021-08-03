<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if(!function_exists("getSlug")){
    function getSlug($title){
        return Str::slug($title);
    }
}

if(!function_exists('getUser')){
    function getUser()
    {
        return Auth::user();
    }
}

if (!function_exists('notify')) {
    function notify($type, $msg)
    {
        return array(
            'alert-type' => $type,
            'message' => $msg,
        );
    }
}

if (!function_exists('FileUnlink')) {
    function FileUnlink($path, $file)
    {
        if ($file != null && file_exists($path . $file) && $file != 'default.png') {
            return unlink($path . $file);
        }
    }
}

if(!function_exists('moveFile')){
    function moveFile($file, $path, $fileName){
        return $file->move($path, $fileName);
    }
}
