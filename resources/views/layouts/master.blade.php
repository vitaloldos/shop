<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 24.11.15
 * Time: 12:40
 */
 -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Продукты</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery.dataTables.css">
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/assets/js/main.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">Главная</a>
        </div>
        <div class="nav navbar-nav navbar-right">
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('products.index') }}">Продукты</a></li>
            <li><a href="{{ route('categories.index') }}">Категории</a></li>
            <li><a href="{{ route('discounts.index') }}">Скидки</a></li>
        </div>
    </div>
</nav>

<main>
    <div class="container">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

</body>
</html>