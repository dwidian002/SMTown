<!DOCTYPE html>
<html lang="en">

<head>
    <title>Invoice {{ $row->code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14pt;
        }
        .header {
            text-align: center;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }
        .table-data, .table-data th, .table-data td {
            border: 1px solid black;
        }
        .table-data th, .table-data td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Invoice Belanja</h1>
        <h2>{{ $row->code }}</h2>
    </div>
    <hr>
    <table class="table-data">
        <tr>
            <th>Nama Album</th>
            <th>@</th>
            <th>QTY</th>
            <th>Total</th>
        </tr>
        @foreach ($row->itemTransactions as $item)
            <tr>
                <td>{{ $item->album->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
