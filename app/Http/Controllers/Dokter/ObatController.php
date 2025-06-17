<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all(); // Data aktif
        return view('dokter.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
        ]);

        Obat::create($request->only(['nama_obat', 'kemasan', 'harga']));

        return redirect()->route('dokter.obat.index')->with('status', 'obat-created');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('dokter.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->only(['nama_obat', 'kemasan', 'harga']));

        return redirect()->route('dokter.obat.index')->with('status', 'obat-updated');
    }

    // 🔴 Soft Delete
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat.index')->with('status', 'obat-hapus');
    }

    // 🟡 Halaman Obat yang Dihapus
    public function trash()
    {
        $obatsTrashed = Obat::onlyTrashed()->get();
        return view('dokter.obat.trash', compact('obatsTrashed'));
    }

    // 🟢 Restore Obat
    public function restore($id)
    {
        $obat = Obat::onlyTrashed()->findOrFail($id);
        $obat->restore();

        return redirect()->route('dokter.obat.trash')->with('status', 'obat-kembali');
    }

    // 🔴 Force Delete Permanen
    public function forceDelete($id)
    {
        $obat = Obat::onlyTrashed()->findOrFail($id);
        $obat->forceDelete();

        return redirect()->route('dokter.obat.trash')->with('status', 'obat-deleted-permanently');
    }
}
