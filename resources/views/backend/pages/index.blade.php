@extends('backend.layout.app')

@section('content')


<div class="row">
<div class="col-md-12 grid-margin">
    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Hoşgeldin {{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
        </div>

    </div>
</div>
</div>




@endsection
