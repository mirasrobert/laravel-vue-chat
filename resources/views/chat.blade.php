<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <script src="https://cdn.tailwindcss.com"></script>


</head>
<body>


    <main id="app">

        <div class="container mx-auto px-4">
            <h1>Chat Room</h1>
        </div>

        <Chat />

        <!-- -->




    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
