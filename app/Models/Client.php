<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ["client_category_id", "logo", "url", "status"];

    public function category()
    {
        return $this->belongsTo("App\Models\ClientCategory", "client_category_id", "id");
    }

    public function getLogo($img){
        if($img != null && $img != "default.png"){
            return asset("images/client/".$img);
        }
        return asset("images/default.png");
    }
}
