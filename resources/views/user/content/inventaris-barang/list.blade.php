@extends ('user.layout.main')
@section ('user.content')
@include('sweetalert::alert')
<div class="d-sm-flex  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Inventaris Barang</h1>
</div>

<!-- Row -->
<div class="row">
    <!-- Datatables -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-primary btn-sm" title="Filter" data-toggle="modal" data-target="#inventarisBarangModal">
                        Filter Barang <i class="fas fa-filter"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead class=" thead-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kode Item Barang</th>
                                <th>Nama Item Barang/Merk</th>
                                <th>Ruangan</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                                <th>keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itemBarang as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->tanggal_pengadaan}}</td>
                                <td>{{$row->kode_item_barang}}</td>
                                <td>{{$row->nama_item_barang}} {{$row->merk}}</td>
                                <td>{{$row->nama_ruangan }}</td>
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
                                    @if($row->status == 1)
                                    <span class="badge badge-success">Aktif</span>
                                    @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if($row->penghapusanBarang)
                                    @if($row->penghapusanBarang->tindakan == 'jual')
                                    Dijual
                                    @elseif($row->penghapusanBarang->tindakan == 'hibah')
                                    Dihibahkan
                                    @elseif($row->penghapusanBarang->tindakan == 'dihanguskan')
                                    Dihanguskan
                                    @endif
                                    @else

                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('inventaris_barang.detail', $row->id_item_barang) }}" data-toggle="tooltip" data-placement="top" title="Detail Item Barang" class="btn btn-outline-info btn-sm">
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
</div>

<!-- Modal -->
<div class="modal fade" id="inventarisBarangModal" tabindex="-1" role="dialog" aria-labelledby="inventarisBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inventarisBarangModalLabel">Filter inventaris Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('inventaris_barang.filterInventarisBarang') }}">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="id_barang">Barang</label>
                        <select name="id_barang" id="id_barang" class="form-control @error('id_barang') is-invalid @enderror">
                            <option value="">- Pilih Barang -</option>
                            @foreach($barang as $row)
                            <option value="{{ $row->id_barang }}">{{ $row->kode_barang }} {{ $row->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" name="merk" id="merk" class="form-control @error('merk') is-invalid @enderror">
                    </div>

                    <div class="form-group">
                        <label for="kondisi">Kondisi</label>
                        <select name="kondisi" id="kondisi" class="form-control @error('kondisi') is-invalid @enderror">
                            <option value="">- Pilih Kondisi -</option>
                            <option value="baik">Baik</option>
                            <option value="rusak_ringan">Rusak Ringan</option>
                            <option value="rusak_berat">Rusak Berat</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_awal">Tanggal Pengadaan</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control @error('tanggal_awal') is-invalid @enderror" max="{{ date('Y-m-d') }}">
                        </div>
                        <div class=" form-group col-md-6">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control @error('tanggal_akhir') is-invalid @enderror" max="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-primary">Reset Form</button>
                    <button type="submit" class="btn btn-primary">Filter <i class="fa fa-filter"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Mendapatkan elemen-elemen yang diperlukan
    var tanggalAwalInput = document.getElementById('tanggal_awal');
    var tanggalAkhirInput = document.getElementById('tanggal_akhir');
    var form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        var tanggalAwal = new Date(tanggalAwalInput.value);
        var tanggalAkhir = new Date(tanggalAkhirInput.value);

        if (tanggalAwal > tanggalAkhir) {
            event.preventDefault(); // Menghentikan pengiriman form
            alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
        }
    });
</script>

@endsection