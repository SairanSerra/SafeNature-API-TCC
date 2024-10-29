<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disasters extends Model
{
    use HasFactory;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'occurencyDisasters';

    protected $fillable = [
        'id',
        'longitude',
        'latitude',
        'idCobrade',
        'city',
        'state'
    ];

    public function cobrade(){
        return $this->hasOne(Cobrade::class, 'cobrade', 'idCobrade');
    }

}
