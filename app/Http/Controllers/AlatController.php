<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::all();
        return view('admin.index', compact('alat'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-alat', 'public');
        }

        Alat::create($data);

        return redirect()->route('alat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Alat $alat)
    {
        return view('admin.edit', compact('alat'));
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'fotp' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika user upload foto baru
        if ($request->hasFile('fotp')) {
            // Hapus foto lama
            $oldPath = public_path('uploads/' . $alat->fotp);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload foto baru
            $file = $request->file('fotp');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $alat->fotp = $filename;
        }

        $alat->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        $alat->save();

        return redirect()->route('alat.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Alat $alat)
    {
        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'Data alat berhasil dihapus.');
    }
}
