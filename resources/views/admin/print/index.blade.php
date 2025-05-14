<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Barcodes</title>
    <style>
        * {
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            width: 33%; /* 3 columns per row */
            padding: 10px;
            text-align: center;
            vertical-align: top;
            border: 1px solid #ddd; /* Light border for structure */
        }
        .barcode-item {
            display: inline-block;
            width: 100%;
            text-align: center;
            padding: 5px;
        }
        .barcode-item img {
            max-width: 100%;
            height: auto;
            margin: 5px 0;
        }
        .barcode-item small {
            display: block;
            font-size: 12px;
            color: #333;
        }
        @media print {
            td {
                border: none;
            }
        }
    </style>
</head>
<body>

    <h2>BARCODE MANAGEMENT</h2>

    <table>
        <tr>
            @foreach ($items as $index => $item)
                <td>
                    <div class="barcode-item">
                        <small><strong>{{ Str::ucfirst($item->name) }}</strong></small>
                       
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->barcode, 'C39') }}" alt="barcode">
                        <br>
                        <small>CODE: {{ $item->barcode }}</small>
                    </div>
                </td>

                @if (($index + 1) % 3 == 0)
                    </tr><tr> 
                @endif
            @endforeach
        </tr>
    </table>

</body>
</html>
