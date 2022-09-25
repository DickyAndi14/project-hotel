<?php

namespace App\Http\Controllers;

use App\Http\Requests\FasilitasKamarRequest;
use App\Models\FasilitasKamar;
use Yajra\DataTables\Facades\DataTables;

class FasilitasKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $model = FasilitasKamar::with('kamar', 'fasilitas')->get();
            return DataTables::of($model)
                ->addColumn('_', function($row){
                    return '<button type="button" class="btn btn-info btn-sm" onclick="view('.$row->id.')">Lihat</button>
                        <button type="button" class="btn btn-warning text-light btn-sm" onclick="edit('.$row->id.')">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="destroy('.$row->id.')">Hapus</button>';
                })
                ->rawColumns(['_'])
                ->make(true);
        }

        return view('pages.fasilitas_kamar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.fasilitas_kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FasilitasKamarRequest $request)
    {
        if(FasilitasKamar::create([
            'kamar_id' => request('kamar_id'),
            'fasilitas_id' => request('fasilitas_id'),
        ])){
            return response()->json([
                'status' => true,
                'message' => 'Fasilitas Kamar berhasil ditambahkan'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fasilitas Kamar gagal ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = FasilitasKamar::find($id);
        return view('pages.fasilitas_kamar.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = FasilitasKamar::find($id);
        return view('pages.fasilitas_kamar.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FasilitasKamar $request, $id)
    {
        $model  = FasilitasKamar::find($id);
        if($model->update([
            'kamar_id' => request('kamar_id'),
            'fasilitas_id' => request('fasilitas_id'),
        ])){
            return response()->json([
                'status' => true,
                'message' => 'Fasilitas Kamar berhasil diubah'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fasilitas Kamar gagal diubah'
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
        $model = FasilitasKamar::find($id);
        if($model->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Fasilitas Kamar berhasil dihapus'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fasilitas Kamar gagal dihapus'
        ]);
    }
}
