<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function products(Request $request, $slug = null, $id = null)

    {

        $size = $request->size ?? null;

        $search = $request->search ?? null;

        $color = $request->color ?? null;

        $price_min = $request->price_min ?? null;

        $price_max = $request->price_max ?? null;

        $search = $request->search ?? null;



        //SIRALAMA
        $order = $request->order ?? 'id';
        $sort = $request->sort ?? 'desc';


        //KATEGORİLERİ FİLTRELE

        $categories = Category::withCount('product')->get();
        $data = array();

        foreach ($categories as $category) {
            $result = array();
            foreach ($category->child as $key => $sub) {
                array_push($result, $sub->product->toArray());
            }
            $product = call_user_func_array('array_merge', $result);

            $data[$category->id] = count($product);

        }





//ÜRÜNLERİ LİSTELE


        $products = Product::where('status', '1')->where(function ($query) use ($size, $color, $price_min, $price_max, $search) {

            if (!empty($size)) {
                $query->where('size', [$size]);
            }


            if (isset($color) && !empty($color)) {
                $query->where('color', [$color]);
            }

            if (isset($price_min) && !empty($price_min)) {
                $query->where('product_price', '>=', $price_min);
            }

            if (isset($price_max) && !empty($price_max)) {
                $query->where('product_price', '<=', $price_max);
            }

            if (isset($search)) {
                $query->where('product_name', 'LIKE', "%$search%");
            }
            return $query;

        })
            ->with('category')
            ->whereHas('category', function ($q) use ($slug) {

                if (!empty($slug)) {

                    return $q->where('slug', $slug);

                }


            })->orderBy($order, $sort)->paginate(10);


        $category_products = Category::with('products','child.product')->where( function ($q) use ($slug)
        {

            return $q->where('slug',$slug);

        })->orderBy($order, $sort)->paginate(10);



        //KARIŞIK KATEGORİLER
        $random_categories = Category::select('id', 'name', 'image', 'slug')->where('cat_ust', null)->inRandomOrder()->limit(3)->get();


        //renklere göre filtre
        $color_lists = Product::where('status', '1')->groupBy('color')->pluck('color')->toArray();

        //boyuta göre filtre
        $size_lists = Product::where('status', '1')->groupBy('size')->pluck('size')->toArray();

        return view('frontend.pages.product.products',
            compact( 'products','categories', 'size_lists', 'color_lists','random_categories', 'data','category_products'));
    }
    public function productDetail(Request $request)
    {
        $product = Product::where('id', $request->id)->first();


        return view('frontend.pages.product.productdetail', compact('product'));
    }


    public function allProducts(Request $request, $slug=null,$id=null){




        $size = $request->size ?? null;

        $search = $request->search ?? null;

        $color = $request->color ?? null;

        $price_min = $request->price_min ?? null;

        $price_max = $request->price_max ?? null;

        $search = $request->search ?? null;


        //SIRALAMA
        $order = $request->order ?? 'id';
        $sort = $request->sort ?? 'desc';


        //KATEGORİLERİ FİLTRELE

        $categories = Category::withCount('product')->get();
        $data = array();
        foreach ($categories as $category) {
            $result = array();
            foreach ($category->child as $key => $sub) {
                array_push($result, $sub->product->toArray());
            }
            $product = call_user_func_array('array_merge', $result);
            $data[$category->id] = count($product);

        }


//ÜRÜNLERİ LİSTELE


        $products = Product::where('status', '1')->where(function ($query) use ($size, $color, $price_min, $price_max, $search) {

            if (!empty($size)) {
                $query->where('size', [$size]);
            }


            if (isset($color) && !empty($color)) {
                $query->where('color', [$color]);
            }

            if (isset($price_min) && !empty($price_min)) {
                $query->where('product_price', '>=', $price_min);
            }

            if (isset($price_max) && !empty($price_max)) {
                $query->where('product_price', '<=', $price_max);
            }

            if (isset($search)) {
                $query->where('product_name', 'LIKE', "%$search%");
            }
            return $query;

        })
            ->with('category:id,name,slug,cat_ust')
            ->whereHas('category', function ($q) use ($slug) {

                if (!empty($slug)) {

                    return $q->where('slug', $slug);
                }

                return $q;
            })->orderBy($order, $sort)->paginate(8);





        //KARIŞIK KATEGORİLER
        $random_categories = Category::select('id', 'name', 'image', 'slug')->where('cat_ust', null)->inRandomOrder()->limit(3)->get();


        //renklere göre filtre
        $color_lists = Product::where('status', '1')->groupBy('color')->pluck('color')->toArray();

        //boyuta göre filtre
        $size_lists = Product::where('status', '1')->groupBy('size')->pluck('size')->toArray();




        return view('frontend.pages.product.allproducts',compact('products','color_lists',
            'size_lists','random_categories','categories','data'
        ));
    }
}
