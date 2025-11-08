<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - SIG - ACAD</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- TailwindCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="bg-gray-100">

    {{-- NAVBAR --}}
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-white text-xl font-bold">
                        <i class="fas fa-tachometer-alt mr-2"></i>Sistema de Gestão ADM
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</a>
                    <a href="/cliente" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">Clientes</a>
                    <a href="/tarefa" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">Tarefas</a>
                    <a href="/projetos" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">Projetos</a>
                    <a href="/documentos" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">Documentos</a>
                    <a href="/reunioes" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">Reuniões</a>
                    <a href="{{ route('dashboard') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">
    <i class="fas fa-chart-line mr-1"></i> Dashboard
</a>


                </div>
            </div>
        </div>
    </nav>

    {{-- CONTEÚDO DAS PÁGINAS FILHAS --}}
    <div class="container mt-4">
        @yield('conteudo')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
