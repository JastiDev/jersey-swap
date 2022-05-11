<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Montserrat & Lato -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome
    <link href="assets/plugins/fontawesome/css/all.min.css">-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">

    <!-- Owl Coursel -->
    <link rel="stylesheet" href="{{asset('assets/plugins/owl-crousel/style/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/owl-crousel/style/owl.theme.default.min.css')}}">

    <!-- Custom CSS-->
    <link rel="stylesheet" href="{{asset('assets/style/style.min.css')}}">

    <!-- Fav Icon -->
    <link rel="icon" href="{{asset('assets/images/logo-transparent.png')}}">

    <!-- Title -->
    <title>@yield('title','Jersey Swap!')</title>
    <meta name="description" content="@yield('meta_description','The central hub to buy, sell, and trade sports jerseys and sports cards.')">
    <script>
        var base_url = "{{url('/')}}";
        var static_url = "{{static_url('')}}";
    </script>

    <!-- Gtag -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-228181667-1');
    </script>
</head>
<body id="body">
