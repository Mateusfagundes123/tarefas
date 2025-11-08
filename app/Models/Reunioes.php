<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reunioes extends Model
{
    use HasFactory;


    protected $table = 'reunioes';


    protected $fillable = [
        'nome',
        'data',
        'hora',
        'imagem',
    ];
}
