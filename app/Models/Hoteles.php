<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoteles extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'nit',
        'num_habs',
        'created_at',
        'updated_at',
    ];

    public function getHabitaciones() {
        return $this->hasMany(Habitaciones::class, 'id_hotel', 'id');
    }
}
