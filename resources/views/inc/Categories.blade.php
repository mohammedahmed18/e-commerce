<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mx-auto gap-5">
    @foreach ($categories as $cat)
    
    @if($cat->products->first())
    <div class="card w-96 bg-base-100 shadow-xl image-full m-3">
        <figure><img src="images/stock/{{$cat->products->first()->images->first()->image_name}}" alt="category cover"></figure>
        <div class="card-body flex">
          <h2 class="card-title text-3xl">{{$cat->name}}</h2>
            <p></p>
          <div class="card-actions justify-end">
            <a href="/products?category={{$cat->id}}" class="btn btn-primary btn-lg">Shop</a>
          </div>
        </div>
      </div> 
    @endif

@endforeach
</div>