<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'telefone',
        'imagem',
        'categoria_id'
    ];

    // public function categoria()
    // {
    //     return $this->belongsTo(CategoriaAluno::class, 'categoria_id');
    // }
}
