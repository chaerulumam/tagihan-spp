@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">
                {{ $title }}     
            </h5>
            <div class="card-body">
                <img src="{{ \Storage::url($model->foto ?? 'images/no-image.png') }}" width="150" />
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <td width="15%">ID</td>
                                <td>: {{ $model->id }}</td>
                            </tr>
                            <tr>
                                <td>NAMA</td>
                                <td>: {{ $model->name }}</td>
                            </tr>
                            <tr>
                                <td>EMAIL</td>
                                <td>: {{ $model->email }}</td>
                            </tr>
                            <tr>
                                <td>NUMBER PHONE</td>
                                <td>: {{ $model->nohp }}</td>
                            </tr>
                            <tr>
                                <td>TGL BUAT</td>
                                <td>: {{ $model->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>TGL UBAH</td>
                                <td>: {{ $model->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </thead>
                    </table>
                    <h4 class="my-4">Add Student Record</h4>
                    {!! Form::open(['route' => 'walistudent.store', 'method' => 'POST']) !!}
                        {!! Form::hidden('wali_id', $model->id, []) !!}
                        <div class="form-group mb-2">
                            <label for="student_id">Choose Student Name</label>
                            {!! Form::select('student_id', $student, null, ['class' => 'form-control select2', 'placeholder' => 'Choose name']) !!}
                            <span class="text-danger">{{ $errors->first('student_id') }}</span>
                        </div>
                        {!! Form::submit('SUBMIT', ['class' => 'btn btn-primary btn-sm']) !!}
                    {!! Form::close() !!}
                    <h4 class="my-4">Student Record</h4>
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <td>NO</td>
                                <td>NISN</td>
                                <td>NAME STUDENT</td>
                                <td>ACTION</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($model->student as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    {!! Form::open(['route' => ['walistudent.update', $item->id],
                                        'method' => 'PUT',
                                        'onsubmit' => 'return confirm("Are you sure want to delete this record?")'
                                    ]) !!}
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"> Delete</i>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
