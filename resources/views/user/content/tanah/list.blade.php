@extends('user.layout.main')
@section('user.content')
<div class="d-sm-flex  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Aset Tanah</h1>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-items-center table-flush" id="myTable">
                <thead class=" thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Aset</th>
                        <th>Nama/Deskripsi</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Sumber </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tanah as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->kode_tanah}}</td>
                        <td>{{$row->nama_tanah}}</td>
                        <td>{{$row->tanggal_pengadaan}}</td>
                        <td>
                            @if ($row->sumber === 'pembelian')
                            Pembelian
                            @else ($row->sumber === 'hibah')
                            Hibah
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tanah.detail', $row->id_tanah) }}" data-toggle="tooltip" data-placement="top" title="Detail Tanah" class="btn btn-outline-primary btn-sm">
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