<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $table = "tarefas";

    protected $fillable = [
        'titulo',
        'descricao',
        'dataentrega',
    ];

    public function grauImportancia()
{
    return $this->belongsTo(\App\Models\GrauImportancia::class, 'grau_importancia_id');}
}
