<?php

/* 
 * The MIT License
 *
 * Copyright 2017 Sotiris Karampatakis Open Knowledge Greece.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="Upload, Visualize, Analyse public budget and spending data. Start exploring and learn stories behind budgets.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>KPIs Admin Panel</title>
        <!-- Styles -->
        <link href="/css/app_obeu.css" rel="stylesheet">
        <script  src="https://code.jquery.com/jquery-1.12.4.min.js"  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="  crossorigin="anonymous"></script>
        <link href="//fonts.googleapis.com/css?family=Cabin:400,400i,600,700" rel="stylesheet"> 
        <link rel="stylesheet" href="http://okfnlabs.org/openbudgets.github.io/css/main.css">
        <script src="http://okfnlabs.org/openbudgets.github.io/js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- Scripts -->
    </head>
    <body>
        <header class="site-header">
            <div class="wrapper">
                <a href="/openbudgets.github.io/" class="logo">
                    <img src="http://okfnlabs.org/openbudgets.github.io/img/openbudgets-logo.svg" alt="OpenBudgets">
                </a>
                <nav>
                    <ul>
                        <li>
                            <a href="/openbudgets.github.io/#">Explore Data</a>

                        </li>
                        <li class='active'>
                            <a href="/openbudgets.github.io/tools">Data Toolbox</a>
                        </li>
                        <li>
                            <a href="/openbudgets.github.io/documentation">Documentation</a>
                        </li>
                        <li>
                            <a href="/openbudgets.github.io/blog">Blog</a>
                        </li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <a id="cd-menu-trigger" href="#0"><span class="cd-menu-text">Menu</span><span class="cd-menu-icon"></span></a>
        </header>
        <main class="cd-main-content">
            <div class="tools">
                <div class="banner">
                    <div class="wrapper">
                        <span>
                            <h1><a href="{{ url('/') }}">
                                    KPIs Admin Panel
                                    </a>
                            </h1>
                            <p>Some info about the app. <a href="../documentation">Read the tutorial</a>
                            </p>                            
                        </span>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                @if(session()->has('flash_message'))
                @include('utility.info.successnotification')        
                @elseif(session()->has('error'))
                @include('utility.info.failnotification')        
                @endif
                </br>
                @yield('content')
            </div>
        </div>
        <nav class="footer-nav">
            <ul>

                <li>
                    <a href="/openbudgets.github.io/about">About</a>
                </li>

                <li>
                    <a href="/openbudgets.github.io/about/work-packages">Work Packages</a>
                </li>

                <li>
                    <a href="/openbudgets.github.io/about/deliverables">Deliverables</a>
                </li>

                <li>
                    <a href="/openbudgets.github.io/about/technical-structure">Technical Structure</a>
                </li>

                <li>
                    <a href="/openbudgets.github.io/resources">Resources</a>
                </li>

            </ul>
        </nav>
    </main>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/patosai/tree-multiselect/v2.2.1/dist/jquery.tree-multiselect.min.js"></script>
    <script  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/patosai/tree-multiselect/v2.2.1/dist/jquery.tree-multiselect.min.css"/>
    @include('admin.codelists.updateScript')
</body>
</html>