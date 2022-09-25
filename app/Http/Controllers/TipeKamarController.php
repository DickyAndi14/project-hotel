<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipeKamarRequest;
use App\Models\TipeKamar;
use Yajra\DataTables\Facades\DataTables;

class TipeKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return DataTables::of(TipeKamar::get())
                ->addColumn('_', function($row){
                    return '<button type="button" class="btn btn-info btn-sm" onclick="view('.$row->id.')">Lihat</button>
                        <button type="button" class="btn btn-warning text-light btn-sm" onclick="edit('.$row->id.')">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="destroy('.$row->id.')">Hapus</button>';
                })
                ->rawColumns(['_'])
                ->make(true);
        }
        return view('pages.tipe_kamar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tipe_kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipeKamarRequest $request)
    {
        if(TipeKamar::create([
            'name' => request('name')
        ])){
            return response()->json([
                'status' => true,
                'message' => 'Tipe Kamar berhasil ditambahkan'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Kamar gagal ditambahkan'
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
        $model = TipeKamar::find($id);
        return view('pages.tipe_kamar.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = TipeKamar::find($id);
        return view('pages.tipe_kamar.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipeKamarRequest $request, $id)
    {
        $model = TipeKamar::find($id);
        if($model->update([
            'name' => request('name')
        ])){
            return response()->json([
                'status' => true,
                'message' => 'Kamar berhasil diubah'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Kamar gagal diubah'
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
        $model = TipeKamar::find($id);
        if($model->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Kamar berhasil dihapus'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Kamar gagal dihapus'
        ]);
    }
}
