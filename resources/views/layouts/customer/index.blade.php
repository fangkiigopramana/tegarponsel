<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Shayna Template" />
    <meta name="keywords" content="Shayna, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Tegar Ponsel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('customer/css/bootstrap.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('customer/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('customer/css/themify-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('customer/css/elegant-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('customer/css/owl.carousel.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('customer/css/nice-select.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('customer/css/jquery-ui.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('customer/css/slicknav.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('customer/css/style.css')}}" type="text/css" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/sign-in.css">

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-4 col-md-2">
                        <div class="logo">
                            <a href={{ route('customer.home') }}>
                                <h2 class="fw-bold">Tegar Ponsel</h2>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-7"></div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="cart-icon">
                                Keranjang Belanja &nbsp;
                                <a href={{ route('customer.cart.view') }}>
                                    <i class="icon_bag_alt"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    @yield('container')

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="{{ asset('logo/logo.png') }}" alt="" /></a>
                        </div>
                        <ul>
                            <li>Address: Jl. Kapten Sudibyo No.11a, Pekauman, Kec. Tegal Bar., Kota Tegal, Jawa Tengah 52125</li>
                            <li>Phone: 085228128074</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor hic expedita provident illum at deleniti distinctio perferendis debitis doloremque aut.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | Tegar Ponsel
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Js Plugins -->
    <script src="{{ asset('customer/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('customer/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('customer/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customer/js/main.js') }}"></script>
</body>

</html>