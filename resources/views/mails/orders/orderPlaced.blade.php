<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title>Reserva Efetuada</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<style type="text/css">
 
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

  </style>

<body>
    <div style="max-width: 540px; margin: auto">
        <h1>
            Recebemos sua reserva.
        </h1>
        <h2>Olá, {{ $order->customer->name }}</h2>
        <p>
            Obrigado por escolher a Tripler! Já estamos processando o pagamento com a sua operadora de cartão. O prazo
            para a aprovação da compra é de até 72h úteis.
            Vamos avisar quando tivermos novidades! Você pode acompanhar o status da sua Reserva <a href="#">aqui</a>
            Lembrando que você pode cancelar sua reserva em até 3 dias antes do dia da trip.
        </p>
        <p>
            Número da reserva: <strong> {{ $order->code }} </strong> <br />
            Status: <strong>Processando Pagamento</strong> <br />
            Embarque: <strong>{{$order->ticket->boarding->name}}</strong>
        </p>
        <h4> Seu pacote </h4>
        <strong> {{ $order->ticket->tripSchedule->trip->name }} </strong>
        <p> {{ $order->ticket->type }} - {{ $order->ticket->period }} </p>
        <hr />
        @foreach ($order->ticket->passengers as $passenger)
            <p>
                {{ $passenger->name }}<br />
                Passageiro : <strong> {{ $passenger->fullName }} </strong> <br />
                {{-- <h4>Pacotes Adicionais</h4>
            @foreach ($passenger->additionalPackages as $additionalPackage)
            <p>
                <h3> {{$additionalPackage->name}} </h3>
                <p>
                    {{$additionalPackage->description}}
                </p>
                <strong> {{$additionalPackage->amount}} </strong>
            </p>
            @endforeach --}}
            <h4>SubTotal: {{ "R$ ".number_format($passenger->total, 2) }}</h4> <br />
            <hr />
            </p>
        @endforeach
        <h3> Total: {{"R$ ".number_format($order->total, 2) }} </h3>
    </div>
</body>

</html>
