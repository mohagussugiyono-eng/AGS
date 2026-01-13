<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Discount;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $levelOrder = [
            'Bronze' => 1,
            'Silver' => 2,
            'Gold' => 3,
            'Platinum' => 4,
        ];

        $userLevel = $levelOrder[$user->level];

        $discounts = DB::table('discounts')
            ->where('is_active', 1)
            ->get()
            ->filter(function ($d) use ($levelOrder, $userLevel) {
                return $levelOrder[$d->min_level] <= $userLevel;
            });

        return view('dashboard.index', compact('user', 'discounts'));
    }
}
