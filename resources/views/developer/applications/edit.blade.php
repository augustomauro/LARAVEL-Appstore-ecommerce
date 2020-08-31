@extends('developer.layouts.rcm')

@section('title')
R/C/M Applications
@endsection

@section('content')

<div class="container">

    @include('website.layouts.message')

    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h1>Edit Application</h1>
                </div>
                <img src="{{ asset($application->image) }}" alt="Prod Img" style="width: 80px; padding: 10px">
            </div>

            <h5>{{ $application->name }}</h5>

            @include('developer.applications.form', [
            'method' => 'patch',
            'url' => '/me/apps/' . $application->id])

            @include('developer.layouts.menu')

        </div>
    </div>
</div>

@endsection
