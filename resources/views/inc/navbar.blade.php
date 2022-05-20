<nav class="fixed inset-0 bg-neutral-focus flex flex-col justify-center items-center text-gray-200" style="z-index: 90">
    <a href="/">Home</a>
    <a href="/products">Products</a>
    <a href="">Categories</a>
    <a href="">Contact us</a>
 
</nav>

<div class="fixed inset-x-0 top-0 bg-base-300/80 backdrop-blur-sm flex items-center justify-between px-10 py-5 shadow-lg" style="z-index: 89"> 
<a href="/" class="text-4xl font-bold"><span class="text-primary">Sh</span>opify</a>

<div class="flex items-center">
     @if (Auth::check())
                <a href="/profile" class="bg-base-300/25 hover:bg-base-300/50 p-3 ease-in-out duration-300 rounded-full flex items-center text-lg">
                    @if (Auth::user()->avatar)
                        <img src="/images/{{Auth::user()->avatar->title}}" alt="profile picture" class="rounded-full pf sm"/>   
                    @else
                        <i class="fa-solid fa-user mx-2"></i>
                    @endif
                    <span class="mx-2">{{Auth::user()->name}}</span>
                </a>

                <div class="indicator mx-4">
                @if (Auth::user()->cart_items->count() > 0)
                <span class="indicator-item badge badge-primary">{{Auth::user()->cart_items->count()}}</span> 
                @endif
                <a href="/cart"><i class="fa fa-cart-shopping text-2xl"></i></a>
            </div>
            {!! Form::open(['url' => '/logout' , 'method' =>'DELETE' ,'class' => 'ml-3']) !!}
                {{Form::submit('Log out' , ['class' => 'btn btn-outline'])}}
            {!! Form::close() !!}

        @endif

        @if (! Auth::check())
        <a href="/login" class="btn btn-primary mx-2 btn-md md:btn-lg">Login</a>
        <a href="/signup" class="btn btn-outline mx-2 btn-md md:btn-lg">Register</a>

        @endif
</div>





</div>

<div class="flex flex-col cursor-pointer right-5 top-1/4 fixed bg-base-100/80 rounded-full p-5 shadow-md" id="nav-bars" style="z-index: 99">
    <div class="bar bg-gray-500"></div>
    <div class="bar bg-gray-500"></div>
</div> 

