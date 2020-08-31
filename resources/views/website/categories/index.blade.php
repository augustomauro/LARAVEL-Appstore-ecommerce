@extends('website.layouts.website')
<!-- Index Template -->

@section('title')
Categories
@endsection


@section('content')

<div class="content-wrap">

    <h3 class="name-product">All Categories</h3>

    <div style="text-align: center; font-style: italic; font-size: medium">Total {{$categories_pag->total()}}
        categor<?= (count($categories_pag) > 1 ) ? 'ies' : 'y' ?> | In this Page {{count($categories_pag)}}</div>

    <div class="detail">

    @forelse ($categories_pag as $category)

        
        <div class="card" style="">
            <div class="card-img">
                <a class="card-img-link" href="{{ url('/category/'.$category->id) }}">
                    <img src="{{ asset($category->image) }}" class="card-img-top" alt="...">
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$category->name}}</h5>
                <!-- <p class="card-text">{{$category->description}}</p> -->
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Qty. Apps: {{count($category->applications)}}</li>
            </ul>
            <a href="{{ url('/category/'.$category->id) }}" class="btn btn-primary">View</a>
        </div>
        

    @empty

    <h5>No Categories found !!!</h5>

    @endforelse
    
        <!-- PAGES VIEWS -->
        <div>{{$categories_pag->links()}}</div>

    </div>  <!-- End detail -->

</div>

@endsection

