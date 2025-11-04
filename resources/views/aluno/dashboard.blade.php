<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FitWay - Área do Aluno</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body { font-family: 'Roboto', sans-serif; background-color: #f4f6fa; margin:0; }
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
        <a href="#" id="btnPerfil" class="px-6 py-3 mx-4 my-2 rounded-lg hover:bg-white/20 transition-all duration-200 cursor-pointer text-lg font-medium">Perfil</a>
        <a href="#" id="btnTreinos" class="px-6 py-3 mx-4 my-2 rounded-lg hover:bg-white/20 transition-all duration-200 cursor-pointer text-lg font-medium">Meus Treinos</a>
    </nav>
</div>


<div class="flex-1 p-8 overflow-auto">
    
    <div id="perfilPage" class="fade">
        <div class="text-2xl font-semibold mb-6 text-indigo-700">Perfil do Aluno</div>

        <div class="flex flex-col items-center md:flex-row md:items-start md:space-x-8 mb-8">
            <div class="w-32 h-32 rounded-full bg-gray-400 flex items-center justify-center mb-4 md:mb-0 shadow-lg">
                <span class="text-white text-3xl font-bold">A</span>
            </div>
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Nome do Aluno</h2>
                <p class="text-gray-500 italic mb-2"></p>
                <span class="inline-block mt-2 px-4 py-1 rounded-full bg-green-500 text-white font-medium">Ativo</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-lg font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">Informações Pessoais</h3>
                <p><span class="font-medium text-gray-600">Idade:</span> -</p>
                <p><span class="font-medium text-gray-600">Sexo:</span> -</p>
                <p><span class="font-medium text-gray-600">Data de Matrícula:</span> -</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-lg font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">Informações Físicas</h3>
                <p><span class="font-medium text-gray-600">Altura:</span> -</p>
                <p><span class="font-medium text-gray-600">Peso:</span> -</p>
                <p><span class="font-medium text-gray-600">IMC:</span> -</p>
                <p><span class="font-medium text-gray-600">Gordura Corporal:</span> -</p>
            </div>
        </div>
    </div>

    
    <div id="treinosPage" class="hidden fade">
        <div class="text-2xl font-semibold mb-6 text-indigo-700">Meus Treinos</div>
        <div class="space-y-6">
            <script>
                const dias = ['Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira'];
                for(let dia of dias){
                    document.write(`<div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300 overflow-x-auto">
                        <h3 class="text-lg font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">${dia}</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Área do Corpo</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Exercício</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Repetições</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Descanso</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 text-gray-800"></td>
                                    <td class="px-6 py-4 text-gray-800"></td>
                                    <td class="px-6 py-4 text-gray-800"></td>
                                    <td class="px-6 py-4 text-gray-800"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>`);
                }
            </script>
        </div>
    </div>

</div>

<script>
const perfilPage = document.getElementById('perfilPage');
const treinosPage = document.getElementById('treinosPage');
const btnPerfil = document.getElementById('btnPerfil');
const btnTreinos = document.getElementById('btnTreinos');

function showPage(page){
    perfilPage.classList.add('hidden');
    treinosPage.classList.add('hidden');
    page.classList.remove('hidden');
    page.classList.add('fade');
}

btnPerfil.onclick = e => { e.preventDefault(); showPage(perfilPage); };
btnTreinos.onclick = e => { e.preventDefault(); showPage(treinosPage); };

showPage(perfilPage);
</script>

</body>
</html>
