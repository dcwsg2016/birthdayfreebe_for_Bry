<?php //nav.blade.php ?>

<!-- Navbar -->
<!--
<nav class="navbar navbar-expand-md bg-light navbar-light">
  <a class="navbar-brand" href="/">Birthday Freebe</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
        
    </ul>
  </div>  
</nav>-->

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'BirthdayFreebe') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/add-your-business">Add-Your-Business</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/contact">Contact</a>
                        </li>      
                    </ul>

                    <!-- Right Side Of Navbar -->
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
                        @else <!-- started here-->
                           <div class="container">                                          
                              <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                  {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu">
                                  <!--<a class="dropdown-item" href="#">Test Item</a>-->
                                  <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                  <!--<a class="dropdown-item" href="#">Test Item</a>-->
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                   @csrf
                                  </form>
                                  <a class="dropdown-item" href="{{route('user',Auth::user()->id)}}">User Page</a>
                                </div>
                              </div>
                            </div> 
                        @endguest <!--ends here-->
                    </ul>
                </div>
            </div>
        </nav>

