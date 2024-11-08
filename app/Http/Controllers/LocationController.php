<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function getRegions() {
        return DB::table('philippine_regions')->select('region_code', 'region_description')->get();
    }

    public function getProvinces($regionId) {
        $provinces = DB::table('philippine_provinces')
            ->where('region_code', $regionId)
            ->select('province_code as id', 'province_description as description')
            ->get();
    
        return response()->json($provinces);
    }

    public function getCities($provinceId) {
        $cities = DB::table('philippine_cities')
            ->where('province_code', $provinceId)
            ->select('city_municipality_code as id', 'city_municipality_description as description')
            ->get();
    
        return response()->json($cities);
    }
    
    public function getBarangays($cityId) {
        $barangays = DB::table('philippine_barangays')
            ->where('city_municipality_code', $cityId)
            ->select('barangay_code as id', 'barangay_description as description')
            ->get();
    
        return response()->json($barangays);
    }
    
}
