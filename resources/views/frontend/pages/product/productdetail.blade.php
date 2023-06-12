@extends('frontend.layout.layout')
@section('title') Ürün Detay @endsection

@section('content')


        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="{{route('homepage')}}">Anasayfa</a>
                        <span class="mx-2 mb-0">/</span>
                        <a href="{{route('products')}}">Ürünler</a>
                        <span class="mx-2 mb-0">/</span>
                        <strong>{{$product->product_name}}</strong>

                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('/img/products').'/'.$product->product_image}}" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-black">{{$product->product_name}}</h2>
                        <hr>
                        <p>{{$product->product_short_text}}</p>
                        <hr>
                        <p class="mb-4">{{$product->product_desc}}</p>
                        <hr>
                        <p><strong class="text-primary h4">{{$product->product_price}} TL </strong></p>
                        <hr>



                                <h4 style="color: #2d3748"> Renk = {{$product->color}}</h4>
                        <hr>
                                <h4 style="color: #2d3748">Tahmini Boyutu = {{$product->size}}</h4>


                        <hr>
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">


                                </div>

                                <div class="col">


                                    <input style="text-align: center;color: #fc5286" type="text" id="quantity" class="form-control" value="{{$product->product_quantity}}">
                                    <h4 style="color: #0e1014;text-align: center" for="quantity">STOK</h4>
                                </div>



                        </div>

                        </div>
                        <hr>
                        <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">İletişime geç!</a></p>

                    </div>
                </div>
            </div>
        </div>



@endsection
