<?php


namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class MenuController extends Controller
{
    // Cek user level operator
    private function checkOperator()
    {
        $user = Auth::user();
        if (!$user || $user->level !== 'operator') {
            abort(403, 'Akses ditolak');
        }
    }

    // Tampilkan daftar menu untuk operator
    public function index()
    {
        $this->checkOperator();

        $menus = Menu::orderBy('nama', 'asc')->paginate(12); // Ganti 10 sesuai kebutuhan
        return view('operator.menus.index', compact('menus'));
    }

    // Tampilkan detail menu
    public function show($id)
    {
        $this->checkOperator();

        $menu = Menu::findOrFail($id);
        return view('operator.menus.show', compact('menu'));
    }
}