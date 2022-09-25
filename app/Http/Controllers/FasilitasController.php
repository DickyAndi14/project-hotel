<?php

namespace App\Http\Controllers;

use App\Http\Requests\FasilitasRequest;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return DataTables::of(Fasilitas::get())
                ->addColumn('_', function($row){
                    return '<button type="button" class="btn btn-info btn-sm" onclick="view('.$row->id.')">Lihat</button>
                        <button type="button" class="btn btn-warning text-light btn-sm" onclick="edit('.$row->id.')">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="destroy('.$row->id.')">Hapus</button>';
                })
                ->editColumn('picture', function($row){
                    return "<img src=".asset('storage/'.$row->picture)." width='100' height='100'>";
                })
                ->rawColumns(['_', 'picture'])
                ->make(true);
        }
        return view('pages.fasilitas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FasilitasRequest $request)
    {
        $file = request()->file('picture');
        $filePath = $file->storeAs('fasilitas', time(), 'public');
        $req = [
            'name' => request('name'),
            'desc' => request('desc'),
            'picture' => $filePath
        ];

        if(Fasilitas::create($req)){
            return response()->json([
                'status' => true,
                'message' => 'Fasilias berhasil ditambahkan'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fasilitas gagal ditambahkan'
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
        $model  = Fasilitas::find($id);
        return view('pages.fasilitas.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model  = Fasilitas::find($id);
        return view('pages.fasilitas.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FasilitasRequest $request, $id)
    {
        $model = Fasilitas::find($id);
        $file = request()->file('picture');

        if($file){
            // delete file
            $path = str_replace('/', '\\', $model->picture);
            if(Storage::exists('public\\'.$path)){
                Storage::delete('public\\'.$model->picture);
            }

            // add file
            $filePath = $file->storeAs('fasilitas', time(), 'public');
        }

        $req = [
            'name' => request('name'),
            'desc' => request('desc'),
            'picture' => $filePath ?? $model->picture
        ];

        if($model->update($req)){
            return response()->json([
                'status' => true,
                'message' => 'Fasilitas berhasil diperbarui'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Fasilitas gagal ditambahkan'
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
        $model = Fasilitas::find($id);
        $path = str_replace('/', '\\', $model->picture);
        if(Storage::exists('public\\'.$path)){
            Storage::delete('public\\'.$model->picture);
        }

        if($model->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Fasilitas berhasil dihapus'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Fasilitas gagal dihapus'
        ]);
    }
}
