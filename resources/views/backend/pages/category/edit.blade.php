@extends('backend.layout.app')
@section('content')

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif


<div class="col-12 grid-margin stretch-card">
<div class="card">
    <button class="btn btn-primary mr-2"><a style="color: whitesmoke" href="{{route('category.index')}}">Listeye Dön</a></button>



    <div class="card-body">
        <h4 class="card-title">{{$category->name}} Kategorisinin Güncellenmesi</h4>

        <form class="forms-sample" action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Kategori Resmi</label>
                <input accept=".jpg, .png" type="file" name="image" class="file-upload-default">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="{{$category->image ?? 'Resim Yükleyiniz'}}">
                    <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Resmi Yükle</button>
                </span>



                </div>

                </div>


            <div class="form-row">
                <img style="width: 400px; height: 400px" src="{{asset('img/category/'.$category->image ?? '')}}" alt="{{$category->content}}">



                <div class="form-group col-md-2">
                    <label for="status">Altkategorileri</label>
                    <select  name="subcat" class="form-control" id="subcat">
                        @foreach($category->child as $child)
                            <option value="">{{$child->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="name">İsmi</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="Ürün Başlık">
            </div>

            <div class="form-group">
                <label for="contentt">Açıklaması</label>
                <textarea type="text" class="form-control" id="contentt" name="contentt" placeholder="Açıklama">{{$category->content ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <textarea type="text" class="form-control" id="slug" name="slug" disabled placeholder="Slug">{{$category->slug ?? '' }}</textarea>
            </div>







            <div class="form-group">
                <label for="status">Durumu</label>
                <select  name="status" class="form-control" id="status">
                    <option @if($category->status == 1) selected="{{$category->status}} @endif" value="1">Aktif </option>
                    <option @if($category->status == 0) selected=" {{$category->status}} @endif" value="0">Pasif </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Güncelle</button>
            <button  class="btn btn-light"><a href="{{route('category.index')}}">Geri Dön</a></button>
        </form>


    </div>
</div>
</div>
@endsection


