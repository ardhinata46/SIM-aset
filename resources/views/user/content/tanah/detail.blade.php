@extends ('user.layout.main')
@section ('user.content')
<div class="py-3 d-flex flex-row align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Detail {{$tanah->nama_tanah}}</h1>
    <a href="{{route('tanah')}}"><button class="btn btn-primary">Kembali</button></a>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-borderless table-detail">
                <tr>
                    <td>Kode Aset Tanah</td>
                    <td>: {{$tanah->kode_tanah}}</td>
                </tr>
                <tr>
                    <td>Nama/Deskripsi Tanah</td>
                    <td>: {{$tanah->nama_tanah}}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengadaan</td>
                    <td>: {{$tanah->tanggal_pengadaan}} </td>
                </tr>
                <tr>
                    <td>Lokasi Tanah</td>
                    <td>: {{$tanah->lokasi}}</td>
                </tr>
                <tr>
                    <td>Luas </td>
                    <td>: {{$tanah->luas}} m<sup>2 </td>
                </tr>
                <tr>
                    <td>Sumber Aset</td>
                    <td>:
                        @if ($tanah->sumber === 'pembelian')
                        Pembelian
                        @else ($tanah->sumber === 'hibah')
                        Hibah
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>Harga Perolehan</td>
                    <td>: Rp.{{ number_format(floatval($tanah->harga_perolehan), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>: {{$tanah->keterangan}} </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>

@endsection