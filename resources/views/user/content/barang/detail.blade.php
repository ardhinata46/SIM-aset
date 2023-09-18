@extends ('user.layout.main')
@section ('user.content')
<div class="d-sm-flex  mb-4 align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Detail {{ $barang->nama_barang }}</h1>
    <a href="{{route('barang')}}"><button class="btn btn-primary">Kembali</button></a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <div class="row mb-3">
            <table class="table table-sm table-borderless table-detail">
                <tr>
                    <th>Kategori Barang</th>
                    <td>: {{ $barang->kategori_barang->kode_kategori_barang }} {{ $barang->kategori_barang->nama_kategori_barang }}</td>
                </tr>
                <tr>
                    <th>Kode Barang</th>
                    <td>: {{ $barang->kode_barang }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>: {{ $barang->nama_barang }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="h5 mb-3 text-gray-800">List Item {{ $barang->nama_barang }}</h5>
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead class=" thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Item Barang</th>
                        <th>Nama Item Barang</th>
                        <th>Merk</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itemBarang as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->kode_item_barang}}</td>
                        <td>{{$row->nama_item_barang}}</td>
                        <td>{{$row->merk}}</td>
                        <td>{{$row->tanggal_pengadaan}}</td>
                        <td>
                            @if($row->kondisi == 'baik')
                            <span class="badge badge-success">Baik</span>
                            @elseif($row->kondisi == 'rusak_ringan')
                            <span class="badge badge-warning">Rusak Ringan</span>
                            @elseif($row->kondisi == 'rusak_berat')
                            <span class="badge badge-danger">Rusak Berat</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('item.detail', $row->id_item_barang) }}" data-toggle="tooltip" data-placement="top" title="Detail Item Barang" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>

                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection