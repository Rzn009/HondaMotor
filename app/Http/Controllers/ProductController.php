<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = 'product';
        $product = Product::latest()->paginate(2);

        return view('product.index', compact('title', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'create';
        $product = Product::latest()->paginate(5);
        return view('product.create', compact('title', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:5120',
            'warna' => 'required',
            'price' => 'required',
        ]);

        //uploud image
        $image = $request->file('image');
        //fungsi hash untuk menjadi memberikan nama acak 
        $image->storeAs('public/product', $image->hashName());

        //create data
        Product::create([
            'name' => $request->name,
            'warna' => $request->warna,
            'image' => $image->hashName(),
            'price' => $request->price
        ]);

        return redirect()->route('product.index')->with(['succes' => 'Data berhasil']);
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
        $product = Product::find($id);
        return view('product.edit', compact('title', 'product'));
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
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:5120',
            'warna' => 'required',
            'price' => 'required',
        ]);


        // get data by id
        $product = Product::find($id);
        // ubah kondisi
        if (
            $request->hasFile('image') == ''
        ) {
            $image = $request->file('image'); // Retrieve the new image file
            $imageName = $image->hashName();
            // Store the new image and delete the old one
            $image->storeAs('public/product', $image);
            Storage::delete('public/product/' . $product->image);
            $product->update([
                'name' => $request->name,
                'warna' => $request->warna,
                'image' => $image->hashName(),
                'price' => $request->price
            ]);

            return redirect()->route('product.index');
        } else {
            // jika gambar nya pengen di update
            //hapus img lama
            $image = $request->file('image');

            $image->storeAs('public/product', $image->hashName());

            Storage::disk('local')->delete('public/product/' . basename($product->image));


            // upload img baru


            //upload data 
            $product->update([
                'name' => $request->name,
                'warna' => $request->warna,
                'image' => $image->hashName(),
                'price' => $request->price
            ]);

            return redirect()->route('product.index');
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
        $product = Product::find($id);
        Storage::disk('local')->delete('public/category' . basename($product->image));
        $product->delete();


        return redirect()->route('product.index')->with('Nice', 'Data berhasil di delete');
    }
}
