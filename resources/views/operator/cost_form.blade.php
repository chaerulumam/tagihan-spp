@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true]) !!}
                    <div class="form-group mb-3">
                        <label for="name">Module Name</label>
                        {!! Form::text('name', null, ['class' => 'form-control mt-1', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">QUANTITY / PRICE</label>
                        {!! Form::text('quantity', null, ['class' => 'form-control rupiah mt-1', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
