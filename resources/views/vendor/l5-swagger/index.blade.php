<?php

if (app()->environment() != 'testing') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{config('l5-swagger.api.title')}}</title>
    <link rel="icon" type="image/png" href="{{config('l5-swagger.paths.assets_public')}}/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{config('l5-swagger.paths.assets_public')}}/images/favicon-16x16.png" sizes="16x16" />
    <link href='{{config('l5-swagger.paths.assets_public')}}/css/typography.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='{{config('l5-swagger.paths.assets_public')}}/css/reset.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='{{config('l5-swagger.paths.assets_public')}}/css/screen.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='{{config('l5-swagger.paths.assets_public')}}/css/reset.css' media='print' rel='stylesheet' type='text/css'/>
    <link href='{{config('l5-swagger.paths.assets_public')}}/css/print.css' media='print' rel='stylesheet' type='text/css'/>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/object-assign-pollyfill.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jquery-1.8.0.min.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jquery.slideto.min.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jquery.wiggle.min.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jquery.ba-bbq.min.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/handlebars-2.0.0.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/lodash.min.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/backbone-min.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/swagger-ui.min.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/highlight.9.1.0.pack.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/highlight.9.1.0.pack_extended.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jsoneditor.min.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/marked.js' type='text/javascript'></script>
    <script src='{{config('l5-swagger.paths.assets_public')}}/lib/swagger-oauth.js' type='text/javascript'></script>
    <link rel="stylesheet" href="/css/materialize.css">

    <!-- Some basic translations -->
    <!-- <script src='lang/translator.js' type='text/javascript'></script> -->
    <!-- <script src='lang/ru.js' type='text/javascript'></script> -->
    <!-- <script src='lang/en.js' type='text/javascript'></script> -->

@include('vendor.l5-swagger.script')
</head>

<body class="swagger-section">
@include('vendor.l5-swagger.header')

<div id="message-bar" class="swagger-ui-wrap" data-sw-translate>&nbsp;</div>
<div id="swagger-ui-container" class="swagger-ui-wrap"></div>
@include('vendor.l5-swagger.footer')
</body>
</html>
