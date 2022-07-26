<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promocion extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descuento','inicio','fin'];

    public function planes(){
        return $this->hasMany(plan::class);
    }
}
