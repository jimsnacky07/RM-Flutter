<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|numeric',
            'items' => 'required|array',
            'quantities' => 'required|array',
            'status_bayar' => 'required'
        ]);

        // Calculate total
        $total = 0;
        $items = [];

        foreach ($request->items as $key => $menuId) {
            $menu = Menu::find($menuId);
            $quantity = $request->quantities[$key];
            $subtotal = $menu->harga * $quantity;
            $total += $subtotal;

            $items[] = [
                'menu_id' => $menuId,
                'jumlah' => $quantity,
                'harga' => $menu->harga,
                'subtotal' => $subtotal
            ];
        }

        // Create order in pesanans table
        $pesanan = new Pesanan();
        $pesanan->user_id = '33';
        $pesanan->order_id = $request->table_number;
        $pesanan->status = 'Diproses';
        $pesanan->metode = $request->status_bayar;
        $pesanan->total_harga = $total;
        $pesanan->save();

        // Create order details in detail_pesanans table
        foreach ($items as $item) {
            $detail = new DetailPesanan();
            $detail->pesanan_id = $pesanan->id;
            $detail->menu_id = $item['menu_id'];
            $detail->jumlah = $item['jumlah'];
            $detail->harga = $item['harga'];
            $detail->subtotal = $item['subtotal'];
            $detail->save();
        }

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }
}
