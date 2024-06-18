<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Concluído - Psi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #474a59;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
            color: #474a59;
            text-align: left;
        }
        .content h1 {
            color: #474a59;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content p {
            color: #474a59;
            line-height: 1.6;
        }
        .highlight {
            color: #89ffdb;
        }
        .footer {
            text-align: center;
            padding: 10px 20px;
            font-size: 12px;
            color: #666;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Cadastro concluído no Instituto <span class="highlight">Psi</span></h1>
        </div>
        <div class="content">
            <h1>Olá, {{$name}}!</h1>
            <p>Seu cadastro foi finalizado com sucesso! Abaixo estão seus dados de acesso:</p>
            <p><strong>Email:</strong> {{$email}}</p>
            <p><strong>Senha:</strong> {{$password}}</p>
            <p>Guarde essas informações em segurança. Você pode utilizar seu email e senha para acessar nosso sistema a qualquer momento.</p>
            <p>Se você tiver qualquer dúvida, não hesite em nos contatar. Estamos aqui para ajudar!</p>
            <p>Atenciosamente,<br>Equipe <span class="highlight">Psi</span></p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Psi. Todos os direitos reservados.</p>
            <p>Para mais informações, visite nosso site ou entre em contato conosco.</p>
        </div>
    </div>
</body>
</html>
