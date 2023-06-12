@extends('backend.layout.app')
@section('content')

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif


<div class="col-12 grid-margin stretch-card">
<div class="card">
    <button class="btn btn-primary mr-2"><a style="color: whitesmoke" href="{{route('product.index')}}">Listeye Dön</a></button>



    <div class="card-body">
        <h4 class="card-title">Yeni product Oluşturma</h4>

        <form class="forms-sample" action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Ürün Resmi</label>
                <input accept=".jpg, .png" type="file" name="image" class="file-upload-default">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="{{$product->product_image ?? 'Resim Yükleyiniz'}}">
                    <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Resmi Yükle</button>
                </span>
                </div>
                </div>




            <div class="form-row">
                <img style="width: 400px; height: 400px" src="{{asset('img/products/'.$product->product_image ?? '')}}" alt="{{$product->product_desc}}">

                <div class="form-group col-md-3">
                    <label for="status">Boyut</label>
                    <select  name="size" class="form-control" id="size">
                        @foreach($sizes as $size)
                            <option selected="{{$product->size}}" value="{{$size}}">{{$size}} </option>
                        @endforeach
                    </select>

                    <hr>
                    <label for="status">Ait olduğu Kategori = <strong>{{$product->category->name}}</strong></label>
                    <td  class="py-lg-2">
                        <img id="image" style="width:50px; height:50px" src="{{asset('img/category/').'/'.$product->category->image ?? '' }}"
                             alt="{{$product->category->content}}">
                    </td>


                <div class="form-group">
                    <label for="name">Kategori</label>

                    <select  name="cat_ust" class="form-control" id="cat_ust">
                        <option selected value="{{$product->category->id}}">{{$product->category->name}} </option>
                        @foreach($categories as $cats)
                            <option  name="cat_ust" value="{{$cats->id}}"> {{$cats->name}}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="status">Renk</label>
                    <select  name="color" class="form-control" id="color">
                        <option  selected="{{$product->color}}" value="{{$product->color}}">{{$product->color}} </option>
                        @foreach($colors as $color)
                            <option value="{{$color}}">{{$color}} </option>

                        @endforeach

                    </select>
                </div>
            </div>




            <div class="form-group">
                <label for="name">İsmi</label>
                <input type="text" class="form-control" id="name" name="product_name" value="{{$product->product_name}}" placeholder="Ürün Başlık">
            </div>

            <div class="form-group">
                <label for="contentt">Açıklaması</label>
                <textarea type="text" class="form-control" id="contentt" name="product_desc" placeholder="Açıklama">{{$product->product_desc ?? '' }}</textarea>
            </div>


            <div class="form-row">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputCity">Fiyat</label>
                        <input type="text" class="form-control" id="product_price" name="product_price"value="{{$product->product_price}}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputZip">Adet</label>
                        <input type="text" class="form-control" value="{{$product->product_quantity}}" id="product_quantity" name="product_quantity">
                    </div>
                </div>





            </div>

            <div class="form-group">
                <label for="status">Durumu</label>
                <select  name="status" class="form-control" id="status">
                    <option @if($product->status == 1) selected="{{$product->status}} @endif" value="1">Aktif </option>
                    <option @if($product->status == 0) selected=" {{$product->status}} @endif" value="0">Pasif </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Güncelle</button>
            <button  class="btn btn-light"><a href="{{route('product.index')}}">Geri Dön</a></button>
        </form>


    </div>
</div>
</div>
@endsection


