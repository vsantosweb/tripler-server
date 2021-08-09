<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<style>
    body {
        font-family: 'nunito'
    }
</style>

<body>
    <div style="max-width: 540px; margin: auto">
        <h2>Olá, {{ $tripOrder->customer->name}}</h2>
        <h3>
            Seu pedido foi efetuado com sucesso, em breve lhe daremos novas intruções.
        </h3>
        <p>
            Número do pedido: <strong> {{ $tripOrder->code }} </strong> <br />
            Status: <strong>{{ $tripOrder->status->name }} </strong>
        </p>
        <h4> Seu pacote </h4>
        <strong> {{ $tripOrder->trip_name }} </strong>
        <p> {{ $tripOrder->trip_package->description }} </p>
        <hr />
        @foreach($tripOrder->passengers as $passenger)
        <p>
            {{$passenger->name}}<br />
            Passageiro : <strong> {{$passenger->fullName}} </strong> <br />
            <h4>Pacotes Adicionais</h4>
            @foreach($passenger->additionalPackages as $additionalPackage)
            <p>
                <h3> {{$additionalPackage->name}} </h3>
                <p>
                    {{$additionalPackage->description}}
                </p>
                <strong> {{$additionalPackage->amount}} </strong>
            </p>
            @endforeach
            <h4>SubTotal: {{$passenger->totalAmount}}</h4> <br />

            <hr />

        </p>
        @endforeach
        <h3> Total do pedido: {{  money_format('%.2n', $tripOrder->total_amount)}} </h3>
    </div>
</body>

</html>
