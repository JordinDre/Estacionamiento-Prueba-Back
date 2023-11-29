<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estancia extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'estancias';

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];

    public function vehiculo(): HasOne
    {
        return $this->hasOne(Vehiculo::class, 'id', 'vehiculo_id');
    }
}
