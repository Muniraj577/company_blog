<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ["name", "designation", "description", "image", "status", "fb_link",
    "twitter_link", "insta_link", "linkedin_link"];

    public function getImg($img)
    {
        if($img != null && $img != "default.png"){
            return asset("images/team/".$img);
        }
        return asset("images/default.png");
    }
}
