<html>
<head>
    <style>
        .customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12px !important;
        }

        .customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .customers tr:nth-child(even){background-color: #f2f2f2;}

        .customers tr:hover {background-color: #ddd;}

        .customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 6px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Kumudini Handicrafts</h1>
    <h3 style="text-align: center;">Store Category Wise Product Stock Report</h3>

<table class="customers" >
    <thead>
    <tr>
        <th>Store</th>
        <th>Store Category</th>
        <th>Product</th>
        <th>Receive Quantity</th>
        <th>Out Quantity</th>
        <th>Current Stock</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($datas as $data)
        <tr>
            <td>{{$data->name}}</td>
            <td>{{$data->category_name}}</td>
            <td>{{$data->product_name}}</td>
            <td>{{$data->total_received }} {{$data->unit_name }}</td>
            <td>{{$data->total_distributed  }} {{$data->unit_name }}</td>
            <td>{{$data->current_stock }} {{$data->unit_name }}</td>
        </tr>
    @endforeach

    </tbody>
</table>
</body>
</html>




