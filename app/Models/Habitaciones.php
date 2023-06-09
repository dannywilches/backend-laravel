<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitaciones extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_hotel',
        'num_habs',
        'tipo_hab',
        'acomodacion',
        'created_at',
        'updated_at',
    ];

    public function getHotel(){
        return $this->belongsTo(Hoteles::class, 'id_hotel', 'id');
    }
}
