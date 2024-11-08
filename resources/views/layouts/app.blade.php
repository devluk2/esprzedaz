<!DOCTYPE html>
<html>

<head>
    <title>@yield('title') - Pet Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
    <style>
        textarea {
            resize: none;
        }

        .container {
            max-width: 1024px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .message {
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .message-success {
            background: #dff0d8;
            color: #3c763d;
        }

        .message-error {
            background: #f2dede;
            color: #a94442;
        }

        .button-success {
            background: rgb(28, 184, 65);
        }

        .button-warning {
            background: rgb(223, 117, 20);
        }

        .button-secondary {
            background: rgb(66, 184, 221);
        }

        .tag {
            background: #e0e0e0;
            padding: 2px 6px;
            border-radius: 3px;
            margin-right: 4px;
            font-size: 0.9em;
        }

        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        .photo-item {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            background: #f5f5f5;
        }

        .pure-button-group {
            margin: 1rem 0;
        }
    </style>
</head>

<body>
    <div class="container">
        @if(session('success'))

        <div class="message message-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))

        <div class="message message-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>

</html>