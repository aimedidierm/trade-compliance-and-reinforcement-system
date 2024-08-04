<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trade complience and reinforcement system</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        body {
            background-color: #f6f5f4;
        }

        .document-icon {
            width: 100px;
            height: 100px;
        }

        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }

        .status-active {
            color: green;
        }

        .status-inactive {
            color: red;
        }

        .breadcrumb-item::after {
            content: '>';
            margin: 0 0.5rem;
            color: gray;
        }

        .breadcrumb-item:last-child::after {
            content: '';
        }
    </style>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @yield('content')
</body>

</html>