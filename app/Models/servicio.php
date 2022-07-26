<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    use HasFactory;

    protected $fillable = ['direccion','codigo','tipo','estado','plan_id','user_id','cliente_id'];

    public function actividad(){
        return $this->belongsTo(servicio::class);
    }

    public function plan(){
        return $this->belongsTo(plan::class);
    }

    public function cliente(){
        return $this->belongsTo(servicio::class);
    }

    /* relacion muchos a muchos  */
    /* public function users(){
        return $this->belongsToMany(User::class);
    } */

    /* relacion uno a muchos */
    public function tecnico(){
        return $this->belongsTo(User::class);
    }

}
