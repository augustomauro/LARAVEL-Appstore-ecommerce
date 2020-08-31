@extends('website.layouts.website')
<!-- Index Template -->

<!-- Verifies if the url contains 'category' -->
<?php $category_path = str_contains(Request::path(),'category'); ?>

@if($category_path)
    <?php $title = $applications[0]->category->name.' Applications'; ?>
@else
    @if(Request::path() == 'me/apps')
        <?php $title = 'Your Applications'; ?>
    @elseif(Request::path() == 'apps/ordered')
        <?php $title = 'Ordered Applications'; ?>
    @else
        <?php $title = 'All Applications'; ?>
    @endif
    @if(isset($search))
        <?php
            $s = ($applications->total() > 1 || $applications->total() == 0) ? 's' : '';
            $title = $applications->total() . ' Application' . $s . ' related with the search "' . $search->find . '"'; 
        ?>
    @endif
@endif


@section('title')
{{ $title }}
@endsection


@section('content')

<div class="content-wrap">

    @if(isset($search))
    <h4 class="name-product">{{ $title }}</h4>
    @else
    <h3 class="name-product">{{ $title }}</h3>
    @endif

    <div style="text-align: center; font-style: italic; font-size: medium">Total {{$applications->total()}}
        application<?= (count($applications) > 1 ) ? 's' : '' ?> | In this Page {{count($applications)}}</div>

    <div class="detail">

    @forelse ($applications as $application)

        
        <div class="card" style="">
            <div class="card-img">
                <a class="card-img-link" href="{{ $category_path ? url('apps/'.$application->id) : url('apps/'.$application->id) }}">
                    <img src="{{ asset($application->image) }}" class="card-img-top" alt="...">
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$application->name}}</h5>
                <p class="card-text developer">author:<span class="developer-name"> {{ $application->user()->first()->username }}</span></p>
                <!-- <p class="card-text">{{$application->description}}</p> -->
            </div>
            <div class="rating-wrap mb-3">
                <ul class="rating-stars" title="{{ $application->getRating() }}% of the total">
                        <li style="width:{{ $application->getRating() }}%" class="stars-active">
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </li>
                    <li>
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </li>
                </ul>
            </div> <!-- rating-wrap.// -->
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Category: {{$application->category->name}}</li>
                <li class="list-group-item">Price: $@money($application->price)</li>
            </ul>
            <a href="{{ $category_path ? url('apps/'.$application->id) : url('apps/'.$application->id) }}" class="btn btn-primary">Detail</a>
        </div>
        

    @empty

    <h5>No Applications found !!!</h5>

    @endforelse
    
        <!-- PAGES VIEWS -->
        <div>{{$applications->links()}}</div>

    </div>  <!-- End detail -->

</div>

@endsection

