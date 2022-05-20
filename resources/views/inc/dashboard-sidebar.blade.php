<div id="dashboard-sidebar" class="bg-accent w-full md:w-1/4 opacity-0 h-auto md:min-h-screen flex flex-col justify-between">
  {{-- icon --}}
<div class="dropdown absolute top-3 left-3 z-10">
    <label tabindex="0" class="btn m-1 btn-accent"><i class="fa fa-ellipsis-vertical"></i></label>
    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
      <li><a href="/dashboard/profile">Profile</a></li>
      <li>
        {!! Form::open(['url' => '/dashboard/logout']) !!}
            {{Form::submit('Log out' , ['class' => "w-full rounded-0 cursor-pointer text-left"])}}
         {!! Form::close() !!}
      </li>
    </ul>
  </div>
  
    <div class="flex flex-col w-full py-10 pb-14 mb-5 bg-neutral/25 items-center dashboard-header">
        <img class="w-40 h-40 md:w-28 md:h-28 rounded-full my-3 p-1 mx-auto ring ring-primary ring-offset-info ring-offset-4 object-cover"
        src={{Auth::guard('admin')->user()->avatar ? "/images/avatars/".Auth::guard('admin')->user()->avatar->title : "/images/avatar.jpg" }}
        alt="profile picture"
      />    
        <h1 class="text-gray-300 font-bold text-xl my-3">{{Auth::guard('admin')->user()->name}}</h1>
        <p class="text-gray-400 text-md">Admin manager</p>
        @if (Auth::guard("admin")->user()->is_super)
            <span class="badge badge-info mb-7">super admin</span>
        @endif
    </div>
{{-- //////////////////////////////////////////////////////// --}}
<div class="flex-1 flex flex-col flex-wrap overflow-y-auto">
<a href="/dashboard" class="bg-primary/25 py-6 px-3 border-solid border-b-2 border-primary/75 text-gray-200
                {{Request::path() == 'dashboard' ? 'active':''}}
                hover:bg-primary/75 ease-in-out duration-300 font-semibold text-lg 
"> <i class="fa fa-house mr-2"></i> Home</a>


<a href="/dashboard/products?page=1" class="bg-primary/25 py-6 px-3 border-solid border-b-2 border-primary/75 text-gray-200
                hover:bg-primary/75 ease-in-out duration-300 font-semibold text-lg
                {{Request::path() == 'dashboard/products' ? 'active':''}}
"> <i class="fa fa-boxes-stacked mr-2"></i> Products</a>


<a href="/dashboard/categories" class="bg-primary/25 py-6 px-3 border-solid border-b-2 border-primary/75 text-gray-200
                hover:bg-primary/75 ease-in-out duration-300 font-semibold text-lg
                {{Request::path() == 'dashboard/categories' ? 'active':''}}
"> <i class="fa fa-table-cells"></i> Categories</a>



<a href="/dashboard/orders" class="bg-primary/25 py-6 px-3 border-solid border-b-2 border-primary/75 text-gray-200
                hover:bg-primary/75 ease-in-out duration-300 font-semibold text-lg
                {{Request::path() == 'dashboard/orders' ? 'active':''}}
"> <i class="fa fa-cart-arrow-down mr-2"></i> Orders</a>  


<a href="/dashboard/users" class="bg-primary/25 py-6 px-3 border-solid border-b-2 border-primary/75 text-gray-200
                hover:bg-primary/75 ease-in-out duration-300 font-semibold text-lg
                {{Request::path() == 'dashboard/users' ? 'active':''}}
"> <i class="fa fa-users mr-2"></i> Users</a>  

{{-- 
<a href="" class="bg-primary/25 py-6 px-3 border-solid border-b-2 border-primary/75 text-gray-200
                hover:bg-primary/75 ease-in-out duration-300 font-semibold text-lg
                {{Request::path() == 'dashboard/messages' ? 'active':''}}
"><i class="fa fa-message"></i> Messages<span class="indicator-item badge ml-3">8</span></a>


<a href="" class="bg-primary/25 py-6 px-3 border-solid border-b-2 border-primary/75 text-gray-200
                hover:bg-primary/75 ease-in-out duration-300 font-semibold text-lg
                {{Request::path() == 'dashboard/admins' ? 'active':''}}
"><i class="fa fa-users"></i> Admins</a> --}}
</div>


{{-- //////////////////////////////////////////////////////// --}}
    <div class="bg-primary/50 py-4 text-gray-300 text-sm text-center">
        &copy; {{date("Y")}} , All rights reserved 
    </div>
</div>