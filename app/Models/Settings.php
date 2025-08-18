<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'site_name',
        'site_logo',
        'contact_email',
        'contact_phone',
        'contact_address',
        'about',
    ];
}
