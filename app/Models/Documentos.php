<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_arquivo',
        'tipo',
        'tamanho',
        'caminho_arquivo',
        'descricao',
        'projeto_id',
        'cliente_id',
    ];

    // Relacionamentos opcionais
    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
