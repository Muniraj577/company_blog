<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    public static function image($request, $file, $path, $oldimage = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image = $request->$file;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        if ($oldimage != null && file_exists($path . $oldimage) && $oldimage != "default.png") {
            unlink($path . $oldimage);
        }
        if ($request->isMethod("PUT") || $request->isMethod("PATCH")) {
            $image->move($path, $imageName);
            return $imageName;
        }

        return [
            "image" => $image,
            "imageName" => $imageName,
        ];
    }
}
