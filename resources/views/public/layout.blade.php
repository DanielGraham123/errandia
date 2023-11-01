<!DOCTYPE html>
<!-- saved from url=(0068)https://res.kan-therm.com/css/main/starter-alibaba-listing-grid.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Bootstrap-ecommerce by Vosidiy">
<title>{{ env('APP_NAME') ?? 'ERRANDIA' }}</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/logo/errandia-logo.png') }}">

<script src="{{ asset('assets/public/jquery-2.0.0.min.js.download')}}" type="text/javascript"></script>

<script src="{{ asset('assets/public/bootstrap.bundle.min.js.download')}}" type="text/javascript"></script>
<link href="{{ asset('assets/public/bootstrap-custom.css')}}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/public/fontawesome-all.min.css')}}" type="text/css" rel="stylesheet">

<script src="{{ asset('assets/public/fancybox.min.js.download')}}" type="text/javascript"></script>
<link href="{{ asset('assets/public/fancybox.min.css')}}" type="text/css" rel="stylesheet">

<link href="{{ asset('assets/public/owl.carousel.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/public/owl.theme.default.css')}}" rel="stylesheet">
<script src="{{ asset('assets/public/owl.carousel.min.js.download')}}" type="text/javascript"></script>

<link href="{{ asset('assets/public/uikit.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/public/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)">

<script src="{{ asset('assets/public/script.js.download')}}" type="text/javascript"></script>
<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

}); 
// jquery end
</script>
    <style>
        body{
            font-family: sans-serif !important;
        }
    </style>
</head>
<body style="">
<header class="section-header">
<nav class="navbar navbar-expand-lg navbar-light">
<div class="container">
<a class="navbar-brand" href="{{ route('public.home') }}"><img class="logo" src="{{ asset('assets/admin/logo/errandia-logo.png')}}" alt="alibaba style e-commerce html template file" title="alibaba e-commerce html css theme"></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarTop">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Errands </a></li>
        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Businesses </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Drop Regions/Towns</a></li>
            </ul>
        </li>
        <li class="nav-item"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Login/Signup </a></li>
        <li class="nav-item"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Become a Supplier </a></li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item"><a href="#" class="nav-link"> Run an Errand </a></li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> English </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">French</a></li>
            </ul>
        </li>
    </ul> 
</div> 
</div>
</nav>
<section class="header-main shadow-sm">
<div class="container">
<div class="row-sm align-items-center">
<div class="col-lg-4-24 col-sm-3">
    <div class="category-wrap dropdown py-1">
        <button type="button" class="btn btn-light  dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Categories</button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Category/Subcategory listing </a>
        </div>
    </div>
</div>
<div class="col-lg-11-24 col-sm-8">
    <form action="#" class="py-1">
        <div class="input-group w-100">
            <select class="custom-select" name="region">
                <option value="">Regions</option>
            </select>
            <input type="text" class="form-control" style="width:50%;" placeholder="Search">
            <div class="input-group-append">
                <button class="btn btn-warning" type="submit">
                    <i class="fa fa-search"></i> Search
                </button>
            </div>
        </div>
    </form> 
</div> 
<div class="col-lg-9-24 col-sm-12">
    <div class="widgets-wrap float-right row no-gutters py-1">
        <div class="col-auto">
            <div class="widget-header dropdown">
                <a href="#" data-toggle="dropdown" data-offset="20,10">
                    <div class="icontext">
                        <div class="icon-wrap"><i class="text-warning icon-sm fa fa-user"></i></div>
                        <div class="text-wrap text-dark">
                            Sign in <br>My account <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu">
                    <form class="px-4 py-3">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                <hr class="dropdown-divider">
                <a class="dropdown-item" href="#">Have account? Sign up</a>
                <a class="dropdown-item" href="#">Forgot password?</a>
                </div> 
            </div> 
        </div> 

        <div class="col-auto">
            <div class="widget-header dropdown">
                <a href="#" data-toggle="dropdown" data-offset="20,10">
                    <div class="icontext">
                        <div class="icon-wrap"><i class="text-warning icon-sm fa fa-user"></i></div>
                        <div class="text-wrap text-dark">
                            Sign up<i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu">
                    <form class="px-4 py-3">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                <hr class="dropdown-divider">
                <a class="dropdown-item" href="#">Have account? Sign up</a>
                <a class="dropdown-item" href="#">Forgot password?</a>
                </div> 
            </div> 
        </div> 

    </div> 
</div> 
</div> 
</div> 
</section> 
</header> 

<section class="section-content bg padding-y-sm">
<div class="container">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-md-3-24"> <strong>Your are here:</strong> </div> 
<nav class="col-md-18-24">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="#">Category name</a></li>
<li class="breadcrumb-item"><a href="#">Sub category</a></li>
<li class="breadcrumb-item active" aria-current="page">Items</li>
</ol>
</nav> 
<div class="col-md-3-24 text-right">
<a href="#" data-toggle="tooltip" title="" data-original-title="List view"> <i class="fa fa-bars"></i></a>
<a href="#" data-toggle="tooltip" title="" data-original-title="Grid view"> <i class="fa fa-th"></i></a>
</div> 
</div> 
<hr>
<div class="row">
<div class="col-md-3-24"> <strong>Filter by:</strong> </div> 
<div class="col-md-21-24">
<ul class="list-inline">
<li class="list-inline-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Supplier type </a>
<div class="dropdown-menu p-3" style="max-width:400px;">
<label class="form-check">
<a href="#">
<input type="checkbox" class="form-check-input"> Good supplier
</a>
</label>
<label class="form-check">
<a href="#">
<input type="checkbox" class="form-check-input"> Best supplier
</a>
</label>
<label class="form-check">
<a href="#">
<input type="checkbox" class="form-check-input"> New supplier
</a>
</label>
</div> 
</li>
<li class="list-inline-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Country </a>
<div class="dropdown-menu p-3" style="max-width:400px;" "="">
<label class="form-check">
<a href="#">
<input type="checkbox" class="form-check-input"> China
</a>
</label>
<label class="form-check">
<a href="#">
<input type="checkbox" class="form-check-input"> Japan
</a>
</label>
<label class="form-check">
<a href="#">
<input type="checkbox" class="form-check-input"> Uzbekistan
</a>
</label>
<label class="form-check">
<a href="#">
<input type="checkbox" class="form-check-input"> Russia
</a>
</label>
</div> 
</li>
<li class="list-inline-item"><a href="#">Product type</a></li>
<li class="list-inline-item"><a href="#">Brand name</a></li>
<li class="list-inline-item"><a href="#">Color</a></li>
<li class="list-inline-item"><a href="#">Size</a></li>
<li class="list-inline-item">
<div class="form-inline">
<label class="mr-2">Price</label>
<input class="form-control form-control-sm" placeholder="Min" type="number">
<span class="px-2"> - </span>
<input class="form-control form-control-sm" placeholder="Max" type="number">
<button type="submit" class="btn btn-sm ml-2">Ok</button>
</div>
</li>
</ul>
</div> 
</div> 
</div> 
</div> 
<div class="padding-y-sm">
<span>3897 results for "Item"</span>
</div>
<div class="row-sm">
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/1.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">Good item name</a>
<div class="price-wrap">
<span class="price-new">$1280</span>
<del class="price-old">$1980</del>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/2.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">The name of product</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/3.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">Good item name</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/4.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">Good item name</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/5.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">Good item name</a>
<div class="price-wrap">
<span class="price-new">$1280</span>
<del class="price-old">$1980</del>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/6.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">The name of product</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/7.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">The name of product</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/1.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">The name of product</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/2.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">The name of product</a>
<div class="price-wrap">
<span class="price-new">$1280</span>
<del class="price-old">$1980</del>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/3.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">The name of product</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/4.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">The name of product</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
<div class="col-md-3 col-sm-6">
<figure class="card card-product">
<div class="img-wrap"> <img src="{{ asset('assets/public/6.jpg')}}"></div>
<figcaption class="info-wrap">
<a href="#" class="title">The name of product</a>
<div class="price-wrap">
<span class="price-new">$280</span>
</div> 
</figcaption>
</figure> 
</div> 
</div> 
</div>
</section>


<footer class="section-footer bg-secondary">
<div class="container">
<section class="footer-top padding-top">
<div class="row">
<aside class="col-sm-3 col-md-3 white">
<h5 class="title">Customer Services</h5>
<ul class="list-unstyled">
<li> <a href="#">Help center</a></li>
<li> <a href="#">Money refund</a></li>
<li> <a href="#">Terms and Policy</a></li>
<li> <a href="#">Open dispute</a></li>
</ul>
</aside>
<aside class="col-sm-3  col-md-3 white">
<h5 class="title">My Account</h5>
<ul class="list-unstyled">
<li> <a href="#"> User Login </a></li>
<li> <a href="#"> User register </a></li>
<li> <a href="#"> Account Setting </a></li>
<li> <a href="#"> My Orders </a></li>
<li> <a href="#"> My Wishlist </a></li>
</ul>
</aside>
<aside class="col-sm-3  col-md-3 white">
<h5 class="title">About</h5>
<ul class="list-unstyled">
<li> <a href="#"> Our history </a></li>
<li> <a href="#"> How to buy </a></li>
<li> <a href="#"> Delivery and payment </a></li>
<li> <a href="#"> Advertice </a></li>
<li> <a href="#"> Partnership </a></li>
</ul>
</aside>
<aside class="col-sm-3">
<article class="white">
<h5 class="title">Contacts</h5>
<p>
<strong>Phone: </strong> +123456789 <br>
<strong>Fax:</strong> +123456789
</p>
<div class="btn-group white">
<a class="btn btn-facebook" title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f  fa-fw"></i></a>
<a class="btn btn-instagram" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram  fa-fw"></i></a>
<a class="btn btn-youtube" title="Youtube" target="_blank" href="#"><i class="fab fa-youtube  fa-fw"></i></a>
<a class="btn btn-twitter" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter  fa-fw"></i></a>
</div>
</article>
</aside>
</div> 
<br>
</section>
<section class="footer-bottom row border-top-white">
<div class="col-sm-6">
<p class="text-white-50"> Made with &lt;3 <br> by Vosidiy M.</p>
</div>
<div class="col-sm-6">
<p class="text-md-right text-white-50">
Copyright © <br>
<a href="http://bootstrap-ecommerce.com/" class="text-white-50">Bootstrap-ecommerce UI kit</a>
</p>
</div>
</section> 
</div>
</footer>

<script defer="" src="{{ asset('assets/public/v84a3a4012de94ce1a686ba8c167c359c1696973893317')}}" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon="{&quot;rayId&quot;:&quot;81f46f57bf233ea0&quot;,&quot;version&quot;:&quot;2023.10.0&quot;,&quot;token&quot;:&quot;834e128887e54feaa4938eab62e7aea4&quot;}" crossorigin="anonymous"></script>

</body></html>