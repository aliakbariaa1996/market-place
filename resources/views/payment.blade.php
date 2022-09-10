<html>
<head>

</head>
<body>
<style>
    .centered {
        position: fixed;
        top: 50%;
        left: 50%;
        /* bring your own prefixes */
        transform: translate(-50%, -50%);
    }

</style>
<div class="centered">
    Fake Payment Page<br>

    <br><br>
    <h1>{{$invoice->product->price->price}}</h1>
    <br><br>

    <a href="{{route('paymentPass',[$invoice->id])}}">
        <button>PASS</button>
    </a>
    <a href="{{route('paymentFail',[$invoice->id])}}">
        <button>FAIL</button>
    </a>
</div>
</body>
</html>
