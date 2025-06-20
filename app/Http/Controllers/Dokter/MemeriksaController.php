<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JanjiPeriksa;
use Illuminate\Support\Facades\Auth;

use App\Models\Obat;

class MemeriksaController extends Controller
{
    public function index()
    {
        $janjis = JanjiPeriksa::with(['pasien', 'jadwalPeriksa.dokter', 'periksa' => function($q){ $q->latest(); }])
            ->whereHas('jadwalPeriksa', function ($query) {
                $query->where('id_dokter', Auth::id());
            })
            ->get()
            ->sortBy(function ($janji) {
                return $janji->periksa && $janji->periksa->count() > 0 ? 1 : 0;
            });
        return view('dokter.memeriksa.index', compact('janjis'));
    }

    public function create(JanjiPeriksa $janji)
    {
        $obats = Obat::all();
        return view('dokter.memeriksa.create', compact('janji', 'obats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_janji_periksa' => 'required|exists:janji_periksas,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat_ids' => 'nullable|array',
            'obat_ids.*' => 'exists:obats,id',
        ]);

        $biaya_pemeriksaan = 100000;

        $total_harga_obat = 0;
        if (!empty($validated['obat_ids'])) {
            $total_harga_obat = \App\Models\Obat::whereIn('id', $validated['obat_ids'])->sum('harga');
        }

        $total_biaya = $biaya_pemeriksaan + $total_harga_obat;

        $periksa = \App\Models\Periksa::create([
            'id_janji_periksa' => $validated['id_janji_periksa'],
            'tgl_periksa' => $validated['tgl_periksa'] . ' ' . now()->format('H:i:s'),
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $total_biaya,
        ]);
        if (!empty($validated['obat_ids'])) {
        foreach ($validated['obat_ids'] as $obat_id) {
            \App\Models\DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obat_id,
            ]);
        }
    }

        return redirect()->route('dokter.memeriksa.index')->with('status', 'Pemeriksaan berhasil dibuat.');
    }

    public function edit($periksa)
    {
        $periksa = \App\Models\Periksa::with(['janjiPeriksa.pasien', 'janjiPeriksa.jadwalPeriksa', 'detailPeriksas.obat'])->findOrFail($periksa);
        $obats = Obat::all();
        $selectedObatIds = $periksa->detailPeriksas->pluck('id_obat')->toArray();
        $janji = $periksa->janjiPeriksa;
        return view('dokter.memeriksa.edit', compact('periksa', 'janji', 'obats', 'selectedObatIds'));
    }

    public function update(Request $request, $periksa)
    {
        $validated = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat_ids' => 'nullable|array',
            'obat_ids.*' => 'exists:obats,id',
        ]);
        $periksa = \App\Models\Periksa::findOrFail($periksa);
        $biaya_pemeriksaan = 100000;
        $total_harga_obat = 0;
        if (!empty($validated['obat_ids'])) {
            $total_harga_obat = \App\Models\Obat::whereIn('id', $validated['obat_ids'])->sum('harga');
        }
        $total_biaya = $biaya_pemeriksaan + $total_harga_obat;
        $periksa->update([
            'tgl_periksa' => $validated['tgl_periksa'] . ' ' . now()->format('H:i:s'),
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $total_biaya,
        ]);
        // Update detail periksa
        $periksa->detailPeriksas()->delete();
        if (!empty($validated['obat_ids'])) {
            foreach ($validated['obat_ids'] as $obat_id) {
                \App\Models\DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat_id,
                ]);
            }
        }
        return redirect()->route('dokter.memeriksa.index')->with('status', 'Pemeriksaan berhasil diupdate.');
    }
}