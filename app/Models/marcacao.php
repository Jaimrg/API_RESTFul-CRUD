<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcacao extends Model
{
    protected $table = 'marcacao';
    protected $fillable = ['id_aluno','estado','id_educadora','data_marcacao','tipo_marcacao'];
}
