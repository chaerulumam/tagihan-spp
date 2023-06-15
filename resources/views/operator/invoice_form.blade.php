@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    @foreach ($amount as $item)
                        <div class="form-check mb-3">
                            {!! Form::checkbox('amount_id[]', $item->id, null, [
                                'class' => 'form-check-input',
                                'id' => 'defaultCheck' . $loop->iteration,
                            ]) !!}
                            
                            <label for="defaultCheck{{ $loop->iteration }}" class="form-check-label">
                                {{ $item->amount_name_full }}
                            </label>
                        </div>    
                    @endforeach

                    <div class="form-group mb-3">
                        <label for="angkatan">Grade / Years</label>
                        {!! Form::select('angkatan', $angkatan, null, ['class' => 'form-control mt-1', 'placeholder' => 'Choose Years']) !!}
                        <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kelas">KELAS</label>
                        {!! Form::select('kelas', $kelas, null, ['class' => 'form-control mt-1', 'placeholder' => 'Choose Grade']) !!}
                        <span class="text-danger">{{ $errors->first('kelas') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="invoice_date">Invoice Date</label>
                        {!! Form::date('invoice_date', $model->invoice_date ?? date('Y-m-d'), ['class' => 'form-control mt-1']) !!}
                        <span class="text-danger">{{ $errors->first('invoice_date') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="expired_date">Expired Date</label>
                        {!! Form::date('expired_date', $model->expired_date ?? date('Y-m-d'), ['class' => 'form-control mt-1']) !!}
                        <span class="text-danger">{{ $errors->first('expired_date') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        {!! Form::textarea('description', null, ['class' => 'form-control mt-1', 'rows' => 3]) !!}
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
