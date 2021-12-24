<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Facture;
use Illuminate\Http\Request;

class DashboardAController extends Controller
{
    public function sum_user()
    {
        $sum = User::count();

        if ($sum) {
            return response()->json([
                'status' => 200,
                'sum' => $sum,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => '0',
            ]);
        }
    }

    public function sum_member()
    {
        $sum_mem = Member::count();

        if ($sum_mem) {
            return response()->json([
                'status' => 200,
                'sum_mem' => $sum_mem,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => '0',
            ]);
        }
    }

    public function sum_facture()
    {
        $sum_fact = Facture::count();

        if ($sum_fact) {
            return response()->json([
                'status' => 200,
                'sum_fact' => $sum_fact,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => '0',
            ]);
        }
    }

    public function total_earn()
    {
        $sum_earn = Facture::sum('subscribe');

        if ($sum_earn) {
            return response()->json([
                'status' => 200,
                'sum_earn' => $sum_earn,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => '0',
            ]);
        }
    }
}
