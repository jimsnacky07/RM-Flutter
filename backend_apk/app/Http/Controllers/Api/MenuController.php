<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;

class MenuController extends Controller
{
    public function index()
    {
        try {
            $menu = Menu::all();
            return response()->json([
                'success' => true,
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function byKategori($kategori)
    {
        try {
            $menu = Menu::where('kategori', $kategori)->get();

            if ($menu->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'data' => []
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil menu berdasarkan kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
