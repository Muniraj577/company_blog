<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = ["description", "image", "status"];

    public function getImg($img){
        if($img != null && $img != "default.png"){
            return asset("images/about/".$img);
        }
        return asset("images/default.png");
    }
}
