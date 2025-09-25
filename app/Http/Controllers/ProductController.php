<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product;
use App\Models\Category_product;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;

use illuminate\Support\Facades\Storage;
//import return type view
use Illuminate\View\View;

//import request
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index(): View
    {
        //get all products
        $product = new Product;
        $products = $product->get_product()->latest()->paginate(10);

        //render view with products
        return view('products.index', compact('products'));
    }

    /**
     * create
     * 
     * @return void
     */
    public function create(): View
    {
        $product = new Category_product();
        $data['categories'] = $product->get_category_product()->get();

        $supplier = new Supplier();
        $data['supplier'] = $supplier->get_supplier()->get();
        return view('products.create', compact('data'));
    }

    /**
     * store
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //var_dump($request);exit;
        //validate form
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|min:5',
            'product_category' => 'required|integer',
            'description' => 'required|min:10',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);
        
        //menghandle upload file gambar
        if($request->hasFile('image')){
            $image = $request->file('image');
            $store_image=$image->store('images', 'public');// simpan gambar ke folder penyimpanan

            $product= new Product;
            $insert_product = $product->storeProduct($request, $image);

            return redirect()->route('products.index')->with('success', 'Data Berhasil Disimpan!.');
        }
        
        return redirect()->route('products.index')->with('error', 'Failed to upload image.');
    }
}