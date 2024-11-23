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
    <title>Sign Up</title>
</head>

<body>
    <div class="bodo">
        <div class="left-login" style="background-image: url('asst/bg-login.png'); background-size: cover; background-position: center;">
            <div class="left-middle">
                <div class="left">
                    <h1>Sign up to</h1>
                    <h2>GenKi Website</h2>
                    <div class="combine">
                        <p>If you already have an account,</p>
                        <p>You can <a href="{{ route('login') }}">Login here!</a></p>
                    </div>
                </div>
                <img src="asst/login-man.png" alt="">
            </div>
        </div>
        <div class="right-login">
            <h1>Sign up</h1>
            <form method="POST" action="{{ route('signup') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="inputan" id="email" placeholder="Enter email" required>
                    <div id="email-error" class="text-danger mt-2"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="inputan" id="exampleInputUsername" placeholder="Create username" required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone_number" class="inputan" id="exampleInputPhone" placeholder="Contact number" required>
                </div>
                <div class="form-group">
                    <div class="password-wrapper">
                        <input type="password" name="password" class="inputan" id="password" placeholder="Password" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                    <div id="password-error" class="text-danger mt-2"></div>
                </div>
                <div class="form-group">
                    <div class="password-wrapper">
                        <input type="password" name="password_confirmation" class="inputan" id="password_confirmation" placeholder="Confirm Password" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword2"></i>
                        <div id="password-confirmation-error" class="text-danger mt-2"></div>
                    </div>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>
    
    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function () {
                const input = this.previousElementSibling;
                input.type = input.type === 'password' ? 'text' : 'password';
                this.classList.toggle('fa-eye-slash');
            });
        });

        // Validate passwords
        document.querySelector('form').addEventListener('submit', function (event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const email = document.getElementById('email').value;

    if (password.length < 8) {
        document.getElementById('password-error').textContent = 'Password harus terdiri dari minimal 8 karakter.';
        event.preventDefault();
    } else {
        document.getElementById('password-error').textContent = '';
    }

    if (password !== confirmPassword) {
        document.getElementById('password-confirmation-error').textContent = 'Password dan konfirmasi password tidak cocok!';
        event.preventDefault();
    } else {
        document.getElementById('password-confirmation-error').textContent = '';
    }

    if (email.length === 0) {
        document.getElementById('email-error').textContent = 'Email tidak boleh kosong.';
        event.preventDefault();
    }
});


        // Check email availability
        document.getElementById('email').addEventListener('input', function () {
            const email = this.value;
            const emailError = document.getElementById('email-error');

            if (email.length > 0) {
                fetch("{{ route('check.email') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        emailError.textContent = data.message;
                    } else {
                        emailError.textContent = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            } else {
                emailError.textContent = '';
            }
        });
    </script>
</body>

</html>
