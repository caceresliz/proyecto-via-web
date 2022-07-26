<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion','tarifa','promocion_id'];

    public function servicio(){
        return $this->hasOne(servicio::class);
    }

    public function promocion(){
        return $this->belongsTo(promocion::class);
    }
}
