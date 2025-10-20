<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Aluno</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #4A90FF, #6D5DFB, #9B51E0);
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 240px;
            background-color: #4A3FFC;
            color: #F3F4F6;
            display: flex;
            flex-direction: column;
            padding: 2rem 1rem;
        }
        .sidebar h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }
        .sidebar a {
            display: block;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            background-color: rgba(255,255,255,0.1);
            color: #F3F4F6;
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-align: center;
            transition: background 0.3s, transform 0.2s;
        }
        .sidebar a:hover {
            background-color: rgba(255,255,255,0.25);
            transform: translateX(5px);
        }
        .content {
            flex: 1;
            padding: 3rem;
            color: #fff;
        }
        .card {
            background: #fff;
            color: #333;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h1>FitWay</h1>
        <nav>
            <a href="#">Início</a>
            <a href="#">Meus Treinos</a>
            <a href="#">Perfil</a>
            <a href="#">Configurações</a>
        </nav>
    </div>

    <div class="content">
        <h1 class="text-4xl font-bold mb-4">Área do Aluno</h1>
        <p class="text-lg mb-8">Bem-vindo ao seu painel de controle.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="card">Área de conteúdo</div>
            <div class="card">Área de conteúdo</div>
            <div class="card">Área de conteúdo</div>
        </div>
    </div>

</body>
</html>
