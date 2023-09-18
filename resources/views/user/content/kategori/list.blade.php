@extends ('user.layout.main')
@section ('user.content')
@include('sweetalert::alert')
<div class="d-sm-flex  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kategori Barang</h1>
</div>

<!-- Row -->
<div class="row">
    <!-- Datatables -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="myTable">
                    <thead class=" thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Kategori Barang</th>
                            <th>Nama Kategori Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoriBarang as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->kode_kategori_barang}}</td>
                            <td>{{$row->nama_kategori_barang}}</td>
                            <td>
                                <a href="{{route ('kategori_barang.detail', $row->id_kategori_barang)}}" class="btn btn-outline-info btn-sm" data-toogle="tooltip" data-placement="top" title="Detail Kategori Barang">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr> @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection