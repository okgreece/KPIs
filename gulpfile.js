const elixir = require('laravel-elixir');
 
require('laravel-materialize');
require('laravel-elixir-vue-2');
 
elixir(mix => {
    mix.sass('app.scss')
       .materialize()
       .webpack('app.js');
});
