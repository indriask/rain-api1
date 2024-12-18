<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update your password</title>

    {{-- botostrap css link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- bootstrap icon web font link --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="min-vh-100 d-flex align-items-center justify-content-center bg-body-secondary">

    @error('email')
        <div class="position-absolute top-0 end-0 start-0 z-1">
            <div class="alert alert-danger d-flex align-items-center mx-auto d-block mt-2 gap-1" style="width: fit-content;"
                role="alert">
                <i class="bi bi-exclamation-triangle"></i>
                <div style="font-size: .95rem;">
                    {{ $message }}
                </div>
            </div>
        </div>
    @enderror

    <form action="{{ route('password.update') }}" method="POST" class="border bg-white rounded p-3"
        style="width: 400px;">
        <h4>Reset your password</h4>
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                name="email" aria-describedby="emailHelp">
            @error('email')
                <div class="text-danger m-0" style="font-size: .85rem;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input type="password" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                name="password">
            @error('password')
                <div class="text-danger m-0" style="font-size: .85rem;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password confirmation</label>
            <input type="password" class="form-control" id="exampleInputEmail1" name="password_confirmation"
                aria-describedby="emailHelp">
        </div>
        <input type="hidden" name="token" value="{{ $token }}">
        <button type="submit" class="border border-0 btn btn-primary rounded-0 w-100">Reset</button>
    </form>

    {{-- bootstrap js link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
