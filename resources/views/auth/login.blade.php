@extends('light-bootstrap-dashboard::layouts.auth')
<script>
    // $(document).ready(function () {
        // $('#email,#password').val('');
    //     document.getElementById('email').innerText='';
    // });

</script>
@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="auth-card card">
                <div class="card-header">
                    <h4 class="card-title">Login</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Username Or Email address</label>
                            <input name="email" value='0' id="email" type="text" class="form-control"
                                   onfocus="$(this).val('')"
                                   required >
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" class="form-control" required autocomplete="off">
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{--<div>--}}
                            {{--<label class="checkbox">--}}
                            {{--<input type="checkbox" data-toggle="checkbox"> Remember--}}
                            {{--</label>--}}
                            {{--</div>--}}
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        <a href="{{ route('register') }}" class="btn btn-lg btn-default btn-block">Register</a>
                        <div class="text-right">
                            <a href="{{ route('password.request') }}" class="text-muted">Forgot Password</a>
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
