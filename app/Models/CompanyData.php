<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'company_address', 'company_phone',
    'company_phone1', 'company_logo', 'company_slogan', 'company_email'];

    public function companyImage($img)
    {
        if($img != null){
            return asset('images/general/'.$img);
        } else {
            return asset('images/default.png');
        }
    }
}
