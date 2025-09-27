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
    <!-- Barra de navegação -->
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
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <main class="max-w-7xl mx-auto py-8 px-4">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
            <p class="text-gray-600">Gerencie seus clientes e tarefas de forma eficiente</p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card Clientes -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Gestão de Clientes</h2>
                    </div>
                    <p class="text-gray-600 mb-6">Gerencie todas as informações dos seus clientes em um só lugar. Adicione, edite e visualize dados importantes.</p>
                    <div class="flex justify-between items-center">
                        <a href="/cliente" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center">
                            <i class="fas fa-arrow-right mr-2"></i>Acessar Clientes
                        </a>
                    </div>
                </div>
                <div class="bg-blue-50 px-6 py-3 border-t border-blue-100">
                    <div class="flex justify-between text-sm text-blue-700">
                        <span><i class="fas fa-database mr-1"></i>Total: 127 clientes</span>
                        <span><i class="fas fa-sync-alt mr-1"></i>Atualizado hoje</span>
                    </div>
                </div>
            </div>

            <!-- Card Tarefas -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-tasks text-green-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Gestão de Tarefas</h2>
                    </div>
                    <p class="text-gray-600 mb-6">Organize suas atividades, defina prazos e acompanhe o progresso das suas tarefas de forma eficiente.</p>
                    <div class="flex justify-between items-center">
                        <a href="/tarefa" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center">
                            <i class="fas fa-arrow-right mr-2"></i>Acessar Tarefas
                        </a>
                    </div>
                </div>
                <div class="bg-green-50 px-6 py-3 border-t border-green-100">
                    <div class="flex justify-between text-sm text-green-700">
                        <span><i class="fas fa-list-check mr-1"></i>Total: 42 tarefas</span>
                        <span><i class="fas fa-clock mr-1"></i>5 pendentes</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>Sistema de Gestão &copy; 2023 - Desenvolvido com Laravel</p>
        </div>
    </footer>
</body>
</html>