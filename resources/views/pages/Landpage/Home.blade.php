@extends('layouts.app-layout')

@section('title','Home')

@section('content')

@include('inc.slider')

@include('inc.categories')
<div class="divider"></div>
<h1 class="text-center my-4 text-4xl font-light font-sans">Check out our latest products</h1>
<div class="divider"></div>

@include('inc.productsgrid')

<a class="btn btn-outline rounded-full btn-lg float-left mx-auto my-7" href="/products">See more</a>
@endsection
