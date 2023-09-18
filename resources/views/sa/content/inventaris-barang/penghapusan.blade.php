@extends('sa.layout.main')
@section('sa.content')

<div class="py-3 d-flex flex-row align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Tambah Penghapusan Barang {{$itemBarang->nama_item_barang}}</h1>
    <a href="{{route('superadmin.inventaris_barang.index')}}"><button class="btn btn-primary">Kembali</button></a>
</div>

<form method="POST" action="{{ route('superadmin.inventaris_barang.store_penghapusan', $itemBarang->id_item_barang) }}" enctype="multipart/form-data">
    @csrf
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="kode_penghapusan_barang">Kode Penghapusan Barang<span style="color: red">*</span></label>
                    <input type="text" name="kode_penghapusan_barang" value="{{ old('kode_penghapusan_barang', $nextKodePenghapusanBarang) }}" class="form-control" id="kode_penghapusan_barang" readonly>
                </div>
                <div class="col-md-6">
                    <label for="tanggal">Tanggal Penghapusan<span style="color: red">*</span></label>
                    <input type="date" name="tanggal" max="{{ date('Y-m-d') }}" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" autofocus required>
                    @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_item_barang">Item Barang<span style="color: red">*</span></label>
                        <input type="text" name="id_item_barang" class="form-control" id="id_item_barang" value="{{$itemBarang->kode_item_barang}} {{$itemBarang->nama_item_barang}}" readonly required>
                        @error('id_item_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tindakan">Tindakan Penghapusan<span style="color: red">*</span></label>
                        <div>
                            <div class="form-check form-check-inline @error('tindakan') is-invalid @enderror">
                                <input class="form-check-input" type="radio" name="tindakan" id="jual" value="jual" {{ old('tindakan') === 'jual' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jual">Dijual</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tindakan" id="hibah" value="hibah" {{ old('tindakan') === 'hibah' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="hibah">Dihibahkan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tindakan" id="dihanguskan" value="dihanguskan" {{ old('tindakan') === 'dihanguskan' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="dihanguskan">Dihanguskan</label>
                            </div>
                        </div>
                        @error('tindakan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan">Alasan Penghapusan<span style="color: red">*</span></label>
                        <div>
                            <div class="form-check form-check-inline @error('alasan') is-invalid @enderror">
                                <input class="form-check-input" type="radio" name="alasan" id="rusak" value="rusak" {{ old('alasan') === 'rusak' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="rusak">Rusak</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alasan" id="hilang" value="hilang" {{ old('alasan') === 'hilang' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="hilang">Hilang</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alasan" id="tidak_digunakan" value="tidak_digunakan" {{ old('alasan') === 'tidak_digunakan' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="tidak_digunakan">Tidak digunakan</label>
                            </div>
                        </div>
                        @error('alasan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Simpan">
        </div>
    </div>
</form>

@endsection