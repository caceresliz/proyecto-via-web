<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viatico extends Model
{
    use HasFactory;

    protected $fillable =['monto','fecha','razon','user_id'];

    /* relacion uno a muchos inversa */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
