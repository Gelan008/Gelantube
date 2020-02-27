<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/videos') }}">Videos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/users') }}">Users</a>
                        </li>

                    </ul>
                </div>
            </ul>

            <!-- Right Side Of Navbar -->
            <form method="POST" class="form-inline my-auto my-lg-0" action="{{action('SearchController@search')}}">
                @csrf
                <input class="form-control mr-sm-2 col-md-6" type="search" name="search" placeholder="Search" aria-label="Search">
                <input class="form-control mr-sm-2" type="hidden" name="scope" value="{{session('scope')}}" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <button type="submit" class="btn btn-outline-danger my-2 my-sm-0 ml-1" formaction="{{url(session('scope') == 'video' ? 'videos' : 'users')}}">Clear</button>
            </form>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                               Dashboard
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container">
@if(isset($word))
    <h5>Found {{isset($videos) ? $videos->total() : $users->total() }} records '{{$word}}'</h5>

    <form action="{{action('SearchController@search')}}" method="post">
        @csrf

        <div class="input-group mb-3">

            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit">Order</button>
            </div>
            <select class="custom-select" id="order" name="order">

                @if(isset($order))
                    <option value="0" {{$order == 0 ? 'selected' : ''}}>Choose...</option>
                    <option value="1" {{$order == 1 ? 'selected' : ''}}>Oldest to newest</option>
                    <option value="2" {{$order == 2 ? 'selected' : ''}}>Newest to oldest</option>
                    <option value="3" {{$order == 3 ? 'selected' : ''}}>A to Z</option>
                @else
                    <option value="0" selected>Choose...</option>
                    <option value="1" >Oldest to newest</option>
                    <option value="2" >Newest to oldest</option>
                    <option value="3" >A to Z</option>
                @endif


            </select>

            <input type="hidden" value="{{$word}}" name="search"/>
            <input class="form-control mr-sm-2" type="hidden" name="scope" value="{{session('scope')}}" placeholder="Search" aria-label="Search">


        </div>
    </form>
@endif
</div>
