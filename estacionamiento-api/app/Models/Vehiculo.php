<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehiculo extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'vehiculos';

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];

    public function tipo_vehiculo(): HasOne
    {
        return $this->hasOne(TipoVehiculo::class, 'id', 'tipo_vehiculo_id');
    }
    
}
