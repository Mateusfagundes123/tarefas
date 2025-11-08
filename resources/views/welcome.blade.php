@extends('base')

@section('titulo', 'Dashboard')

@section('conteudo')
<main class="max-w-7xl mx-auto py-8 px-4">
    <div class="text-center mb-12">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- CARD 1 --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-3 rounded-full mr-4">
                        <i class="fas fa-folder text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Gestão de Projetos</h2>
                </div>
                <div class="flex justify-between items-center">
                    <a href="/projetos" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-arrow-right mr-2"></i>Acessar
                    </a>
                    <a href="/projetos/create" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i>Novo
                    </a>
                </div>
            </div>
        </div>

        {{-- CARD 2 --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Gestão de Clientes</h2>
                </div>
                <div class="flex justify-between items-center">
                    <a href="/cliente" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-arrow-right mr-2"></i>Acessar
                    </a>
                    <a href="/cliente/create" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i>Novo
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
