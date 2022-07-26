<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actividad extends Model
{
    use HasFactory;

    protected $fillable = ['inicio','fin','foto','estado','servicio_id'];

    public function servicio(){
        return $this->hasOne(servicio::class);
    }

    /* relacion muchos a muchos */
    /* public function productos(){
        return $this->belongsToMany(producto::class);
    } */

    /* relacion uno a muchos con producto */
    public function productos(){
        return $this->hasMany(producto::class);
    }
}
