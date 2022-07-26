<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','cantidad','codigo','almacen_id','categoria_id','actividad_id'];

    public function categoria(){
        return $this->belongsTo(categoria::class);
    }

    public function almacen(){
        return $this->belongsTo(almacen::class);
    }

    /* relacion muchos a muchos */
    /* public function actividades(){
        return $this->belongsToMany(actividad::class);
    } */

    /* relacion unoa muchos con actividades */
    public function actividad(){
        return $this->belongsTo(actividad::class);
    }
}