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
<body class="{{ $dark == true ? 'bg-gray-900 text-gray-200' : 'bg-gray-100 text-gray-900' }}">
    <div class="relative block w-full border {{ $dark == true ? 'bg-gray-900 border-gray-700' : '' }} m-0 p-0 w-full h-full">
        <div class="relative flex w-full overflow-x-auto p-0">
            <div class="highlighter w-full text-sm py-1 {{ $dark == true ? 'dark bg-gray-800' : 'bg-white' }}">
                {!! $content !!}
            </div>
        </div>
        <div class="relative border block w-full {{ $dark == true ? 'bg-gray-900 text-gray-400 border-black' : 'bg-gray-100 text-gray-600 border-gray-200' }} text-xs p-2 overflow-hidden">
            <a href="{{ route('web.entry.raw', $entry) }}" target="_blank" class="float-right text-decoration-none text-gray-500" style="font-weight: 600">
                view raw
            </a>
            Hosted with ❤ by
            <a href="{{ route('web.home.index') }}" target="_blank" class="text-decoration-none {{ $dark == true ? 'text-gray-300' : 'text-gray-800' }}" style="font-weight: 600">
                {{ config('app.name', 'PrivBin') }}
            </a>
        </div>
    </div>
</body>
</html>
