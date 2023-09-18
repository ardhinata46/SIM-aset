@extends('user.layout.main')
@section('user.content')

<div class="d-sm-flex  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Aset Bangunan</h1>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table align-items-center table-flush" id="myTable">
                    <thead class=" thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Bangunan</th>
                            <th>Nama Bangunan</th>
                            <th>Lokasi Bangunan</th>
                            <th>Tanggal Pengadaan</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bangunan as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->kode_bangunan}}</td>
                            <td>{{$row->nama_bangunan}}</td>
                            <td>{{$row->lokasi}}</td>
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
                                <a href="{{ route('bangunan.detail', $row->id_bangunan) }}" data-toggle="tooltip" data-placement="top" title="Detail Bangunan" class="btn btn-outline-primary btn-sm">
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
</div>

@endsection