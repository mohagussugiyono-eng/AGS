<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;
use App\Models\DiscountClaim;

class DiscountController extends Controller
{
    /**
     * Tampilkan semua diskon aktif
     * + cek klaim user untuk tombol otomatis "Sudah Diklaim"
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua diskon aktif
        $discounts = Discount::where('is_active', 1)->get();

        // Ambil ID diskon yang sudah diklaim user
        $userClaims = DiscountClaim::where('user_id', $user->id)
            ->pluck('discount_id')
            ->toArray();

        return view('discounts.index', compact('discounts', 'userClaims', 'user'));
    }

    /**
     * Proses klaim diskon
     */
    public function claim($id)
    {
        $user = Auth::user();

        // Cek apakah diskon ada & aktif
        $discount = Discount::where('id', $id)
            ->where('is_active', 1)
            ->first();

        if (!$discount) {
            return back()->with('error', 'Diskon tidak tersedia');
        }

        // Cek level user
        $levelOrder = [
            'Bronze' => 1,
            'Silver' => 2,
            'Gold' => 3,
            'Platinum' => 4,
        ];

        if ($levelOrder[$user->level] < $levelOrder[$discount->min_level]) {
            return back()->with('error', 'Level anda belum memenuhi syarat');
        }

        // Cek apakah sudah klaim
        $alreadyClaimed = DiscountClaim::where('user_id', $user->id)
            ->where('discount_id', $id)
            ->exists();

        if ($alreadyClaimed) {
            return back()->with('error', 'Diskon sudah pernah diklaim');
        }

        // Simpan klaim
        DiscountClaim::create([
            'user_id' => $user->id,
            'discount_id' => $id,
        ]);

        return back()->with('success', 'Diskon berhasil diklaim 🎉');
    }
}
