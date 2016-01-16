<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
        <h1>Hello World</h1>
        @can('edit_user')
            <a href="">Edit the user</a>
        @endcan
    </body>
</html>
