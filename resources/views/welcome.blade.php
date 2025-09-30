<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-white text-xl font-bold">
                        <i class="fas fa-tachometer-alt mr-2"></i>Sistema de Gestão
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/cliente" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                        <i class="fas fa-users mr-1"></i>Clientes
                    </a>
                    <a href="/tarefa" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                        <i class="fas fa-tasks mr-1"></i>Tarefas
                    </a>
                    <a href="/tarefa" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                        <i class="fas fa-tasks mr-1"></i>Projetos
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-8 px-4">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
            <p class="text-gray-600">Gerencie seus clientes e tarefas de forma eficiente</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Gestão de Projetos</h2>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/projetos" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center">
                            <i class="fas fa-arrow-right mr-2"></i>Acessar Projetos
                        </a>
                        <a href="/projetos/create" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center">
                            <i class="fas fa-arrow-right mr-2"></i>criar Projetos
                        </a>
                    </div>
                </div>
                
            </div>


            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Gestão de Clientes</h2>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/cliente" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center">
                            <i class="fas fa-arrow-right mr-2"></i>Acessar Clientes
                        </a>
                        <a href="/cliente/create" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center">
                            <i class="fas fa-arrow-right mr-2"></i>Registrar Clientes
                        </a>
                    </div>
                </div>

            </div>


            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-tasks text-green-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Gestão de Tarefas</h2>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/tarefa" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center">
                            <i class="fas fa-arrow-right mr-2"></i>Acessar Tarefas
                        </a>
                        <a href="/tarefa/create" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center">
                            <i class="fas fa-arrow-right mr-2"></i>Criar Tarefas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>