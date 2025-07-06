<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Alat;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjamen = Pinjaman::with('alat')->get();
        return view('admin.pinjaman.index', compact('pinjamen'));
    }

    public function create($alat_id)
    {
        $alat = Alat::findOrFail($alat_id);
        return view('sewa', compact('alat'));
    }


   public function store(Request $request)
{
    $validated = $request->validate([
        'alat_id' => 'required|exists:alats,id',
        'jumlah' => 'required|integer|min:1',
        'durasi' => 'required|integer|min:1',
        'nama' => 'required|string|max:255',
        'nomor_hp' => 'required|string|max:20',
        'alamat' => 'required|string|max:500',
        'email' => 'required|email|max:255',
    ]);

    // Ambil alat berdasarkan ID
    $alat = Alat::findOrFail($validated['alat_id']);

    // Cek apakah stok mencukupi
    if ($validated['jumlah'] > $alat->stok) {
        return back()->with('error', 'Stok alat tidak mencukupi.');
    }

    // Hitung total harga
    $total_harga = $validated['jumlah'] * $validated['durasi'] * $alat->harga;
    $validated['total_harga'] = $total_harga;

    // Kurangi stok alat
    $alat->stok -= $validated['jumlah'];
    $alat->save();

    // Simpan pinjaman
    Pinjaman::create($validated);

    return redirect('/')->with('success', 'Pengajuan peminjaman berhasil! Tim kami akan menghubungi Anda segera.');
}



    public function show(Pinjaman $pinjaman)
    {
        return view('admin.pinjaman.show', compact('pinjaman'));
    }

    public function edit(Pinjaman $pinjaman)
    {
        $alat = Alat::all();
        return view('admin.pinjaman.edit', compact('pinjaman', 'alat'));
    }

    public function update(Request $request, Pinjaman $pinjaman)
    {
        $request->validate([
            'alat_id' => 'required|exists:alat,id',
            'jumlah' => 'required|integer|min:1',
            'nama' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
        ]);

        $pinjaman->update($request->all());

        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil diperbarui.');
    }

    public function destroy(Pinjaman $pinjaman)
    {
        // Ambil data alat yang dipinjam
        $alat = Alat::findOrFail($pinjaman->alat_id);
        
        // Kembalikan stok alat
        $alat->stok += $pinjaman->jumlah;
        $alat->save();
        
        // Hapus data peminjaman
        $pinjaman->delete();
        
        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil dihapus dan stok alat telah dikembalikan.');
    }
}
