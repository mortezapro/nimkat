<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>لغات پرتکرار سال گذشته</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="container">
    <div class="row justify-content-center table-striped-columns table-hover">
        <div class="col-lg-8 col-12">
            <div class="table-responsive">
                <table class="table table-primary text-center">
                    <thead>
                        <tr>
                            <td>کلمه</td>
                            <td>تعداد تکرار</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($topWords as $key => $word)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $word }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
