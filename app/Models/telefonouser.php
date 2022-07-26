<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class telefonouser extends Model
{
    use HasFactory;

    protected $fillable = ['numero','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
