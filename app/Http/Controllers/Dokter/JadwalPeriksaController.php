<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', auth()->id())->get();
        return view('dokter.jadwalperiksa.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwalperiksa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $exists = JadwalPeriksa::where('id_dokter', auth()->id())
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_mulai', '<', $request->jam_selesai)
                        ->where('jam_selesai', '>', $request->jam_mulai);
                });
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'Jadwal dengan hari dan jam yang sama sudah ada.'])->withInput();
        }

        JadwalPeriksa::create([
            'id_dokter' => auth()->id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => false, // selalu dibuat tidak aktif
        ]);

        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwal-created');
    }

    public function show(string $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        return view('dokter.jadwalperiksa.show', compact('jadwal'));
    }

    public function edit(string $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        return view('dokter.jadwalperiksa.edit', compact('jadwal'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $exists = JadwalPeriksa::where('id_dokter', auth()->id())
            ->where('hari', $request->hari)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_mulai', '<', $request->jam_selesai)
                        ->where('jam_selesai', '>', $request->jam_mulai);
                });
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'Jadwal dengan hari dan jam yang sama sudah ada.'])->withInput();
        }

        $jadwal = JadwalPeriksa::findOrFail($id);
        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwal-updated');
    }

    public function destroy(string $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwal-deleted');
    }

    public function toggleStatus(string $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        if (!$jadwal->status) {
            // nonaktifkan jadwal lain
            JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->where('id', '!=', $jadwal->id)
                ->update(['status' => false]);

            $jadwal->status = true;
        } else {
            $jadwal->status = false;
        }

        $jadwal->save();

        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwal-status-updated');
    }
}
