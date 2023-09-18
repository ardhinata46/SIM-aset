<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bangunan;
use Illuminate\Http\Request;

class InventarisBangunanController extends Controller
{
    public function index()
    {
        $title = 'Inventaris Bangunan | Sistem Manajemen Aset';
        $bangunan = Bangunan::with('penghapusanBangunan')
            ->select('bangunans.*', 'tanahs.nama_tanah as nama')
            ->join('tanahs', 'tanahs.id_tanah', '=', 'bangunans.id_tanah')
            ->orderBy('bangunans.status', 'desc')
            ->latest()
            ->get();

        return view('user.content.inventaris-bangunan.list', compact('title', 'bangunan'));
    }

    public function filterInventarisBangunan(Request $request)
    {
        $title = 'Inventaris Bangunan | Sistem Manajemen Aset';

        $kondisi = $request->input('kondisi');
        $status = $request->input('status');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $bangunan = Bangunan::with('penghapusanBangunan')
            ->orderBy('bangunans.status', 'desc')
            ->latest();


        if ($kondisi) {
            $bangunan->where('bangunans.kondisi', $kondisi);
        }
        if ($status !== null) {
            $bangunan->where('bangunans.status', $status);
        }


        if ($tanggal_awal && $tanggal_akhir) {
            $bangunan->where(function ($query) use ($tanggal_awal, $tanggal_akhir) {
                $query->whereDate('tanggal', '>=', $tanggal_awal)
                    ->whereDate('tanggal', '<=', $tanggal_akhir);
            });
        }

        $bangunan = $bangunan->latest()->get();

        return view('user.content.inventaris-bangunan.list', compact('title', 'bangunan'));
    }

    public function detail($id_bangunan)
    {
        $title = 'Detail Aset Bangunan | Sistem Manajemen Aset';

        $bangunan = Bangunan::with('penghapusanBangunan')
        ->select('bangunans.*', 'tanahs.nama_tanah as nama')
        ->join('tanahs', 'tanahs.id_tanah', '=', 'bangunans.id_tanah')
        ->findOrFail($id_bangunan);

        return view('user.content.inventaris-bangunan.detail', compact('title', 'bangunan'));
    }
}
