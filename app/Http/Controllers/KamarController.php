<?php

namespace App\Http\Controllers;

use App\Http\Requests\KamarRequest;
use App\Models\Kamar;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Kamar::with('tipeKamar')->get();
        if(request()->ajax()){
            return DataTables::of(Kamar::with('tipeKamar')->get())
                ->addColumn('_', function($row){
                    return '<button type="button" class="btn btn-info btn-sm" onclick="view('.$row->id.')">Lihat</button>
                        <button type="button" class="btn btn-warning text-light btn-sm" onclick="edit('.$row->id.')">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="destroy('.$row->id.')">Hapus</button>';
                })
                ->rawColumns(['_'])
                ->make(true);
        }
        return view('pages.kamar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KamarRequest $request)
    {
        $file = request()->file('banner');
        $filePath = $file->storeAs('banners', time(), 'public');
        $req = [
            'name' => request('name'),
            'tipe_kamar_id' => request('tipe_kamar_id'),
            'jumlah' => request('jumlah'),
            'banner' => $filePath
        ];

        if(Kamar::create($req)){
            return response()->json([
                'status' => true,
                'message' => 'Kamar berhasil ditambahkan'
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
        $model  = Kamar::find($id);
        return view('pages.kamar.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model  = Kamar::find($id);
        return view('pages.kamar.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KamarRequest $request, $id)
    {
        $model = Kamar::find($id);
        $file = request()->file('banner');

        if($file){
            // delete file
            $path = str_replace('/', '\\', $model->banner);
            if(Storage::exists('public\\'.$path)){
                Storage::delete('public\\'.$model->banner);
            }

            // add file
            $filePath = $file->storeAs('banners', time(), 'public');
        }

        $req = [
            'name' => request('name'),
            'tipe_kamar_id' => request('tipe_kamar_id'),
            'jumlah' => request('jumlah'),
            'banner' => $filePath ?? $model->banner
        ];

        if($model->update($req)){
            return response()->json([
                'status' => true,
                'message' => 'Kamar berhasil diperbarui'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Kamar gagal ditambahkan'
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
        $model = Kamar::find($id);
        $path = str_replace('/', '\\', $model->banner);
        if(Storage::exists('public\\'.$path)){
            Storage::delete('public\\'.$model->banner);
        }

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
