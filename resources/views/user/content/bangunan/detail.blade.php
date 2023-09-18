@extends ('user.layout.main')
@section ('user.content')
<div class="py-3 d-flex flex-row align-items-center justify-content-between">
    <h5>Detail {{$detail->nama_bangunan}}</h5>
    <a href="{{route('bangunan')}}"><button class="btn btn-primary">Kembali</button></a>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-borderless table-detail">
                <tr>
                    <td>Kode Bangunan</td>
                    <td>: {{$detail->kode_bangunan}}</td>
                </tr>
                <tr>
                    <td>Nama Bangunan</td>
                    <td>: {{$detail->nama_bangunan}}</td>
                </tr>
                <tr>
                    <td>Deskripsi Bangunan</td>
                    <td>: {{$detail->deskripsi}}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengadaan </td>
                    <td>: {{$detail->tanggal_pengadaan}}</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>: {{$detail->lokasi}}</td>
                </tr>
                <tr>
                    <td>Kondisi</td>
                    <td>:
                        @if($detail->kondisi == 'baik')
                        <span class="badge badge-success">Baik</span>
                        @elseif($detail->kondisi == 'rusak_ringan')
                        <span class="badge badge-warning">Rusak Ringan</span>
                        @elseif($detail->kondisi == 'rusak_berat')
                        <span class="badge badge-danger">Rusak Berat</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Sumber Aset</td>
                    <td>:
                        @if ($detail->sumber === 'pembangunan')
                        Pembangunan
                        @elseif ($detail->sumber === 'pembelian')
                        Pembelian
                        @elseif ($detail->sumber === 'hibah')
                        Hibah
                        @endif

                    </td>
                </tr>
                <tr>
                    <td>Harga Perolehan</td>
                    <td>: Rp.{{ number_format(floatval($detail->harga_perolehan), 0, ',', '.') }}</td>

                    </td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>: {{$detail->keterangan}} </td>
                </tr>

            </table>
        </div>
    </div>
</div>
<br>

@endsection