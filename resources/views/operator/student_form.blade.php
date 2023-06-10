@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true]) !!}
                    <div class="form-group mb-3">
                        <label for="wali_id">Wali Name</label>
                        {!! Form::select('wali_id', $wali, null, ['class' => 'form-control mt-1']) !!}
                        <span class="text-danger">{{ $errors->first('wali_id') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Student Name</label>
                        {!! Form::text('name', null, ['class' => 'form-control mt-1', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nisn">NISN</label>
                        {!! Form::text('nisn', null, ['class' => 'form-control mt-1', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('nisn') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jurusan">Majority</label>
                        {!! Form::select('jurusan',
                            [
                                'RPL' => 'Rekayasa Perangkat Lunak',
                                'TKJ' => 'Teknik Komputer Jaringan'
                            ],
                            null,
                            [
                                'class' => 'form-control mt-1'
                            ]
                        ) !!}
                        <span class="text-danger">{{ $errors->first('jurusan') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kelas">Grade</label>
                        {!! Form::select('kelas',
                            [
                                'x' => 'X',
                                'xi' => 'XI',
                                'xii' => 'XII',
                            ],
                            null,
                            [
                                'class' => 'form-control mt-1'
                            ]
                        ) !!}
                        <span class="text-danger">{{ $errors->first('kelas') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="angkatan">Year/Class</label>
                        {!! Form::selectRange('angkatan', 2022, date('Y') + 1, null, ['class' => 'form-control mt-1', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto">FOTO <strong>(Format: jpg, jpeg, png. 2MB max)</strong></label>
                        {!! Form::file('foto', null, ['class' => 'form-control mt-1', 'accept' => 'image/*']) !!}
                        <span class="text-danger">{{ $errors->first('foto') }}</span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
