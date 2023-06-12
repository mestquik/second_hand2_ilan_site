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
                <h4 class="card-title">Yeni Ürün Oluşturma</h4>

                <form class="forms-sample" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Ürün Resmi</label>
                        <input accept=".jpg, .png" type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Resim Yükleyiniz">
                            <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Resmi Yükle</button>
                </span>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="status">Boyut</label>
                            <select  name="size" class="form-control" id="size">
                                @foreach($sizes as $size)

                                    <option value="{{$size}}">{{$size}} </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-row">

                                <label class="form-label"
                                       for="CountryName">{{ trans('shippingprices.CountryName') }}</label>
                                <div class="mb-1">
                                    <select class="select2 form-select" id="categoryID" name="categoryID">
                                        <option selected disabled>{{ trans('shippingprices.Choose') }}...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label"
                                       for="subcategoryName">{{ trans('shippingprices.subcategoryName') }}</label>
                                <div class="mb-1">
                                    <select class="select2 form-select" id="subcategoryID" name="subcategoryID">
                                    </select>
                                </div>
                            </div>





                    </div>







                    <div class="form-group">
                        <label for="name">İsmi</label>
                        <input type="text" class="form-control" id="name" name="product_name" placeholder="Ürün Başlık">
                    </div>

                    <div class="form-group">
                        <label for="contentt">Açıklaması</label>
                        <textarea type="text" class="form-control" id="contentt" name="product_desc" placeholder="Açıklama"></textarea>
                    </div>


                    <div class="form-row">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCity">Fiyat</label>
                                <input type="text" class="form-control" id="product_price" name="product_price">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputZip">Adet</label>
                                <input type="text" class="form-control" id="product_quantity" name="product_quantity">
                            </div>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Güncelle</button>
                    <button  class="btn btn-light"><a href="{{route('product.index')}}">İptal</a></button>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('custom.js')



        <script type="text/javascript">
            $(document).on('change', 'CategoryID', function(e) {
            var categoryID = $(this).val();
            if (categoryID) {
            $.ajax({
                type: "POST",
            url: "{{ route('product.subCat','categoryID') }}",
            dataType: "json",
            success: function(data) {
            $('select[name="subcategoryID"]');
            var d = $('select[name="subcategoryID"]').empty();

            $.each(data, function(key, value) {
            $('select[name="subcategoryID"]').append(
            '<option value="' + value.subcategoryID + '">' + value
            .subcategoryName + '</option>');
        });
        },
        });
        } else {
            alert('danger');
        }
        });
    </script>

@endsection
