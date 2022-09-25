<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Barryvdh\DomPDF\Facade\Pdf as PdfFacade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Spatie\PdfToImage\Pdf;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return DataTables::of(Transaksi::userActive()->get())
            ->editColumn('_', function($row){
                return "
                    <button class='btn btn-info fw-bold text-white btn-sm' onclick='print_invoice(".$row->id.")'>Cetak</button>
                    <button class='btn btn-success fw-bold text-white btn-sm' onclick='show(".$row->id.")'>Lihat</button>
                ";
            })
            ->rawColumns(['status', '_'])
            ->make(true);
        }
        return view('pages.transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(session()->has('cart') && count(session('cart')) > 0){
            DB::beginTransaction();
            try{
                $transaksiId = Transaksi::create([
                    'kode_booking' => $this->getTransactionCode(),
                    'user_id'      => auth()->user()->id
                ]);
    
                $recordTransaksiDetail = [];
                foreach(session('cart') as $index => $value){
                    $recordTransaksiDetail[$index]['transaksi_id'] = $transaksiId->id;
                    $recordTransaksiDetail[$index]['kamar_id'] = $value['kamar'];
                    $recordTransaksiDetail[$index]['jumlah'] = $value['jumlah'];
                    $recordTransaksiDetail[$index]['checkin'] = $value['checkin'];
                    $recordTransaksiDetail[$index]['checkout'] = $value['checkout'];
                    $recordTransaksiDetail[$index]['tamu'] = $value['nama_tamu'];
                    $recordTransaksiDetail[$index]['no_hp'] = $value['no_hp'];
                    $recordTransaksiDetail[$index]['status'] = 1;
    
                    $kamar = Kamar::find($value['kamar']);
                    $jumlah = ($kamar->jumlah - intval($value['jumlah']));
                    $kamar->update(['jumlah' => $jumlah]);
                }
    
                TransaksiDetail::insert($recordTransaksiDetail);
                DB::commit();
                session()->forget('cart');
                return response()->json([
                    'status' => true,
                    'message' => 'Transaksi berhasil dibuat'
                ]);
    
            }catch(Exception $e){
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Transaksi gagal dibuat'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $model = Transaksi::with('transaksiDetail.kamar.tipeKamar')
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        return view('pages.report.invoice', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function invoiceImg($id){
        $model = Transaksi::with('transaksiDetail.kamar.tipeKamar')
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        $pdf = PdfFacade::loadView('pages.report.invoice', compact('model'));
        $content = $pdf->download()->getOriginalContent();
        $pathName = 'public/pdf/'.rand(0,999999999).'.pdf';
        Storage::put($pathName, $content);
        $pdfFile = Storage::get($pathName);
        
        $pdf = new Pdf($pdfFile);
        $pdf->saveImage(asset('public/image'));
    }

    public function invoice($id){
        $model = Transaksi::with('transaksiDetail.kamar.tipeKamar')
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        $pdf = PdfFacade::loadView('pages.report.invoice', compact('model'));
        return $pdf->download();
    }

    protected function getTransactionCode(){
        $code ="BOOK-".Transaksi::count()+1;
        return $code;
    }
}
