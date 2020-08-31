<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navHeader">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link <?= str_contains(Request::path(),'category') ? 'active':'' ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ url('category/'.$category->id) }}">{{$category->name}}</a>
                        @endforeach
                        <!-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link <?= in_array(Request::path(),['apps','apps/ordered','apps/voted']) ? 'active':'' ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Applications
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('all_apps') }}"> All Applications </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('most_ordered') }}"> Most Ordered Apps </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('most_voted') }}"> Most Voted Apps </a>
                        <!-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </li>
                <!-- <li class="nav-item <?= (Request::path() == 'apps') ? 'active':'' ?>">
                    <a class="nav-link" href="{{ url('/apps') }}">All Apps <span class="sr-only">(current)</span></a>
                </li> -->

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Users
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                                <!-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> -->
                        </div>
                    </li>
                @else
                    @if(auth()->user()->role == 'developer')
                    <li class="nav-item <?= (Request::path() == 'me/apps') ? 'active':'' ?>">
                        <a class="nav-link" href="{{ url('/me/apps') }}">My Apps <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <li class="nav-item" id="username">
                        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">
                            <small>{{auth()->user()->username}}</small>
                            <sup style="color: {{ (auth()->user()->role == 'developer') ? '#a52a2a':'#6495ed' }}"
                                title="{{ (auth()->user()->role == 'developer') ? 'DEVELOPER':'CLIENT' }}">
                                {{ (auth()->user()->role == 'developer') ? 'DEV':'CLI' }}
                            </sup>
                        </a>
                    </li>
                    <li class="nav-item icons">
                        <a class="nav-link" href="" title="Orders">
                            <i class="fas fa-shopping-bag"></i>
                            <sup> {{ auth()->user()->orders()->count() }}</sup>
                        </a>
                    </li>
                    <li class="nav-item icons">
                        <a class="nav-link" href="" title="Wishes">
                            <i class="fas fa-star"></i>
                            <sup> {{ auth()->user()->wishes()->count() }}</sup>
                        </a>
                    </li>
                    @if(auth()->user()->role == 'developer')
                    <li class="nav-item icons">
                        <a class="nav-link" href="" title="My Apps">
                            <i class="fas fa-file-code"></i>
                            <sup> {{ auth()->user()->applications()->count() }}</sup>
                        </a>
                    </li>
                    @endif
                @endguest           
                
                </ul>
                <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search Applications" aria-label="Search" name="find">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div> <!-- div.container -->
    </nav>

    @include('website.layouts.message')
    
    <div class="container-fluid">

        @yield('content')

    </div>

    <!-- This is not a blade, it is a javascript code -->
    @include('scripts.alert')

    <script>
        window.onscroll = function() {scroll()};

        var header = document.getElementById("navHeader");
        // var sticky = header.offsetTop;
        var sticky = header.offsetHeight;   // Element Height

        function scroll() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>