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

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision);
        // return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

