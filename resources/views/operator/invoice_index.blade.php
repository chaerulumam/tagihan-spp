@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary btn-sm">Add Record</a>
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                            <div class="row">
                                <div class="col">
                                    {!! Form::selectMonth('month', request('month'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col">
                                    {!! Form::selectRange('year', 2022, date('Y') + 1, request('year'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary btn-sm" type="submit">See Detail</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Student Name</th>
                                <th>Invoice Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($models as  $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->student->nisn }}</td>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->invoice_date->format('d-M-Y') }}</td>
                                <td>
                                    
                                    {!! Form::open([
                                        'route' => [$routePrefix . '.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Are you sure want to delet this record?")'
                                        ]) !!}
                                                <a href="{{ route($routePrefix . '.show', [
                                                     $item->student->id,
                                                     'student_id' => $item->student_id,
                                                     'month' => $item->invoice_date->format('m'),
                                                     'year' => $item->invoice_date->format('Y'),
                                                ] ) }}" class="btn btn-success mx-3 btn-sm">
                                                    <i class="fa-solid fa-circle-info"></i> Details
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>  Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-primary font-bold">No Records</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div class="mt-2">
                        {{ $models->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
