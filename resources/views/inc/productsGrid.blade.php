  {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10 flex-1 bg-base-200">
    @foreach ($products as $p)
      <a  href="/product/{{$p->id}}" class="card card-compact shadow-sm hover:shadow-lg bg-base-100 relative product-card">
        <figure><img class="w-full h-96 object-cover" src="/images/stock/{{$p->images->first()->image_name}}" alt="{{$p->name}}" /></figure>
        <div class="card-body flex flex-col justify-between">
          <div>
            <h2 class="card-title">{{$p->name}}</h2>
            @foreach ($p->categories as $cat)
                <span class="badge mr-2">{{$cat->name}}</span>
            @endforeach
          </div>
          
          <div class="card-actions justify-between mt-5">
        <span class="text-lg font-bold badge p-4 badge-info"><i class="fa fa-dollar"></i>{{$p->price}}</span>
          </div>
        </div>
      </a>
    @endforeach
</div> --}}

<div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-2 xl:grid-cols-3 xl:gap-x-8 p-6 flex-1">
  @foreach ($products as $p)
  <a href="/product/{{$p->id}}" class="group">
    <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
      <img src="/images/stock/{{$p->images->first()->image_name}}" alt="{{$p->name}}" class="w-full h-96 object-center object-cover group-hover:opacity-75">
    </div>
    <h3 class="mt-4 text-sm text-gray-700">{{$p->name}}</h3>
    <p class="mt-1 text-lg font-medium text-gray-900">${{$p->price}}</p>
  </a>
@endforeach
</div>