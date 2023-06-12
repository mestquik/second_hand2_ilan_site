<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

use App\Models\Slider;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();

        return view('backend.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $categories = Category::where('cat_ust',null)->get();
        $subcategories = Category::with('child')->where('cat_ust','!=',null)->get();


        $colors = Product::GroupBy('color')->pluck('color')->toArray();
        $sizes = Product::GroupBy('size')->pluck('size')->toArray();

        return view('backend.pages.product.create',compact('sizes','colors','categories','subcategories'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $file_name = $request->product_name;
        }
        $image_url = urunYukle($image, $file_name);

        Product::create([
            'product_image' => $image_url  ?? null,
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'size' => $request->size,
            'color' => $request->color,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);
        return redirect()->back()->with('success', 'Ürün Başarıyla Oluşturuldu');;



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {



        $colors = Product::groupBy('color')->pluck('color')->toArray();
        $sizes = Product::groupBy('size')->pluck('size')->toArray();


        $product = Product::where('id', $id)->with('category')->first();
        $categories = Category::where('cat_ust','!=',null)->get();
        return view('backend.pages.product.edit', compact('product', 'colors','sizes','categories'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::where('id', $id)->first();
        $product_image  = $product->product_image;
        $file_name = $request->product_name;

        if ($request->hasFile('image')) {
            dosyaSil($product_image);
            $image = $request->file('image');
            $image_url = urunYukle($image, $file_name);

            $product->update([
                'product_image' => $image_url ?? null,
                'category_id' => $request->cat_ust,
                'product_name' => $request->product_name,
                'product_desc' => $request->product_desc,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'size' => $request->size,
                'color' => $request->color,
                'status' => $request->status,
            ]);
        }
        else {
            $product->update([

                'product_name' => $request->product_name,
                'category_id' => $request->cat_ust,
                'product_desc' => $request->product_desc,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'size' => $request->size,
                'color' => $request->color,
                'status' => $request->status,
                ]);
        }

        return redirect()->back()->with('success', 'Ürün Başarıyla Güncellendi');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::where('id',$id)->FirstOrFail();
        $image_path = public_path('img/products/'.$product->product_image);


        dosyaSil($image_path);
        $product->delete();
        return back()->withSuccess('Ürün başarıyla silindi!');
    }

    public function updateStatu(Request $request)
    {
        $update = $request->statu;
        $updateText = $update == "true" ? '1' : '0';

        Product::where('id',$request->id)->update(['status'=>$updateText]);

        return response(['error'=>false,'status'=>$update]);


    }


    public function subCat(Request $request)
    {

        $cat = Category::where('id', $request->categoryID)->orderby("categoryID", 'subcategoryID')->get();
        return response(['error'=>false,'cat'=>$cat]);

    }


}
