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
<body>
    <div class="card m-0 w-100">
        <div class="card-body p-0" style="width: 100%; overflow-x: auto">
            {!! $content !!}
        </div>
        <div class="card-footer text-gray-600 small">
            <div class="row">
                <div class="col my-auto">
                    Hosted with <span class="text-danger">❤</span> by <a href="{{ route('web.home.index') }}" target="_blank" class="text-decoration-none text-gray-700">{{ config('app.name') }}</a>
                </div>
                <div class="col-auto my-auto">
                    <a href="{{ route('web.entry.raw', $entry) }}" target="_blank" class="btn btn-sm">
                        View Raw
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
