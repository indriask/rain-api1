<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Your Email Address | RAIN</title>

    {{-- boostrap css cnd --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex align-items-center justify-content-center bg-secondary-subtle flex-column">

    <img style="width: 150px; aspec-ratio: 1/1;" class="d-block mx-auto" src="{{ asset('storage/2d-logo.png') }}" alt="">
    <div class="bg-white rounded shadow px-3 py-4" style="width: 490px;">
        <h3><strong>Confirm Your Email Address</strong></h3>
        <p class="text-secondary" style="font-size: .9rem;">Verify your email address by checking your inbox. Didn’t receive it? Click the button below to resend.</p>
        <form class="mt-4" action="{{ route('verification.send') }}" method="POST">
            <button class="btn btn-dark mx-auto d-block">Resend email</button>
            @csrf
        </form>
    </div>

    {{-- bootstrap js link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
