<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class PelangganController extends Controller
{
    public function simpanPesanan(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pelanggan' => 'nullable|string|max:255',
            'user_id'        => 'nullable|exists:users,id', 
            'metode'         => 'nullable|in:Transfer Bank,COD',
            'nomor_meja'     => 'nullable|string|max:50',
            'menu_id'        => 'required|array|min:1',
            'menu_id.*'      => 'required|exists:menus,id',
            'jumlah'         => 'required|array|min:1',
            'jumlah.*'       => 'required|integer|min:1',
            'midtrans_token' => 'nullable|string',
        ]);

        // Pastikan jumlah menu dan jumlah item sama
        if (count($request->menu_id) !== count($request->jumlah)) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah menu dan item tidak sesuai.',
            ], 422);
        }

        // Buat array items
        $items = [];
        foreach ($request->menu_id as $index => $menuId) {
            $items[] = [
                'menu_id' => (int) $menuId,
                'jumlah'  => (int) $request->jumlah[$index],
            ];
        }

        // Ambil harga menu
        $menuIds = array_column($items, 'menu_id');
        $menus   = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

        // Hitung total harga
        $total = 0;
        foreach ($items as $it) {
            $price = (float) ($menus[$it['menu_id']]->harga ?? 0);
            $total += $price * $it['jumlah'];
        }

        try {
            $pesanan = DB::transaction(function () use ($request, $items, $menus, $total) {
                // Data pesanan utama
                $pesanan = Pesanan::create([
                    'user_id'        => $request->user_id ?? null, // jika user_id ada, maka simpan
                    'nama_pelanggan' => $request->nama_pelanggan ?? 'Tamu',
                    'status'         => 'Menunggu Konfirmasi',
                    'total_harga'    => $total,
                    'midtrans_token' => $request->midtrans_token ?? null,
                    'metode'         => $request->metode ?? 'COD',
                    'nomor_meja'     => $request->nomor_meja ?? null,
                ]);

                // Insert detail pesanan
                foreach ($items as $it) {
                    $harga = (float) ($menus[$it['menu_id']]->harga ?? 0);
                    $pesanan->detailPesanan()->create([
                        'menu_id'  => $it['menu_id'],
                        'jumlah'   => $it['jumlah'],
                        'harga'    => $harga,
                        'subtotal' => $harga * $it['jumlah'],
                    ]);
                }

                return $pesanan->load('detailPesanan.menu');
            });

            // Response rapi
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'data'    => [
                    'id'             => $pesanan->id,
                    'nama_pelanggan' => $pesanan->nama_pelanggan,
                    'status'         => $pesanan->status,
                    'total_harga'    => $pesanan->total_harga,
                    'metode'         => $pesanan->metode,
                    'nomor_meja'     => $pesanan->nomor_meja,
                    'detail'         => $pesanan->detailPesanan->map(function ($d) {
                        return [
                            'menu_id'   => $d->menu_id,
                            'nama_menu' => $d->menu->nama ?? null,
                            'jumlah'    => $d->jumlah,
                            'harga'     => $d->harga,
                            'subtotal'  => $d->subtotal,
                        ];
                    }),
                ],
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
