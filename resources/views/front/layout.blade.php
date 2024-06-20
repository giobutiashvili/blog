<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @yield('title')
        </title>
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{asset('assets/front/styles.css')}}">
        <style>
            button {
                border: 2px solid #4CAF50 ; /* Green border */
                color: #4CAF50; /* Green text */
                background-color: white; /* White background */
                padding: 10px 24px; /* Padding */
                border-radius: 5px; /* Rounded corners */
                transition: all 0.3s ease; /* Smooth transition */
            }
            button:hover {
                background-color: #4CAF50 !important; /* Green background on hover */ 
                color: white !important; /* White text on hover */
            }
        </style>
      
</head>
<body>
    <!-- მენიუ -->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('index') }}">@lang('site.main_page')</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
             aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="
                            {{ route('index') }}">@lang('menu.index')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('contact.index') }}">
                            @lang('menu.contact')
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link px-lg-3 py-3 py-lg-4">
                                <div class="small">@lang('site.dashboard')
                                     <span style="text-decoration:underline;
                                      font-size:12px">
                                        @if($users)
                                         {{ $users->name }}
                                        @endif
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" 
                            class="nav-link px-lg-3 py-3 py-lg-4" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                @lang('site.logout')
                            </a>
                        </li>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        
                    @else
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('register') }}">
                                @lang('site.register')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">
                                @lang('site.login')
                            </a>
                        </li>
                    @endauth
                    <!-- ენების გადამრთველი -->
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item">
                            <a  href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="nav-link px-lg-3 py-3 py-lg-4">
                                {{ strtoupper(mb_substr($properties['name'], 0, 2)) }} 
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
    <!-- საიტის ქუდი -->
    @php
    $articles_page = Route::current()->getName() == 'article' ? true : false;
    @endphp
    <header class="masthead" style="background-image: url('{{ $articles_page ? $article->image : asset('assets/front/home-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <iv class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>{{ $articles_page ? $article->title : __('site.check_out_blogs') }}
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- /საიტის ქუდი -->

    <!-- ძირითადი შიგთავსი -->
    @yield('content')
    <!-- /ძირითადი შიგთავსი -->

    <!-- საიტის ძირი -->
    <footer class="border-top" style="background-image: url('{{asset('assets/front/home-bg.jpg') }}')" >
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="tel:{{ $contact->phone }}">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="mailto:{{ $contact->email }}">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="small text-center text-muted fst-italic">Copyright © Your Website 2021</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- საიტის ძირი -->
    
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
   
    
</body>
</html>
