<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\ItemBarang;
use App\Models\PenempatanBarang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisBarangController extends Controller
{
    public function index()
    {
        $title = 'Inventaris Barang | Sistem Manajemen Aset';
        $barang = Barang::all();

        $itemBarang = ItemBarang::with('penghapusanBarang')
            ->select('item_barangs.*', 'ruangans.nama_ruangan', 'peminjaman_barangs.nama_peminjam', 'barangs.kode_barang as kode_barang', 'barangs.nama_barang as nama_barang')
            ->join('barangs', 'barangs.id_barang', '=', 'item_barangs.id_barang')
            ->leftJoin('item_penempatan_barangs', 'item_barangs.id_item_barang', '=', 'item_penempatan_barangs.id_item_barang')
            ->leftJoin('penempatan_barangs', 'item_penempatan_barangs.id_penempatan_barang', '=', 'penempatan_barangs.id_penempatan_barang')
            ->leftJoin('ruangans', 'penempatan_barangs.id_ruangan', '=', 'ruangans.id_ruangan')
            ->leftJoin('item_peminjaman_barangs', 'item_barangs.id_item_barang', '=', 'item_peminjaman_barangs.id_item_barang')
            ->leftJoin('peminjaman_barangs', function ($join) {
                $join->on('item_peminjaman_barangs.id_peminjaman_barang', '=', 'peminjaman_barangs.id_peminjaman_barang')
                    ->where('peminjaman_barangs.status', '=', 0);
            })
            ->latest()
            ->get();

        return view('user.content.inventaris-barang.list', compact('title', 'itemBarang', 'barang'));
    }

    public function filterInventarisBarang(Request $request)
    {
        $title = 'Inventaris Barang | Sistem Manajemen Aset';

        $id_barang = $request->input('id_barang');
        $merk = $request->input('merk');
        $kondisi = $request->input('kondisi');
        $status = $request->input('status');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $barang = Barang::get();

        $itemBarang = ItemBarang::where('status', 1)
            ->latest();

        if ($id_barang) {
            $itemBarang->where('item_barangs.id_barang', $id_barang);
        }
        if ($kondisi) {
            $itemBarang->where('item_barangs.kondisi', $kondisi);
        }
        if ($merk) {
            $itemBarang->where('item_barangs.merk', 'LIKE', '%' . $merk . '%');
        }

        if ($tanggal_awal && $tanggal_akhir) {
            $itemBarang->where(function ($query) use ($tanggal_awal, $tanggal_akhir) {
                $query->whereDate('tanggal_pengadaan', '>=', $tanggal_awal)
                    ->whereDate('tanggal_pengadaan', '<=', $tanggal_akhir);
            });
        }

        $itemBarang = $itemBarang->latest()->get();

        return view('user.content.inventaris-barang.list', compact('title', 'itemBarang', 'barang'));
    }

    public function detail($id_item_barang)
    {
        $title = "Detail Item Barang | Sistem Manajemen Aset";
        $detail = ItemBarang::with('penghapusanBarang')
            ->select('item_barangs.*', 'ruangans.nama_ruangan', 'peminjaman_barangs.nama_peminjam', 'barangs.kode_barang as kode_barang', 'barangs.nama_barang as nama_barang', 'bangunans.nama_bangunan')
            ->join('barangs', 'barangs.id_barang', '=', 'item_barangs.id_barang')
            ->leftJoin('item_penempatan_barangs', 'item_barangs.id_item_barang', '=', 'item_penempatan_barangs.id_item_barang')
            ->leftJoin('penempatan_barangs', 'item_penempatan_barangs.id_penempatan_barang', '=', 'penempatan_barangs.id_penempatan_barang')
            ->leftJoin('ruangans', 'penempatan_barangs.id_ruangan', '=', 'ruangans.id_ruangan')
            ->leftJoin('item_peminjaman_barangs', 'item_barangs.id_item_barang', '=', 'item_peminjaman_barangs.id_item_barang')
            ->leftJoin('peminjaman_barangs', function ($join) {
                $join->on('item_peminjaman_barangs.id_peminjaman_barang', '=', 'peminjaman_barangs.id_peminjaman_barang')
                    ->where('peminjaman_barangs.status', '=', 0);
            })
            ->leftJoin('ruangans as r', 'r.id_ruangan', '=', 'ruangans.id_ruangan')
            ->leftJoin('bangunans', 'bangunans.id_bangunan', '=', 'r.id_bangunan')
            ->where('item_barangs.id_item_barang', $id_item_barang)
            ->first();


        return view('user.content.inventaris-barang.detail', compact('title', 'detail'));
    }

    public function info($id_item_barang)
    {
        $title = "Detail Item Barang | Sistem Manajemen Aset";
        $detail = ItemBarang::with('penghapusanBarang')
            ->select('item_barangs.*', 'ruangans.nama_ruangan', 'peminjaman_barangs.nama_peminjam', 'barangs.kode_barang as kode_barang', 'barangs.nama_barang as nama_barang', 'bangunans.nama_bangunan')
            ->join('barangs', 'barangs.id_barang', '=', 'item_barangs.id_barang')
            ->leftJoin('item_penempatan_barangs', 'item_barangs.id_item_barang', '=', 'item_penempatan_barangs.id_item_barang')
            ->leftJoin('penempatan_barangs', 'item_penempatan_barangs.id_penempatan_barang', '=', 'penempatan_barangs.id_penempatan_barang')
            ->leftJoin('ruangans', 'penempatan_barangs.id_ruangan', '=', 'ruangans.id_ruangan')
            ->leftJoin('item_peminjaman_barangs', 'item_barangs.id_item_barang', '=', 'item_peminjaman_barangs.id_item_barang')
            ->leftJoin('peminjaman_barangs', function ($join) {
                $join->on('item_peminjaman_barangs.id_peminjaman_barang', '=', 'peminjaman_barangs.id_peminjaman_barang')
                    ->where('peminjaman_barangs.status', '=', 0);
            })
            ->leftJoin('ruangans as r', 'r.id_ruangan', '=', 'ruangans.id_ruangan')
            ->leftJoin('bangunans', 'bangunans.id_bangunan', '=', 'r.id_bangunan')
            ->where('item_barangs.id_item_barang', $id_item_barang)
            ->first();


        return view('user.content.inventaris-barang.detail', compact('title', 'detail'));
    }

    public function ruangan($id_ruangan)
    {
        $title = 'Detail Ruangan | Sistem Manajemen Aset';

        // Ambil data ruangan
        $ruangan = Ruangan::select('ruangans.*', 'bangunans.nama_bangunan as nama')
            ->join('bangunans', 'bangunans.id_bangunan', '=', 'ruangans.id_bangunan')
            ->where('ruangans.id_ruangan', '=', $id_ruangan)
            ->first();


        // Ambil data penempatan barang berdasarkan ruangan
        $penempatanBarang = PenempatanBarang::where('id_ruangan', $id_ruangan)->get();

        // Ambil detail item penempatan berdasarkan penempatan barang
        $detailPenempatan = [];
        foreach ($penempatanBarang as $penempatan) {
            $itemPenempatan = DB::table('item_penempatan_barangs')
                ->select('item_penempatan_barangs.id_item_penempatan_barang', 'item_barangs.id_item_barang', 'item_barangs.nama_item_barang', 'item_barangs.kode_item_barang', 'penempatan_barangs.tanggal as tanggal_penempatan')
                ->join('item_barangs', 'item_penempatan_barangs.id_item_barang', '=', 'item_barangs.id_item_barang')
                ->join('penempatan_barangs', 'item_penempatan_barangs.id_penempatan_barang', '=', 'penempatan_barangs.id_penempatan_barang')
                ->where('item_penempatan_barangs.id_penempatan_barang', $penempatan->id_penempatan_barang)
                ->get();

            $detailPenempatan[] = [
                'penempatan' => $penempatan,
                'itemPenempatan' => $itemPenempatan,
            ];
        }

        return view('user.content.ruangan', compact('ruangan', 'detailPenempatan', 'title'));
    }
}
