<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GrauImportancia; // importa o model

class GrauImportanciaSeeder extends Seeder
{
    public function run()
    {
        GrauImportancia::create(['nome' => 'Baixa']);
        GrauImportancia::create(['nome' => 'Média']);
        GrauImportancia::create(['nome' => 'Alta']);
    }
}
