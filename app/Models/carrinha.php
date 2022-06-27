<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrinha extends Model
{
    use HasFactory;
    protected $table = 'carrinha';
    protected $fillable = [
        'matricula', 'marca', 'modelo','id_motorista','id_educadora'
    ];
}
