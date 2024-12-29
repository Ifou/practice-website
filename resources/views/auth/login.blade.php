<style>
    .input-material {
        position: relative;
        z-index: 1;
        background: none;
        border: none;
        border-bottom: 1px solid #ccc;
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #333;
    }

    .input-material:focus {
        outline: none;
        border-bottom: 1px solid #DB6574;
    }

    .label-material {
        position: absolute;
        top: 10px;
        left: 0;
        font-size: 16px;
        color: #aaa;
        transition: all 0.2s ease;
    }

    .input-material:focus + .label-material,
    .input-material:not(:placeholder-shown) + .label-material {
        top: -20px;
        font-size: 12px;
        color: #DB6574;
    }
</style>

<!DOCTYPE html>
<html>
<base href="{{ asset('/public') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
<div class="login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1>Login</h1>
                            </div>
                            <p>Enter your Email and Password.</p>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" type="email" name="email" required data-msg="Please enter your email" class="input-material" placeholder=" " :value="old('email')" autofocus>
                                    <label for="email" class="label-material">Email</label>
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" name="password" required data-msg="Please enter your password" class="input-material" placeholder=" ">
                                    <label for="password" class="label-material">Password</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="show-password" onclick="togglePassword()"> Show Password
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                            <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password?</a><br>
                            <small>Do not have an account? </small><a href="{{ route('register') }}" class="signup">Signup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>2024 &copy; Keto Designs.</p>
    </div>
</div>
<!-- JavaScript files-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery.cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/front.js') }}"></script>
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>
</body>
</html>
