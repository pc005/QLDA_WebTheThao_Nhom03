<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LuotThich;
use Illuminate\Support\Facades\Auth;

class LuotThichController extends Controller
{
use App\Models\BaiViet;
use App\Models\LuotThich;
use Illuminate\Support\Facades\Auth;

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
