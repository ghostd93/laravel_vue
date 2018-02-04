@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <img src="https://pbs.twimg.com/profile_images/906048605168865284/AymcMRgq_400x400.jpg"
                     alt="horse" class="img-responsive">
                <br>
                {{ $product->name }}
                <br>
                <add-to-basket :product="{{ $product }}"></add-to-basket>
            </div>
        @endforeach
    </div>
@endsection