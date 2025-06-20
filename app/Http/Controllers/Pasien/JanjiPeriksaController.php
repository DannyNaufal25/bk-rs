<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\JanjiPeriksa;
use Illuminate\Support\Facades\Redirect;

class JanjiPeriksaController extends Controller
{
    public function index()
    {
        $no_rm = Auth::user()->no_rm;
        $dokter = User::with([
            'jadwalPeriksas' => function ($query) {
                $query->where('status', true);
            },
        ])
            ->where('role', 'dokter')
            ->get();

        return view('pasien.janjiperiksa.index')->with([
            'no_rm' => $no_rm,
            'dokter' => $dokter,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required',
        ]);

        $jumlahJanji = JanjiPeriksa::where('id_jadwal_periksa', $validatedData['id_jadwal_periksa'])->count();
        $noAntrian = $jumlahJanji + 1;

        JanjiPeriksa::create([
            'id_pasien' => Auth::user()->id,
            'id_jadwal_periksa' => $validatedData['id_jadwal_periksa'],
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return Redirect::route('pasien.janjiperiksa.index')->with('status', 'janji-periksa-created');
    }
}
