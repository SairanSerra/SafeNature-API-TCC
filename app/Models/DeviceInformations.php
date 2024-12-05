<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceInformations extends Model
{
    use HasFactory;

    protected $table = 'deviceInformations';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $fillable = [
        'deviceId',
        'latitude',
        'longitude'
    ];
}
