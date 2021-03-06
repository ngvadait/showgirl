<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tài Liệu Học Tập</title>
        <link rel="shortcut icon" type="image/png" href="/icon.png"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #000;
                font-family: Helvetica, Arial, Tahoma, sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .hide-p {text-decoration: none !important;}
            .hide-a {
                color:black !important; text-decoration: none !important;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <photos></photos>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
