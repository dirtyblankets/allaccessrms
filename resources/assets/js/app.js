window.$ = window.jQuery = require('jquery')
require('bootstrap-sass');

$("#sidebar-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("toggled");
});