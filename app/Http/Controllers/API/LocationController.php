<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regency;
use App\Models\Province;

class LocationController extends Controller
{
    public function provinces(Request $request) {
        return Province::all();
    }

    public function regencies(Request $request, $provinces_id) {
        return Regency::where('province_id', $provinces_id)->get();
    }
}
