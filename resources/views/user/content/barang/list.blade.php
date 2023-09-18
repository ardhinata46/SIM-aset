@extends ('user.layout.main')
@section ('user.content')
<div class="d-sm-flex  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
</div>

<div class="card mb-4">
    <div class="table-responsive p-3">
        <table class="table align-items-center table-flush" id="myTable">
            <thead class=" thead-light">
                <tr>
                    <th>No</th>
                    <th>Kategori Barang</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Item Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barang as $row)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$row->kode}} {{$row->kategori}}</td>
                    <td>{{$row->kode_barang}}</td>
                    <td>{{$row->nama_barang}}</td>
                    <td>{{$row->item_barang_count}}</td>
                    <td>
                        <a href="{{route('barang.detail', $row->id_barang)}}" class="btn btn-outline-primary btn-sm" data-toogle="tooltip" data-placement="top" title="Detail Item">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection