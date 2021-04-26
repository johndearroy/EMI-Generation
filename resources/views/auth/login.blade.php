<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

    <title>{{ config('app.name') ?? 'EMI-Generation App' }}</title>
</head>
<body>
<div id="app">
    <login logo="{{ config('app.name') }}"></login>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
