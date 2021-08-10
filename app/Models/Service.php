<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ["service_category_id", "title", "slug", "description", "logo", "status"];

    public function category()
    {
        return $this->belongsTo("App\Models\ServiceCategory", "service_category_id", "id");
    }

    public function getLogo($img)
    {
        if($img != null && $img != "default.png"){
            return asset("images/services/".$img);
        }
        return asset("images/default.png");
    }
}
