<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ Theme::getMetaTitle() }} - {{ config('app.name') }}</title>
        <meta name="description" content="{{ Theme::getMetaDesctiption() }}">
        <meta name="keyword" content="{{ Theme::getMetaKeyword() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{theme_asset('css/bootstrap.min.css')}}">

        <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw==" crossorigin="anonymous"></script>
        <script src="{{theme_asset('js/bootstrap.min.js')}}"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" />

        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


        




        <style>
            @font-face {
                font-family:HelveticaNeue_Bold;
                src: url({{theme_asset('font/HelveticaNeueBd.ttf')}});
                }

            @font-face {
                font-family: HelveticaNeue;
                src: url({{theme_asset('font/HelveticaNeue.ttf')}});
             
            }

            @font-face {
            font-family: HelveticaNeue_Medium;
            src: url({{theme_asset('font/HelveticaNeueMed.ttf')}});
            }

            @font-face {
            font-family: HelveticaNeue_Lt;
            src: url({{theme_asset('font/HelveticaNeueLt.ttf')}});
            }

            @font-face {
            font-family:  HelveticaNeue_BoldCond;
            src: url({{theme_asset('font/HelveticaNeue-CondensedBold.ttf')}});
            }

            
        </style>

<link rel="stylesheet" href="{{theme_asset('css/custom.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />



   
        
    </head>

    <body>
        {!! Theme::partial('login') !!}
        {!! Theme::partial('header') !!}
        {!! Theme::content() !!}
        {!! Theme::partial('footer') !!}
        {!! Theme::asset()->container('footer')->scripts() !!}

        

        <script>
            AOS.init();
         </script>

         
        
    </body>
</html>
