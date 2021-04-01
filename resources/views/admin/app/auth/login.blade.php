<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ request()->segment(1) == 'admin' ? 'Admin' : 'Kasir' }} Lamongan Mart</title>

    @include('admin.partials.stylesheet')
</head>


<body>
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('assets/admin/img/logoDinas.jpg') }}" alt="logo" width="100">
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Login</h4>
                        </div>
                        <div class="card-body">
                            {!! Form::open() !!}
                            <div class="form-group">
                                {!! Form::label('username', 'Username', ['class' => 'control-label']) !!}
                                {!! Form::text('username', null, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required', 'autofocus']) !!}
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                                {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : null), 'required']) !!}
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.partials.js')
</body>
</html>