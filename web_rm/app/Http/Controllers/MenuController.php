<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use function auth;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Harus login');
        }

        $menus = Menu::all();

        if ($user->level === 'admin') {
            return view('admin.menu-index', compact('menus'));
        } elseif ($user->level === 'operator') {
            return view('operator.menu-index', compact('menus'));
        } else {
            abort(403, 'Tidak punya akses.');
        }
    }

    public function create()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        if ($user->level === 'admin') {
            return view('admin.menu-create');
        } elseif ($user->level === 'operator') {
            return view('operator.menu-create');
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'stok' => 'nullable|integer',
        ]);

        Menu::create($request->all());

        return redirect()->route($user->level . '.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        $menu = Menu::findOrFail($id);

        if ($user->level === 'admin') {
            return view('admin.menu-edit', compact('menu'));
        } elseif ($user->level === 'operator') {
            return view('operator.menu-edit', compact('menu'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'stok' => 'nullable|integer',
        ]);

        $menu->update($request->all());

        return redirect()->route($user->level . '.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route($user->level . '.menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
