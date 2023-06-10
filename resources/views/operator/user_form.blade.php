@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        {!! Form::text('name', null, ['class' => 'form-control mt-1', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        {!! Form::email('email', null, ['class' => 'form-control mt-1', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" >
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nohp">Nohp / Telepon</label>
                        {!! Form::number('nohp', null, ['class' => 'form-control mt-1', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('nohp') }}</span>
                    </div>
                    @if (\Route::is('user.create'))
                        <div class="form-group mb-3">
                            <label for="access">Access Type</label>
                            {!! Form::select('access',
                                [
                                    'operator' => 'Operator School',
                                    'admin' => 'Administrator'
                                ],
                                null,
                                [
                                    'class' => 'form-control mt-1'
                                ]
                            ) !!}
                            <span class="text-danger">{{ $errors->first('access') }}</span>
                        </div>
                    @endif
                    {!! Form::submit($button, ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
