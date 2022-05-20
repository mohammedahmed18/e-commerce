<div class="overflow-x-auto">
<table class="table table-zebra w-full text-sm md:text-lg lg:text-lg">
    <!-- head -->
    <thead>
      <tr>
        <th></th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Added by</th>
        <th>Stock</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $p)
          <tr>
              <th></th>
              <td> <img class="w-20 h-20 object-cover mr-3" src='/images/stock/{{$p->images[0]->image_name}}'/>
              </td>
              <td class="font-bold italic">{{$p->name}}</td>
              <td>{{$p->price}} <i class="fa fa-dollar"></i></td>
              <td>{{$p->admin->name}}</td>
              <td>
                @if ($p->stock==0)
                    <span class="text-error">out of stock</span>
                @else
                <span>{{$p->stock}}</span>
                @endif
              </td>
              
              <td>
              <a class="btn btn-outline" href="/dashboard/products/edit/{{$p->id}}">
                  <i class="fa fa-pen"></i>
              </a>
            </td>

            <td>
              <a class="btn btn-error" onclick="confirmDelete('http://{{Request::getHttpHost()}}/product/{{$p->id}}', '{{$p->name}}' , '/{{Request::path()}}?page={{app('request')->input('page')}}')">
                  <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{-- onclick="window.confirmDelete('http://{{Request::getHttpHost()}}/category/{{$cat->id}}', '{{$cat->name}}' , '/dashboard/categories')" --}}