@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Welcome, {{ auth()->user()->name }}! (<span>{{ auth()->user()->access }}</span>)</h5>
                
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('You are logged in as Operator!') }}
            </div>
        </div>
    </div>
</div>
@endsection
