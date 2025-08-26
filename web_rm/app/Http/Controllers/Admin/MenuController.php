<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'nullable',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'stok' => 'nullable|integer',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $originalName = $file->getClientOriginalName();
            $destination = public_path('images/menus');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }
            $file->move($destination, $originalName);
            $path = $originalName;
        }

        Menu::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
            'stok' => $request->stok,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'nullable',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'stok' => 'nullable|integer',
        ]);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                $oldPath = public_path($menu->gambar);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('gambar');
            $originalName = $file->getClientOriginalName();
            $destination = public_path('images/menus');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }
            $file->move($destination, $originalName);
            $menu->gambar = $originalName;
        }

        $menu->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'gambar' => $menu->gambar,
            'stok' => $request->stok,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }

    public function generateQRCode()
    {
        $menus = Menu::all();

        foreach ($menus as $menu) {
            // Generate barcode value berdasarkan menu ID
            $barcodeValue = 'MENU' . str_pad($menu->id, 6, '0', STR_PAD_LEFT);
            $menu->barcode = $barcodeValue;
            $menu->save();
        }

        // Return view partial untuk modal
        return view('admin.menus.qr_modal', compact('menus'))->render();
    }
}
