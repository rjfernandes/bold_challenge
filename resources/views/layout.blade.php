<!DOCTYPE html>
<html lang="en" ng-app="bold">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Bold') }} - @yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/app.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 appHeader">
                <img src="/images/boldlogo.png" class="logo" alt="Bold Commerce" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 appHeader">
                <h4>@yield('title')</h4>
            </div>
        </div>

        @yield('content')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/rxjs/2.2.28/rx.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js"></script>
    <script>
        var app = angular.module('bold', []);
    </script>
    @yield('js_style')
</body>
</html>