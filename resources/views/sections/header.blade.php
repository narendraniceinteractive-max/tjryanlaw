<!doctype html>
<html {!! get_language_attributes() !!}>

<head>
    <meta charset="{{ get_bloginfo('charset') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    @php(wp_head())
    {{-- Extra CSS --}}
    <link rel="stylesheet" href="{{ get_stylesheet_directory_uri() }}/resources/css/owl.carousel.min.css" media="all">
</head>

<body {!! body_class() !!}>

@php(wp_body_open())

{{-- Mobile Floating Menu --}}
<div id="floatingMenu">
    <div class="floatingMenu-list">
        <button type="button" onclick="closeFloatingMenu();" id="cloaseFloatingMenu"> &times; </button>
        <div class="sticky-mobinav mobinav">
            <div class="container">
                {!! wp_nav_menu([
                    'menu_class'     => 'main-menu-mobile',
                    'menu_id'        => 'main-menu-mobile',
                    'menu'           => 'Main Menu',
                    'container'      => '',
                    'theme_location' => 'main_menu',
                    'echo'           => false,
                ]) !!}
            </div>
        </div>
    </div>
    <button type="button" onclick="closeFloatingMenu();" id="cloaseFloatingMenu2"> × </button>
</div>


{{-- Header --}}
<header class="site-header">
    <div class="container">
        <div class="logo-section">
            {{-- Logo --}}
            <div class="site-branding">
                <a href="{{ home_url('/') }}"> <img src="{{ get_stylesheet_directory_uri() }}/resources/images/logo.webp" alt="{{ get_bloginfo('name') }}"> </a>
            </div>
            {{-- Navigation --}}
            <nav id="main-navigation">
                {!! wp_nav_menu([
                    'menu' => 'Main Menu',
                    'echo' => false,
                ]) !!}
            </nav>
            {{-- Phone --}}
            <div class="header-number">
                <a href="tel:+17148984444"><strong> Call</strong> 714-898-4444 </a>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="mobile_src_nav">
        <div class="container">
            <button type="button" onclick="floatingMenu();" class="showhide"> <b class="txtr">&equiv;</b> <b class="txtl">Menu</b> </button>
        </div>
    </div>

    {{-- Sticky Header --}}
    <div class="header-sticky">
        <div class="container">
            <div class="sticky-cnt mobile_src_nav">
                <button type="button" onclick="floatingMenu();" class="stickyshowhide"> <b class="txt"> Menu </b> </button>
            </div>
            {{-- Sticky Logo --}}
            <div class="sticky-cnt sticky-mobile-logo">
                <a href="{{ home_url('/') }}">
                    <img src="{{ get_stylesheet_directory_uri() }}/resources/images/logo.webp" alt="Mobile Sticky Logo">
                </a>
            </div>
           {{-- Sticky Call --}}
            <div class="sticky-cnt sticky-call-wrap">
                <a href="tel:+17148984444"> Call </a>
            </div>
        </div>
    </div>
</header>