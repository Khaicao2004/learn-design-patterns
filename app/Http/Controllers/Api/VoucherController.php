<?php

namespace App\Http\Controllers\Api;

use App\Events\VoucherCreated;
use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function store(Request $request)
    {
        $voucher = Voucher::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'discount' => $request->discount,
        ]);

        broadcast(new VoucherCreated($voucher));

        return response()->json(['message' => 'Them voucher thanh cong']);
    }
}
