<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>@yield('title')</title>
        @yield('style')
        <link href="{{ asset('assets/admin/css/sb-admin-2.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            html, body {
                height: 100%;
                margin: 0;
            }
            body {
                display: flex;
                flex-direction: column;
            }
            #layoutSidenav {
                flex: 1;
                display: flex;
                flex-direction: column;
            }
            #layoutSidenav_content {
                flex: 1;
                display: flex;
                flex-direction: column;
            }
            main {
                flex: 1;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            
            <!-- ბრენდის ადგილი -->
            <a class="navbar-brand ps-3" href="{{ route('AdminMainPage') }}">Laravel</a>
            
            <!-- მენიუს გადამრთველი -->
           
            
            <!-- ზედა მენიუ -->
            <ul class="navbar-nav d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('AdminMainPage') }}">მთავარი</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('AdminLogout') }}">გასვლა</a></li>
                    </ul>
                </li>
            </ul>
            
        </nav>
        
        <div id="layoutSidenav" class="row">
            
             <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        
                        <!-- გვერდითი მენიუ -->
                            <div class="nav">
                                <a class="nav-link" href="{{ route('AdminMainPage') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    მთავარი
                                </a>
                                <a class="nav-link" href="{{ route('admins.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    ადმინისტრატორები
                                </a>
                                <a class="nav-link" href="{{ route('contacts.edit', 1) }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-phone"></i></div>
                                    საკონტაქტო ინფორმაცია
                                </a>
                            </div>
                        
                    </div>
                    
                    <div class="sb-sidenav-footer">
                        <div class="small">გამარჯობა {{ Session::get('admin')->name }}</div>
                    </div>
                    
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
                
                <main>
                    
                    
                    @yield('content')
                    
                </main>
                
                <!-- ძირი -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">© 2021</div>
                            <div>
                                <a href="{{ route('AdminMainPage') }}">ადმინისტრატორის პანელი</a>
                            </div>
                        </div>
                    </div>
                </footer>
                
            </div>
            
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   
        @yield('script')
        
    </body>
</html>
                