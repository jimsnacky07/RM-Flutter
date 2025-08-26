<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function byKategori($kategori)
{
    $menus = Menu::where('kategori', $kategori)->get();

    return response()->json([
        'success' => true,
        'data' => $menus,
    ]);
}

    // Tampilkan form tambah menu
    public function create()
    {
        return view('admin.menus.create');
    }

    // Simpan menu baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('menu', 'public');
        }

        Menu::create($validated);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan!');
    }

    // Tampilkan form edit menu
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    // Simpan hasil edit menu
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('menu', 'public');
        }

        $menu->update($validated);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil diperbarui!');
    }

    // Hapus menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil dihapus.');
    }
}
