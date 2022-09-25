<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class BukuTamuController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $model = TransaksiDetail::with('kamar', 'transaksi');
            if(request('from')){
                $model->where('checkin', '>=' , Carbon::parse(request('from'))->format('Y-m-d'));
            }
            if(request('to')){
                $model->where('checkout', '<=', Carbon::parse(request('to'))->format('Y-m-d'));
            }
            return DataTables::of($model)
            ->editColumn('_', function($row){
                switch($row->status){
                    case 0:
                        return "<button class='btn btn-danger btn-sm' onclick='update(".$row->id.")'>Check Out</button>";
                    default:
                        return "<button class='btn btn-success btn-sm' onclick='update(".$row->id.")'>Check In</button>";
                }
            })
            ->editColumn('checkin', function($row){
                return Carbon::parse($row->checkin)->toFormattedDateString();
            })
            ->editColumn('checkout', function($row){
                return Carbon::parse($row->checkout)->toFormattedDateString();
            })
            ->rawColumns(['_'])
            ->make(true);
        }
        return view('pages.buku_tamu.index');
    }

    public function update($id){
        $model = TransaksiDetail::find($id);
        switch($model->status){
            case 0:
                $kamar = Kamar::find($model->kamar_id);
                $jumlah = ($kamar->jumlah - $model->jumlah);
                $kamar->update(['jumlah' => $jumlah]);
                $model->update(['status' => 1]);
                return response()->json([
                    'status' => true,
                    'message' => 'Status berhasil diubah'
                ]);
            default :
                $kamar = Kamar::find($model->kamar_id);
                $jumlah = ($kamar->jumlah + $model->jumlah);
                $kamar->update(['jumlah' => $jumlah]);
                $model->update(['status' => 0]);
                return response()->json([
                    'status' => true,
                    'message' => 'Status berhasil diubah'
                ]);
        }
    }
}
