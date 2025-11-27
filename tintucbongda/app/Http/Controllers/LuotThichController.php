<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LuotThich;
use Illuminate\Support\Facades\Auth;
use App\Models\BaiViet;

class LuotThichController extends Controller
{
    public function show($id)
    {
        $baiViet = BaiViet::findOrFail($id);
        $userId = Auth::id();

        $daLike = LuotThich::where('bai_viet_id', $baiViet->id)
            ->where('nguoi_dung_id', $userId)
            ->exists();

        return view('bai_viet.show', compact('baiViet', 'daLike'));
    }
}
