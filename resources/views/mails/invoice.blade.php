<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h3>
        Invoice #{{$order->number}}
    </h3>
    <thead>
        <tr>Item</tr>
        <tr>price</tr>
        <tr>Qty.</tr>
        <tr>Total</tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)

        <tr>
            <td>
                {{$item->product->name}}
            </td>
            <td>
                {{$item->price}}
            </td>
            <td>
                {{$item->quantity}}
            </td>
            <td>
                {{$item->price * $item->quantity}}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td> {{$order->total}}</td>
        </tr>
    </tfoot>
</body>

</html>