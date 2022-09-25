<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Kamar;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request('kamar_id')){
            $model = Kamar::find(request('kamar_id'));
            return view('pages.cart.create', compact('model'));
        }
        return view('pages.cart.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $checkin = request('checkin');
        $checkout = request('checkout');

        if (Carbon::parse($checkin)->toDateString() < Carbon::now()->toDateString() || Carbon::parse($checkout)->toDateString() < Carbon::parse($checkin)->toDateString()) {
            if(request()->ajax()){
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal tidak boleh kurang dari hari ini',
                ]);
            }
            return redirect()->route('landing')->with('error_jumlah', 'Tanggal tidak boleh kurang dari hari ini');
        }

        $kamarReq = Kamar::with('tipeKamar')->find(request('kamar_id'));
        if(session()->has('cart') && count(session('cart')) > 0){
            $cart = session('cart');
            $keys = array_keys($cart)[0];
            $kamarOld = Kamar::with('tipeKamar')->find($cart[$keys]['kamar']);
            if($kamarOld->tipeKamar->name == $kamarReq->tipeKamar->name){
                $cart[request('kamar_id')] = [
                    'user_order_id' => request('user_id'),
                    'checkin'  => Carbon::now(request('checkin'))->format('Y-m-d'),
                    'checkout' => Carbon::parse(request('checkout'))->format('Y-m-d'),
                    'nama_kamar' => $kamarReq->name, 
                    'tipe_kamar' => $kamarReq->tipeKamar->name, 
                    'jumlah'     => request('jumlah'),
                    'kamar'      => request('kamar_id'),
                    'nama_tamu'  => request('nama_tamu'),
                    'no_hp'      => request('no_hp'),
                ];

                if(request('jumlah') > $kamarReq){
                    return response()->json([
                        'success' => false,
                        'message' => 'Tidak cukup kamar',
                        'count'   => count(session('cart'))
                    ]);
                }
                session(['cart' => $cart]);
                if(request()->ajax()){
                    return response()->json([
                        'success' => true,
                        'message' => 'Keranjang belanja Berhasil ditambahkan',
                        'count'   => count(session('cart'))
                    ]);
                }
                return redirect()->route('landing');
            } else {
                if(request()->ajax()){
                    return response()->json([
                        'success' => false,
                        'message' => 'Tipe kamar harus sama dalam pemesanan berikutnya',
                        'count'   => count(session('cart'))
                    ]);
                }
                return redirect()->route('landing')->with('error_jumlah', 'Tipe kamar harus sama dalam pemesanan berikutnya');
            }
        } else {
            $req[request('kamar_id')] = [
                'user_order_id' => request('user_id'),
                'checkin'  => Carbon::parse(request('checkin'))->format('Y-m-d'),
                'checkout' => Carbon::parse(request('checkout'))->format('Y-m-d'),
                'nama_kamar' => $kamarReq->name, 
                'tipe_kamar' => $kamarReq->tipeKamar->name, 
                'jumlah'   => request('jumlah'),
                'kamar'    => request('kamar_id'),
                'nama_tamu' => request('nama_tamu'),
                'no_hp'     => request('no_hp'),
            ];
            if(request('jumlah') > $kamarReq->jumlah){
                if(request()->ajax()){
                    return response()->json([
                        'success' => false,
                        'message' => 'Kamar tersedia tidak cukup',
                    ]);
                }else{
                    return redirect()->route('landing')->with('error_jumlah', 'Kamar tersedia tidak cukup');
                }
            }
            session()->put('cart', $req);
            if(request()->ajax()){
                return response()->json([
                    'success' => true,
                    'message' => 'Keranjang belanja Berhasil ditambahkan',
                    'count'   => count(session('cart'))
                ]);
            }
            return redirect()->route('landing');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = session('cart')[$id];
        return view('pages.cart.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = session('cart')[$id];
        return view('pages.cart.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, $id)
    {
        $kamarReq = Kamar::with('tipeKamar')->find(request('kamar_id'));
        $cart = session('cart');

        $checkin = request('checkin');
        $checkout = request('checkout');

        if (Carbon::parse($checkin)->toDateString() < Carbon::now()->toDateString() || Carbon::parse($checkout)->toDateString() < Carbon::parse($checkin)->toDateString()) {
            if(request()->ajax()){
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal tidak boleh kurang dari hari ini',
                ]);
            }
            return redirect()->route('landing')->with('error_jumlah', 'Tanggal tidak boleh kurang dari hari ini');
        }

        $cart[request('kamar_id')] = [
            'user_order_id' => request('user_id'),
            'checkin'  => Carbon::parse(request('checkin'))->format('Y-m-d'),
            'checkout' => Carbon::parse(request('checkout'))->format('Y-m-d'),
            'nama_kamar' => $kamarReq->name, 
            'tipe_kamar' => $kamarReq->tipeKamar->name, 
            'jumlah'   => request('jumlah'),
            'kamar'    => request('kamar_id'),
            'harga' => request('harga'),
            'nama_tamu' => request('nama_tamu'),
            'no_hp'     => request('no_hp'),
        ];
        if(request('jumlah') > $kamarReq->jumlah){
            if(request()->ajax()){
                return response()->json([
                    'success' => false,
                    'message' => 'Kamar tersedia tidak cukup',
                ]);
            }else{
                return redirect()->route('landing')->with('error_jumlah', 'Kamar tersedia tidak cukup');
            }
        }
        session(['cart' => $cart]);
        return response()->json([
            'success' => true,
            'message' => 'Pemesanan kamar berhasil diubah',
            'count'   => count(session('cart'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = session('cart');
        unset($model[$id]);
        session()->put('cart', $model);

        return response()->json([
            'success' => true,
            'message' => 'Pemesanan kamar berhasil dibatalkan',
            'count'   => count(session('cart'))
        ]);
    }
}
