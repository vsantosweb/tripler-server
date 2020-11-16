<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Olá, {{ $tripOrder->customer->name}}</h2>
    <h3>
        Sua compra do pedido {{ $tripOrder->code }} foi aprovado
    </h3>
</body>
</html>
