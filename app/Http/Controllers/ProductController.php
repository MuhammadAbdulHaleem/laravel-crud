<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //This method will show products page
    public function index(){
        $products = Product::orderBy('created_at',"DESC")->get();

        return view('products.list',[
            'products' => $products
        ]);
    }

    // This method will create product page
    public function create(){
        return view('products.create');
    }

    // This method will store or insert product in db
    public function store(Request $request){
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }
        
       $validator = Validator::make($request->all(),$rules);

       if ($validator->fails()){
        return redirect()->route('products.create')->withInput()->withErrors($validator);
       }

       if($request->image != ""){
            //    here we will insert product into database
            $product = new Product();
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();
    
            // here we will store image
            $image = $request->image;
            $ext =  $image -> getClientOriginalExtension();
            $imageName = time() . ".".$ext;

            // save image in products directory
            $image->move(public_path('uploads\products'),$imageName);

            // here we will save image in database
            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('products.index')->with('success','Product added Successfully');
    }

    // This method will show edit product page
    public function edit($id){
        $product = Product::FindOrFail($id); 
        return view('products.edit',[
           'product' => $product
        ]);
    }

    // This method will update product
    public function update($id,Request $request){
        $product = Product::FindOrFail($id); 
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }
        
       $validator = Validator::make($request->all(),$rules);

       if ($validator->fails()){
        return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
       }

       if($request->image != ""){

            File::delete(public_path('uploads/products/'.$product->image));


            //    here we will update product into database
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();
    
            // here we will store image
            $image = $request->image;
            $ext =  $image -> getClientOriginalExtension();
            $imageName = time() . ".".$ext;

            // save image in products directory
            $image->move(public_path('uploads\products'),$imageName);

            // here we will save image in database
            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('products.index')->with('success','Product updated Successfully');
    }

    // This method will delete product
    public function destroy($id){
        $product = Product::FindOrFail($id);

        // delete image 
        File::delete(public_path('uploads/products/'.$product->image));

        $product->delete();

        return redirect()->route('products.index')->with('success','Product Deleted Successfully');

    }
}
