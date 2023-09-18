<?php

namespace App\Http\Controllers\SuperAdmin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Tanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TanahController extends Controller
{
    public function index()
    {
        $title = 'Data Aset Tanah | Sistem Manajemen Aset';
        $tanah = Tanah::where('status', 1)->latest()->get();

        return view('sa.content.tanah.list', compact('title', 'tanah'));
    }

    public function add()
    {
        $title = 'Tambah Tanah | Sistem Manajemen Aset';
        $nextKodeTanah = Tanah::generateKodeTanah();

        return view('sa.content.tanah.add', compact('title', 'nextKodeTanah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tanah' => 'required',
            'sumber' => 'required',
            'luas' => 'required',
            'keterangan' => 'nullable',
            'foto' => 'nullable|image',
        ], [
            'nama_tanah.required' => 'Nama Tanah harus diisi.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'sumber.required' => 'Sumber harus dipilih.',
        ]);
        $nextKodeTanah = Tanah::generateKodeTanah();

        // Simpan data ke database dengan menggunakan $nextKodeTanah
        $tanah = new Tanah();
        $tanah->kode_tanah          = $nextKodeTanah;
        $tanah->nama_tanah          = $request->nama_tanah;
        $tanah->lokasi              = $request->lokasi;
        $tanah->sumber              = $request->sumber;
        $tanah->luas                = $request->luas;
        $tanah->tanggal_pengadaan   = $request->tanggal_pengadaan;
        $tanah->harga_perolehan     = str_replace('.', '', $request->harga_perolehan);
        $tanah->keterangan          = $request->keterangan;
        $tanah->created_by = Auth::guard('superadmin')->user()->id_pengguna;

        try {
            // Cek apakah ada file foto yang diunggah
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoPath = public_path('foto');

                if (!File::exists($fotoPath)) {
                    File::makeDirectory($fotoPath, 0777, true, true);
                }

                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move($fotoPath, $fotoName);
                $tanah->foto = 'foto/' . $fotoName;
            }
            $tanah->save();
            return redirect(route('superadmin.tanah.index'))->with('success', 'Tanah berhasil ditambah!');
        } catch (\Exception $e) {
            return redirect(route('superadmin.tanah.index'))->with('error', 'Tanah gagal ditambah!');
        }
    }

    public function detail($id_tanah)
    {
        $title = 'Detail Aset Tanah | Sistem Manajemen Aset';
        $detail = Tanah::findOrFail($id_tanah);

        return view('sa.content.tanah.detail', compact('title', 'detail'));
    }

    public function edit($id_tanah)
    {
        $title = 'Tambah Tanah | Sistem Manajemen Aset';
        $tanah = Tanah::findOrFail($id_tanah);
        return view('sa.content.tanah.edit', compact('title', 'tanah'));
    }

    public function update(Request $request, $id_tanah)
    {
        $request->validate([
            'nama_tanah' => 'required',
            'lokasi' => 'required',
            'sumber' => 'required',
            'luas' => 'required',
            'keterangan' => 'nullable',
        ], [
            'nama_tanah.required' => 'Nama Tanah harus dipilih.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'sumber.required' => 'Sumber harus dipilih.',
        ]);

        $tanah = Tanah::findOrFail($id_tanah);
        $tanah->kode_tanah = $request->kode_tanah;
        $tanah->nama_tanah          = $request->nama_tanah;
        $tanah->lokasi              = $request->lokasi;
        $tanah->sumber              = $request->sumber;
        $tanah->luas                = $request->luas;
        $tanah->tanggal_pengadaan   = $request->tanggal_pengadaan;
        $tanah->harga_perolehan  = str_replace('.', '', $request->harga_perolehan);
        $tanah->keterangan          = $request->keterangan;
        $tanah->created_by          = $request->created_by;
        $tanah->updated_by = Auth::guard('superadmin')->user()->id_pengguna;

        try {
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoPath = public_path('foto');

                if (!File::exists($fotoPath)) {
                    File::makeDirectory($fotoPath, 0777, true, true);
                }

                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move($fotoPath, $fotoName);
                $tanah->foto = 'foto/' . $fotoName;
            } else {
                // Gunakan nota lama jika tidak ada nota baru yang diunggah
                $tanah->foto = $tanah->foto;
            }
            $tanah->save();
            return redirect(route('superadmin.tanah.index'))->with('success', 'Tanah berhasil diubah!');
        } catch (\Exception $e) {
            return redirect(route('superadmin.tanah.index'))->with('error', 'Tanah gagal diubah!');
        }
    }

    public function delete($id_tanah)
    {
        $tanah = Tanah::findOrFail($id_tanah);
        try {
            $tanah->delete();
            return redirect(route('superadmin.tanah.index'))->with('success', 'Tanah berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect(route('superadmin.tanah.index'))->with('error', 'Tanah gagal dihapus!');
        }
    }
}
