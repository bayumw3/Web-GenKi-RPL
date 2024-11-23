<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="bodo">
        <div class="left-login" style="background-image: url('asst/bg-login.png'); background-size: cover; background-position: center;">
            <div class="left-middle">
                <div class="left">
                    <h1>Sign in to</h1>
                    <h2>GenKi Website</h2>
                    <div class="combine">
                        <p>If you don't have an account register</p>
                        <p>You can <a href="{{ route('register') }}">Register here !</a></p>
                    </div>
                </div>
                <img src="asst/login.png" alt="">
            </div>
        </div>
        <div class="right-login">
            <h1>Sign in</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="inputan" id="exampleInputEmail1" placeholder="Enter email" required>
                </div>
                <div class="formku form-group">
                    <div class="password-wrapper">
                        <input type="password" name="password" class="inputan" id="exampleInputPassword1" placeholder="Password" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            @if ($errors->has('loginError'))
                <div class="alert alert-danger">{{ $errors->first('loginError') }}</div>
            @endif

        </div>
    </div>
</body>
<script>
    // Mendapatkan elemen input dan tombol mata
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('exampleInputPassword1');

    // Menambahkan event listener untuk toggle password
    togglePassword.addEventListener('click', function() {
        // Memeriksa tipe input dan mengganti tipe antara password dan text
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        // Mengubah ikon mata (open/closed)
        this.classList.toggle('fa-eye-slash');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>