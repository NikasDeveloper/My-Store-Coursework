@extends('_layouts.app')

@section("title", "Prisijungimas")

@section('content')
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Prisijungimas</h4>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>
                            <input id="email" type="email" class="form-control border-input" name="email"
                                   value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" type="password" class="form-control border-input" name="password"
                                   required>
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Prisiminti mane
                                </label>
                            </div>
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary btn-lg">
                                Prisijungti
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
