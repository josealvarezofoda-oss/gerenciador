<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FitWay - Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body { font-family: 'Roboto', sans-serif; background: #f4f6fa; }
.fade { animation: fade 0.4s ease-in-out; }
@keyframes fade { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }
</style>
</head>
<body class="flex min-h-screen">

<div class="w-64 bg-gradient-to-b from-indigo-600 to-purple-600 text-white flex flex-col shadow-lg">
    <div class="text-center py-8 border-b border-white/20">
        <h1 class="text-3xl font-bold tracking-wide">FitWay</h1>
    </div>
    <nav class="flex flex-col mt-6">
        <a id="btnPerfilAdmin" class="px-6 py-3 mx-4 my-2 rounded-lg hover:bg-white/20 transition-all duration-200 cursor-pointer text-lg font-medium">Perfil do Admin</a>
        <a id="btnEditar" class="px-6 py-3 mx-4 my-2 rounded-lg hover:bg-white/20 transition-all duration-200 cursor-pointer text-lg font-medium">Cadastrar</a>
        <a id="btnGerenciar" class="px-6 py-3 mx-4 my-2 rounded-lg hover:bg-white/20 transition-all duration-200 cursor-pointer text-lg font-medium">Gerenciar</a>
    </nav>
</div>

<div class="flex-1 p-8 overflow-auto">
    <div id="perfilAdminPage" class="fade">
        <div class="text-2xl font-semibold mb-6 text-indigo-700">Perfil do Admin</div>
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6 hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-bold text-gray-800 mb-2"></h2>
            <p class="text-gray-600"></p>
        </div>
    </div>

    <div id="editarPage" class="hidden fade">
        <div class="text-2xl font-semibold mb-6 text-indigo-700">Editar Aluno e Treinos</div>
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6 hover:shadow-xl transition-shadow duration-300">
            <h3 class="text-lg font-semibold border-b border-gray-200 pb-2 mb-2 text-gray-700">Registrar Aluno</h3>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-all duration-200">Cadastrar</button>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6 hover:shadow-xl transition-shadow duration-300">
            <h3 class="text-lg font-semibold border-b border-gray-200 pb-2 mb-2 text-gray-700">Registrar Treino</h3>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-all duration-200">Cadastrar</button>
        </div>
    </div>

    <div id="gerenciarPage" class="hidden fade">
        <div class="text-2xl font-semibold mb-6 text-indigo-700">Gerenciar Aluno e Treinos</div>
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6 hover:shadow-xl transition-shadow duration-300 overflow-x-auto">
            <h3 class="text-lg font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">Gerenciar Alunos</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Idade</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">Exemplo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition-all duration-200">Editar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 mb-6 hover:shadow-xl transition-shadow duration-300 overflow-x-auto">
            <h3 class="text-lg font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">Gerenciar Treinos</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Treino</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Aluno</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">Treino A</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">Exemplo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition-all duration-200">Editar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
const pages = {
    perfilAdmin: document.getElementById('perfilAdminPage'),
    editar: document.getElementById('editarPage'),
    gerenciar: document.getElementById('gerenciarPage')
};

document.getElementById('btnPerfilAdmin').onclick = e => { e.preventDefault(); showPage(pages.perfilAdmin); };
document.getElementById('btnEditar').onclick = e => { e.preventDefault(); showPage(pages.editar); };
document.getElementById('btnGerenciar').onclick = e => { e.preventDefault(); showPage(pages.gerenciar); };

function showPage(page){
    for(let key in pages){ pages[key].classList.add('hidden'); }
    page.classList.remove('hidden');
    page.classList.add('fade');
}

showPage(pages.perfilAdmin);
</script>

</body>
</html>
