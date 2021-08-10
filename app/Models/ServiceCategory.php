<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = ["title", "slug", "status"];

    public function services()
    {
        return $this->hasMany("App\Models\Service", "service_category_id", "id");
    }
}
