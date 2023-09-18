<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bangunan;
use App\Models\Barang;
use App\Models\ItemBarang;
use App\Models\KategoriBarang;
use App\Models\Tanah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Sistem Manajemen Aset";

        //hitung aset aktif
        $jumlahTanah = Tanah::where('status', 1)->get()->count();
        $jumlahBangunan = Bangunan::where('status', 1)->get()->count();
        $jumlahItemBarang = ItemBarang::where('status', 1)->get()->count();
        //untuk chart kondisi barang
        $baik = ItemBarang::where('kondisi', 'baik')->where('status', 1)->get()->count();
        $rusakRingan = ItemBarang::where('kondisi', 'rusak_ringan')->where('status', 1)->get()->count();
        $rusakBerat = ItemBarang::where('kondisi', 'rusak_berat')->where('status', 1)->get()->count();

        //hitung barang rusak ringan dan rusak berat
        $barangBaik = ItemBarang::where('kondisi', 'baik')->where('status', 1)->count();
        $barangRusakRingan = ItemBarang::where('kondisi', 'rusak_ringan')->where('status', 1)->count();
        $barangRusakBerat = ItemBarang::where('kondisi', 'rusak_berat')->where('status', 1)->count();

        $jumlahKategoriBarang = KategoriBarang::count();

        //hitung aset non-aktif
        $jumlahTanahNonAktif = Tanah::where('status', 0)->get()->count();
        $jumlahBangunanNonAktif = Bangunan::where('status', 0)->get()->count();
        $jumlahItemBarangNonAktif = ItemBarang::where('status', 0)->get()->count();
        //hitung total  jumlah keseluruhan aset aktif
        $totalAsetAktif = $jumlahTanah + $jumlahBangunan + $jumlahItemBarang;

        //hitung total  jumlah keseluruhan aset non aktif
        $totalAsetNonAktif = $jumlahTanahNonAktif + $jumlahBangunanNonAktif + $jumlahItemBarangNonAktif;

        $itemPerBarang = Barang::select('barangs.*', 'kategori_barangs.nama_kategori_barang as nama', 'kategori_barangs.kode_kategori_barang as kode')
            ->join('kategori_barangs', 'kategori_barangs.id_kategori_barang', '=', 'barangs.id_kategori_barang')
            ->withCount(['item_barang' => function ($query) {
                $query->where('status', 1);
            }])
            ->latest()->get();

        return view('user.content.dashboard', compact(
            'title',
            'jumlahTanah',
            'jumlahBangunan',
            'jumlahItemBarang',
            'barangBaik',
            'barangRusakRingan',
            'barangRusakBerat',
            'jumlahKategoriBarang',
            'totalAsetAktif',
            'totalAsetNonAktif',
            'itemPerBarang'
        ));
    }
}
