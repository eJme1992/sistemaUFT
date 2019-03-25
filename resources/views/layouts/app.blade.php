<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WISE Solutions -  @yield('title')</title>
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


       
<style type="text/css">
    .dataTables_wrapper, table {
    margin-top: 5px !important;
}
</style>




    <?php 
    $roles = Auth::user()->roles()->first();
    $rol = $roles->pivot->role_id;
    ?>

       <!-- jQuery library -->

    </head>
    <body class="cm-no-transition cm-1-navbar">
        <div id="app">
        <div id="cm-menu">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="cm-flex"><a class="cm-logo" title="{{ config('app.name', 'Laravel') }}" href="{{ url('home') }}">
                    </a></div>
                <div class="btn btn-default" data-toggle="cm-menu">
                    <i class="fa fa-align-justify"></i>
                </div>
            </nav>
            <div id="cm-menu-content">
                <div id="cm-menu-items-wrapper">
                    <div id="cm-menu-scroller">
                        <ul class="cm-menu-items">
                            <li class="active"><a href="{{url('cuentas')}}" class="sf-house">Home</a></li>
                            @if($rol=='1') 
                            <li class="cm-submenu">
                                <a class="sf-file-bookmark ">Cuentas <span class="caret"></span></a>
                                <ul>
                                    <li><a href="{{url('cuentas')}}">Buscar Cuenta</a></li>
                                    <li><a href="{{url('cuentas/create')}}">Agregar Cuenta</a></li>
                                </ul>
                            </li>
                            @endif

                                <li class="cm-submenu">
                                <a class="sf-device-laptop ">Software<span class="caret"></span></a>
                                <ul>
                                <!--li><a href="{{url('Cuentas')}}">Todos mis Cuentas</a></li>-->
                                    <li><a href="{{url('software')}}">Buscar Software</a></li>
                                    <li><a href="{{url('software/create')}}">Agregar Software</a></li>
                                </ul>
                            </li>
                           @if($rol=='1') 
                            <li class="cm-submenu">
                                <a class="sf-wrench-screwdriver">Herramientas <span class="caret"></span></a>
                                <ul>
                                <!--li><a href="{{url('Cuentas')}}">Todos mis Cuentas</a></li>-->
                                    <li><a href="{{url('importar')}}">Importar Datos</a></li>
                                </ul>
                            </li>

                              <li class="cm-submenu">
                                <a class="sf-profile-group">Usuarios <span class="caret"></span></a>
                                <ul>
                                <!--li><a href="{{url('Cuentas')}}">Todos mis Cuentas</a></li>-->
                                    <li><a href="{{url('usuarios')}}">Lista de usuarios</a></li>
                                </ul>
                            </li>
                             @endif

                        </ul>

                       
                    </div>
                </div>
            </div>
        </div>
        <header id="cm-header">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="btn btn-default  hidden-md hidden-lg" data-toggle="cm-menu">
                       <i class="fa fa-align-justify"></i>
                </div>
                <div class="cm-flex">

                    <!--<form id="cm-search" action="index.html" method="get">
                        <input type="search" name="q" autocomplete="off" placeholder="Search...">
                    </form>-->
                </div>
                <!--<div class="pull-right">
                    <div id="cm-search-btn" class="btn btn-primary md-search-white" data-toggle="cm-search"></div>
                </div> -->
                <div class="dropdown pull-right">

                </div>
                <div class="dropdown pull-right">
                    <button class="btn btn-primary md-account-circle-white" data-toggle="dropdown"></button>
                    <ul class="dropdown-menu">
                             @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li>
                                <a>
                                    {{ Auth::user()->name }} <span class=""></span>
                                </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        Cerrar sección
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                              </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        <div id="global">
        @yield('content')
        <!-- jQuery library -->
        <footer class="cm-footer"><span class="pull-left">© Copyright 2015 - 2019   |   WISE Solutions S.A.   |   Todos los Derechos Reservados   |   Powered by WiseSolutions</span><span class="pull-right">&copy; & eJme</span></footer>
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
        <script src="{{asset('')}}assets/js/lib/jquery-2.1.3.min.js"></script>
        <script src="{{asset('')}}assets/js/jquery.mousewheel.min.js"></script>
        <script src="{{asset('')}}assets/js/jquery.cookie.min.js"></script>
        <script src="{{asset('')}}assets/js/fastclick.min.js"></script>
        <script src="{{asset('')}}assets/js/bootstrap.min.js"></script>
        <script src="{{asset('')}}assets/js/clearmin.min.js"></script>

    </div>
    </body>
</html>