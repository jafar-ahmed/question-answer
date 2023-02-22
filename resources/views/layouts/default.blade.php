{{-- <!DOCTYPE html> --}}
<html lang="{{ App::currentLocale() }}" dir="{{ App::currentLocale() == 'ar'? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (App::currentLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/headers.css') }}">
    <title>{{ config('app.name') }}</title>
    @stack('styles')


    <style>
        .dropbtn {
          background-color: #ffffff;
         margin-left: 15px;
          border: none;
        }
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #ffffff;
          z-index: 1;
        }
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        .dropdown-content a:hover {background-color: #ddd;}
        .dropdown:hover .dropdown-content {display: block;}

        #s1:hover #s2 {display: block;}

        </style>

</head>

<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('questions.index') }}" class="nav-link px-2 link-secondary">Home</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Inventory</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Customers</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Products</a></li>
                </ul>

                <form method="get" action="{{ route('questions.index') }}" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input name="search" type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <!-- notifications-menu -->
                @auth
                <x-notifications-menu />
                @endauth
                <!-- استخدام افتراضي-->
                <!-- <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="local" data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- {{__('Language') }} --}}
                        <ul class="dropdown-menu text-small" aria-labelledby="local">
                            {{-- <li><a class="dropdown-item" href="{{ URL::current() }}?lang=en">English</a></li> --}}
                            {{-- <li><a class="dropdown-item" href="{{ URL::current() }}?lang=ar">العربية</a></li> --}}
                        </ul>
                    </a>
                </div> -->
                <!-- استخدام مكتبة mcarara-->
                <div class="ms-2 dropdown text-end " id="s1">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="local" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                    </a>
                    <ul class="dropdown-menu text-small" id="s2" aria-labelledby="local">
                        @foreach(LaravelLocalization::getSupportedLocales() as $code => $locale)
                        <li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($code) }}">{{$locale['native']}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!--  -->
                @auth
                <div class="m-2"></div>
                <div class="dropdown text-end" id="s1">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" id="s2" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Settings</a></li> 
                      
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        {{-- <li>
                            <hr class="dropdown-divider">
                        </li> --}}
                        <li><a class="dropdown-item" onclick="document.getElementById('logout').submit() " href="javascript:;">Sign out</a></li>
                        <form action="{{ route('logout') }}" method="post" id="logout" style="display: none;">
                        @csrf
                        </form>
                    </ul>
                </div>
                @else 

                <div class="dropdown">
                    <button class="dropbtn">Login</button>
                    <div class="dropdown-content">
                      <a href="{{ route('login') }}">Login</a>
                      <a href="{{ route('register') }}">Register</a>
                      
                    </div>
                  </div>

                {{-- <a href="{{ route('login') }}">{{ __('login') }}</a> --}}
                @endauth
            </div>
        </div>
    </header>


    

  
  
      <div class="container">
        <header class="mb-4 bg-light">

            <h2>@yield('title', 'page title')</h2>


            <hr>
        </header>
        @yield('content')

    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        const userId = "{{ Auth::id() }}";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>


    @yield('scripts')
</body>


</html>