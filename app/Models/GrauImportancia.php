<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrauImportancia extends Model
{
    protected $fillable = ['nome'];

     public function tarefas()
    {
        return $this->hasMany(\App\Models\Tarefa::class, 'grau_importancia_id', 'id');
    }
}
