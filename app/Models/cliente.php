<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','apellidos','ci','correo'];

    public function telefonos(){
        return $this->hasMany(telefonocliente::class);
    }

    public function servicios(){
        return $this->hasMany(cliente::class);
    }
}
