<!doctype html>
<html>
<head>
    <title>Hosted by {{ config('app.name', 'PrivBin') }}</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <base target="_blank">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            margin: 0;
            padding: 0;
        }
        pre {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body class="{{ $dark == true ? 'bg-dark text-light' : '' }}">
    <div class="card {{ $dark == true ? 'bg-dark border-gray-800' : '' }} m-0 w-100">
        <div class="card-body p-0" style="width: 100%; overflow-x: auto">
            <div class="highlighter {{ $dark == true ? 'dark' : '' }}">
                {!! $content !!}
            </div>
        </div>
        <div class="card-footer {{ $dark == true ? 'bg-dark text-gray-500' : 'text-gray-600' }} small text-gray-600" style="padding: 10px; overflow: hidden; font-size: 12px">
            <a href="{{ route('web.entry.raw', $entry) }}" target="_blank" class="float-end text-decoration-none text-gray-600" style="font-weight: 600">
                view raw
            </a>
            Hosted with ❤ by
            <a href="{{ route('web.home.index') }}" target="_blank" class="text-decoration-none text-gray-600" style="font-weight: 600">
                {{ config('app.name', 'PrivBin') }}
            </a>
        </div>
    </div>
</body>
</html>
