<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class ApiMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return response()->json([
            'success' => true,
            'data' => $menus
        ]);
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $menu
        ]);
    }

    public function getByKategori($kategori)
    {
        $menus = Menu::where('kategori', $kategori)->get();
        return response()->json([
            'success' => true,
            'data' => $menus
        ]);
    }

    public function getByBarcode($barcode)
    {
        $menu = Menu::where('barcode', $barcode)->first();

        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $menu
        ]);
    }
}
