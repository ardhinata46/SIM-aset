@extends('user.layout.main')

@section('user.content')
@include('sweetalert::alert')
<div class="py-3 d-flex flex-row align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Detail {{ $ruangan->nama_ruangan }}</h1>
</div>

<div class="card mb-3">
    <div class="card-body">
        <table class="table table-sm table-borderless table-detail">
            <tr>
                <th>Bangunan Lokasi Ruangan</th>
                <td>: {{ $ruangan->nama }}</td>
            <tr>
                <th>Kode Ruangan</th>
                <td>: {{ $ruangan->kode_ruangan }}</td>
            </tr>
            <tr>
                <th>Nama Ruangan</th>
                <td>: {{ $ruangan->nama_ruangan }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Data Barang di {{ $ruangan->nama_ruangan }}</h5>
        <table class="table align-items-center table-flush" id="myTable">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Kode Item Barang</th>
                    <th>Nama Item Barang</th>
                    <th>Tanggal Penempatan</th>
                </tr>
            </thead>
            <tbody>
                @php
                $counter = 1;
                @endphp
                @foreach ($detailPenempatan as $detail)
                @foreach ($detail['itemPenempatan'] as $itemPenempatan)
                <tr>
                    <td>{{ $counter }}</td>
                    <td>{{ $itemPenempatan->kode_item_barang }}</td>
                    <td>{{ $itemPenempatan->nama_item_barang }}</td>
                    <td>{{ $detail['penempatan']->tanggal }}</td>

                </tr>

                @php
                $counter++;
                @endphp
                @endforeach
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection