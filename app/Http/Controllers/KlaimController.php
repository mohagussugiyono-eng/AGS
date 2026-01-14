<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KlaimController extends Controller
{
    private function getUserLevel($points)
    {
        if ($points <= 10000) return 'Bronze';
        if ($points <= 50000) return 'Silver';
        if ($points <= 100000) return 'Gold';
        return 'Platinum';
    }

    public function claim($id)
    {
        $user = Auth::user();
        $discount = DB::table('discounts')->find($id);

        $levelUser = $this->getUserLevel($user->points);

        $levelOrder = [
            'Bronze' => 1,
            'Silver' => 2,
            'Gold' => 3,
            'Platinum' => 4,
        ];

        if ($levelOrder[$levelUser] < $levelOrder[$discount->min_level]) {
            return back()->with('error', 'Level kamu belum memenuhi');
        }

        $poinDipakai = DB::table('klaim_diskon')
            ->where('user_id', $user->id)
            ->sum('poin_digunakan');

        $poinTersedia = $user->points - $poinDipakai;

        if ($poinTersedia < $discount->poin_harga) {
            return back()->with('error', 'Poin tidak mencukupi');
        }

        DB::table('klaim_diskon')->insert([
            'user_id' => $user->id,
            'discount_id' => $discount->id,
            'nama_diskon' => $discount->title,
            'poin_digunakan' => $discount->poin_harga,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Diskon berhasil diklaim');
    }

    public function histori()
    {
        $klaim = DB::table('klaim_diskon')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('klaim.histori', compact('klaim'));
    }
}
