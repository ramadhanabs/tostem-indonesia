<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ Theme::getMetaTitle() }} - {{__('app.name')}}</title>
        <meta name="description" content="{{ Theme::getMetaDesctiption() }}">
        <meta name="keyword" content="{{ Theme::getMetaKeyword() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{theme_asset('css/bootstrap.min.css')}}">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="{{theme_asset('js/bootstrap.min.js')}}"></script>
    </head>

    <body>
        {!! Theme::partial('login') !!}
        {!! Theme::partial('header') !!}
        {!! Theme::content() !!}
        {!! Theme::partial('footer') !!}
        {!! Theme::asset()->container('footer')->scripts() !!}
    </body>
</html>
