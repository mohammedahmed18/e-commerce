@extends('layouts.app-layout')
@section('title' , $product->name)

@section('content')
    <div class="flex flex-col md:flex-row items-center justify-center h-auto md:h-screen my-40 overflow-hidden mx-10">
    {{-- images --}}
    <div class= "w-full md:w-1/2 h-full swiper">
        <div class="swiper-wrapper h-full">
            @foreach ($product->images as $image)
            <div class="swiper-slide min-w-full">
                    <img class="object-cover h-full w-full" src="/images/stock/{{$image->image_name}}" />
            </div>
            @endforeach
         </div>

         <!-- If we need navigation buttons -->
        <div class="bg-base-200/50 swiper-button-prev left-0"></div>
        <div class="bg-base-200/50 swiper-button-next right-0"></div>

       
    </div>
    {{-- content --}}
    <div class="w-full md:w-1/2 flex flex-col bg-base-200 h-screen p-7 w-full justify-between">
    
    <div class="flex flex-1 flex-col justify-center">

        <h1 class="text-7xl font-bold">{{$product->name}}</h1>
        <span class="block text-6xl font-light text-gray-500 my-5">$ {{$product->price}}</span>
        <p class="text-lg italic my-4">{{$product->description}}</p>
        <div class="divider"></div>
    </div>

@if ($product->stock == 0)
    <p class="text-center text-error text-6xl">Out of Stock</p>
@else
    
    {!! Form::open(['url' => '/add-to-cart' , 'class' => 'w-full flex flex-col']) !!}
    @if ($addedToCart)
    <div class="flex text-lg">
        <p class="mr-5">Already Added to Cart</p>
        <a href="/cart" class="link">Got to your cart</a>        
    </div>
    @else
    <div class="flex items-center justify-center text-5xl">
        <label class="font-light">Quantity</label> 
        <input type="number" min="0" value="1" class="input bg-base-200 float-left ml-4 mr-auto text-4xl w-40" id="quantity" name="quantity" />
    </div>
    <input type="text" value="{{$product->id}}" name="product_id" hidden />

    <div class="divider"></div>


    <button type="submit" class="btn btn-primary w-full rounded-none tracking-wider mx-2 my-7 btn-lg" id="addToCart">Add to Cart</button>
    @endif
    {!! Form::close() !!}
    

    @endif


    </div>

</div>
@endsection