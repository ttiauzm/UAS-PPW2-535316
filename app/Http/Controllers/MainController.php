<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Pekerjaan;

class MainController extends Controller
{

    public function index()
    {
        $totalLaki = Pegawai::where('gender', 'male')->count(); 
        $totalPerempuan = Pegawai::where('gender', 'female')->count();

        $topPekerjaan = Pekerjaan::withCount('pegawai')
            ->orderBy('pegawai_count', 'desc')
            ->take(5)
            ->get();

        $labelPekerjaan = $topPekerjaan->pluck('nama');
        $jumlahPegawai = $topPekerjaan->pluck('pegawai_count');

        return view('index', compact(
            'totalLaki', 
            'totalPerempuan', 
            'labelPekerjaan', 
            'jumlahPegawai'
        ));
    }
}
