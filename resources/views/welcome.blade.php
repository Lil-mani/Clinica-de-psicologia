<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            background-color: #f8fafc;
            color: #636b6f;
            font-weight: 100;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #474a59; /* Cor de fundo atualizada */
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: white; /* Cor do texto atualizada */
        }
        .navbar .logo .psi {
            color: #89ffdb; /* Cor específica para a palavra Psi */
        }
        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .navbar ul li {
            margin: 0 15px;
        }
        .navbar ul li a {
            text-decoration: none;
            color: #ffffff;
            font-weight: 600;
        }
        .navbar .login-button {
            padding: 8px 20px;
            background-color: #636b6f;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Instituto <span class="psi">Psi</span></div>
        <ul>
            <li><a href="#sobre-nos">Sobre Nós</a></li>
            <li><a href="#depoimentos">Depoimentos</a></li>
            <li><a href="#servicos">Serviços</a></li>
            <li><a href="#contato">Contato</a></li>
        </ul>
        <a href="{{ route('login') }}" class="login-button">Login</a>
    </div>
    <div class="content">
        <div class="title">
            Você está na Página Principal
        </div>
    </div>
</body>
</html>
