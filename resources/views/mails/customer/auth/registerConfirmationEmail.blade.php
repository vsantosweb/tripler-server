<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Tripler</h3>
    <hr />
    <p>
        Olá, <strong>{{ $customer->name }}</strong><br />

        Você criou uma conta na Tripler usando o endereço de e-mail {{ $customer->email }}.
        Clique no botão abaixo para confirmar seu cadastro.

    </p>
    <a style="background:#7c00ff; 
    padding: .8em;
    color:#fff;
    display: inline-block;
    border-radius:6px;" target="_blank" href={{ $link }}>Verificar minha conta</a>
</body>

</html>
