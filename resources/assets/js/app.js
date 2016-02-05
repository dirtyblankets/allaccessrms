//Bootstrap expects jQuery to be global and with the first line we are including jQuery and assigning it to the window. The second line is requiring Bootstrap JavaScript.
//The last section is just a jQuery on ready and logging out the bootstrap tooltip version.
//This is used to just confirm it’s loading as we expect.
window.$ = window.jQuery = require('jquery');
require('jquery-ui');
require('bootstrap-sass');
require('bootstrap.transition');
require('bootstrap.collapse');
require('moment');
require('eonasdan-bootstrap-datetimepicker');
