<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kode Ruangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        h1 {
            font-size: 30px;
        }

        p {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>
                <div>
                    <h1>{{ $nama }}</h1>
                    <p>{{ $kode }}</p>
                </div>
            </td>
        </tr>
    </table>

</body>

</html>