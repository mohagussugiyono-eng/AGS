<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function getUserLevel($points)
    {
        if ($points <= 10000) return 'Bronze';
        if ($points <= 50000) return 'Silver';
        if ($points <= 100000) return 'Gold';
        return 'Platinum';
    }

    public function index()
    {
        $user = Auth::user();

        // TOTAL POIN (MANUAL)
        $totalPoin = $user->points;

        // LEVEL DARI TOTAL POIN
        $level = $this->getUserLevel($totalPoin);

        // POIN YANG SUDAH DIPAKAI
        $poinDipakai = DB::table('klaim_diskon')
            ->where('user_id', $user->id)
            ->sum('poin_digunakan');

        // POIN TERSEDIA
        $poinTersedia = $totalPoin - $poinDipakai;

        // AMBIL DISKON SESUAI LEVEL
        $levelOrder = [
            'Bronze' => 1,
            'Silver' => 2,
            'Gold' => 3,
            'Platinum' => 4,
        ];

        $discounts = DB::table('discounts')
            ->where('is_active', 1)
            ->get()
            ->filter(fn($d) => $levelOrder[$d->min_level] <= $levelOrder[$level]);

        return view('dashboard.index', compact(
            'user',
            'totalPoin',
            'poinTersedia',
            'level',
            'discounts'
        ));
    }
}
