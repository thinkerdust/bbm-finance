<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Page</title>
        <link rel="stylesheet" href="{{ asset('/assets/bower-components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/login-style.css') }}">
    </head>
    <body>
        <div class="login-form">    
            <form action="{{ route('login') }}" method="POST">
                @csrf
		        <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
                    <h4 class="modal-title">Login to Your Account</h4>
                <div class="form-group">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required="required" autocomplete="off">
                    <span>{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required="required" name="password" autocomplete="off">
                    <span>{{ $errors->first('password') }}</span>
                </div>
                <div class="form-group small clearfix">
                    <label class="checkbox-inline"><input type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div> 
                <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">              
            </form>			
            <div class="text-center small">Don't have an account? <a href="#">Sign up</a></div>
        </div>
        
        <script src="{{ asset('/assets/bower-components/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/bower-components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    </body>
</html>