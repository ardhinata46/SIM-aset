@extends ('user.layout.main')
@section ('user.content')
<div class="d-sm-flex  mb-4 align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Detail {{$bangunan->nama_bangunan}}</h1>
    <a href="{{route('user.inventaris_bangunan.index')}}"><button class="btn btn-primary">Kembali</button></a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-borderless table-detail">
                <tr>
                    <td>Kode Bangunan</td>
                    <td>: {{$bangunan->kode_bangunan}}</td>
                </tr>
                <tr>
                    <td>Nama Bangunan</td>
                    <td>: {{$bangunan->nama_bangunan}}</td>
                </tr>
                <tr>
                    <td>Deskripsi Bangunan</td>
                    <td>: {{$bangunan->deskripsi}}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengadaan </td>
                    <td>: {{$bangunan->tanggal_pengadaan}}</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>: {{$bangunan->nama}}, {{$bangunan->lokasi}}</td>
                </tr>
                <tr>
                    <td>Kondisi</td>
                    <td>:
                        @if($bangunan->kondisi == 'baik')
                        <span class="badge badge-success">Baik</span>
                        @elseif($bangunan->kondisi == 'rusak_ringan')
                        <span class="badge badge-warning">Rusak Ringan</span>
                        @elseif($bangunan->kondisi == 'rusak_berat')
                        <span class="badge badge-danger">Rusak Berat</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Sumber Aset</td>
                    <td>:
                        @if ($bangunan->sumber === 'pembangunan')
                        Pembangunan
                        @elseif ($bangunan->sumber === 'pembelian')
                        Pembelian
                        @elseif ($bangunan->sumber === 'hibah')
                        Hibah
                        @endif

                    </td>
                </tr>
                <tr>
                    <td>Harga Perolehan</td>
                    <td>: Rp.{{ number_format(floatval($bangunan->harga_perolehan), 0, ',', '.') }}</td>

                    </td>
                </tr>
                <tr>
                    <td>Status </td>
                    <td>:
                        @if ($bangunan->status == 1)
                        <span class="badge badge-success">Aktif</span>
                        @else
                        <span class="badge badge-danger">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>: {{$bangunan->keterangan}}
                    </td>
                </tr>
                <tr>
                    <td>Keterangan Lainnya</td>
                    <td>: @if ($bangunan->penghapusanBangunan)
                        @if ($bangunan->penghapusanBangunan->tindakan == 'jual')
                        Dijual
                        @elseif ($bangunan->penghapusanBangunan->tindakan == 'hibah')
                        Dihibahkan
                        @elseif ($bangunan->penghapusanBangunan->tindakan == 'dihanguskan')
                        Dihanguskan
                        @endif
                        @endif</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>

@endsection