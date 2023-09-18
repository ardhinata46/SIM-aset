<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tanah;
use Illuminate\Http\Request;

class InventarisTanahController extends Controller
{
    public function index()
    {
        $title = 'Inventaris Tanah | Sistem Manajemen Aset';
        $tanah = Tanah::with('penghapusanTanah')
            ->orderBy('status', 'desc')
            ->get();

        return view('user.content.inventaris-tanah.list', compact('title', 'tanah'));
    }

    public function filterInventarisTanah(Request $request)
    {
        $title = 'Inventaris Tanah | Sistem Manajemen Aset';


        $status = $request->input('status');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $tanah = Tanah::with('penghapusanTanah')
            ->orderBy('status', 'desc')
            ->latest();


        if ($status !== null) {
            $tanah->where('tanahs.status', $status);
        }

        if ($tanggal_awal && $tanggal_akhir) {
            $tanah->where(function ($query) use ($tanggal_awal, $tanggal_akhir) {
                $query->whereDate('tanggal_pengadaan', '>=', $tanggal_awal)
                    ->whereDate('tanggal_pengadaan', '<=', $tanggal_akhir);
            });
        }

        $tanah = $tanah->latest()->get();

        return view('user.content.inventaris-tanah.list', compact('title', 'tanah'));
    }

    public function detail($id_tanah)
    {
        $title = 'Detail Aset Tanah | Sistem Manajemen Aset';

        $tanah = Tanah::with('penghapusanTanah')
            ->findOrFail($id_tanah);

        return view('user.content.inventaris-tanah.detail', compact('title', 'tanah'));
    }
}
