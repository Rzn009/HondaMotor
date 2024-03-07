<?php

namespace App\Http\Controllers;

use App\Models\Honda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HondaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $honda = Honda::latest()->paginate(1);

        $title = 'Honda I';
        return view('Honda.index' , compact('title','honda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $honda = Honda::all();
        $title = 'create Honda';

        return view('Honda.create', compact('title','honda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:5120',
        ]);

        $imgae = $request->file('image');
        $imgae->storeAs('public/honda' , $imgae->hashName());

        Honda::create([
            'name'=> $request->name,
            'slug' =>Str::slug($request->name),
            'image' => $imgae->hashName(),
        ]);

        return redirect()->route('honda.index')->with(['succes' => 'data berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'edit';
        $honda = Honda::find($id);
        return view('Honda.edit', compact('title','honda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:225',
            'image' => 'image|mimes:png,jpg,jpeg,gif|max:5120'
        ]);


        // get data by id
        $honda = Honda::find($id);
        // ubah kondisi
        if (
            $request->file('image') == ''
        ) {
            $honda->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            return redirect()->route('honda.index');
        } else {
            // jika gambar nya pengen di update
            //hapus img lama
            $image = $request->file('image');

            $image->storeAs('public/honda', $image->hashName());

            Storage::disk('local')->delete('public/honda/' . basename($honda->image));
            

            // upload img baru


            //upload data 
            $honda->update([
                'name'=>$request->name,
                'slug'=>str::slug($request->name),
                'image'=>$image->hashName()
            ]);

            return redirect()->route('honda.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $honda = Honda::find($id);
        Storage::disk('local')->delete('public/honda' . basename($honda->image));
        $honda->delete();


        return redirect()->route('honda.index')->with('Nice', 'Data berhasil di delete');
    }
}
