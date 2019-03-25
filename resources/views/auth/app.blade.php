<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wise clientes -  @yield('title')</title>
    <!--
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <script src="{{asset('assets/js/lib/jquery-2.1.3.min.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/bootstrap-clearmin.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/roboto.css">
        <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/material-design.css">
        <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/small-n-flat.css">
        <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/fonta-wesome.min.css">
        <!-- NO SON DEL TEMA -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/all.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">

        
        
       <!-- jQuery library -->
       
    </head>
     <body class="cm-login">
<!--<div id="app">-->
    <div class="text-center" style="padding:90px 0 30px 0;background:#fff;border-bottom:1px solid #ddd">
      <img src="{{url('/img/wisee.png')}}" width="300" >
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-3" style="margin:40px auto; float:none;">

        <main class="py-4">
            @yield('content')
        </main>
         <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
        <script src="{{asset('')}}assets/js/lib/jquery-2.1.3.min.js"></script>
        <script src="{{asset('')}}assets/js/jquery.mousewheel.min.js"></script>
        <script src="{{asset('')}}assets/js/jquery.cookie.min.js"></script>
        <script src="{{asset('')}}assets/js/fastclick.min.js"></script>
        <script src="{{asset('')}}assets/js/bootstrap.min.js"></script>
        <script src="{{asset('')}}assets/js/clearmin.min.js"></script>
       
       <!-- <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js">
        </script>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
        <script>
        $.noConflict();
        jQuery( document ).ready(function( $ ) {
          $('#grid').DataTable();
        });
        // Code that uses other library's $ can follow here.
        </script>-->
    </div>
    </body>
</html>