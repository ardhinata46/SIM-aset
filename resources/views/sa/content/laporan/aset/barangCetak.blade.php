<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$namaFile}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table-header {
            border-collapse: collapse;
        }

        .table-header th,
        .table-header td {
            border: none;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .data {
            margin-left: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            vertical-align: top;
            font-size: 12px;
        }

        th {
            text-align: left;
        }

        p {
            font-size: 12px;
        }



        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 5px;
            vertical-align: top;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>
    <table class="table-header">
        <tr>
            <th><img class="logo" src="{{ $logoProfil }}" alt="Logo Profil"></th>
            <td>
                <h3>{{$nama}}</h3>
                <p>Email : {{ $email }}</p>
                <p>{{ $alamat }}</p>
            </td>
        </tr>
    </table>
    <hr>
    <h5 style="text-align: center;">{{$namaFile}}</h5>
    <table class="table">
        <thead class=" thead-light">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Item Barang</th>
                <th>Kategori Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->kode_barang}}</td>
                <td>{{$row->nama_barang}}</td>
                <td>{{$row->item_barang_count}}</td>
                <td>{{$row->nama}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>