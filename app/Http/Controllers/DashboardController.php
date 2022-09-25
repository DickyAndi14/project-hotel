<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kamar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $model = Kamar::inRandomOrder()->get();
        if(auth()->user()){
            switch(auth()->user()->role){
                case 'admin' :
                    return redirect()->route('kamar.index');
                case 'guider':
                    return redirect()->route('buku.tamu.index');
            }
        }
        return view('pages.index', compact('model'));
    }

    public function fasilitas(){
        $model = Fasilitas::inRandomOrder()->get();
        return view('pages.fasilitas', compact('model'));
    }

    public function kamar(){
        $model = Kamar::with('tipeKamar')->inRandomOrder()->get();
        return view('pages.kamar', compact('model'));
    }

    public function showKamar($id){
        $model = Kamar::with('fasilitases.fasilitas', 'tipeKamar')->find($id);
        return view('pages.show', compact('model'));
    }
}
