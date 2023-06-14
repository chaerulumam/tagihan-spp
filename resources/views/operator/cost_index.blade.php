@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary btn-sm">Add Record</a>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method'  => 'GET']) !!}
                            <div class="input-group py-2">
                                <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="Search module name.." aria-label="search name" aria-describedby="button-addon2">
                                <button type="submit" class="btn btn-outline-primary" id="button-addon2">
                                    <i class="bx bx-search"></i>
                                </button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Module Cost</th>
                                <th>Quantity</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($models as  $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->formatRupiah('quantity') }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    
                                    {!! Form::open([
                                        'route' => [$routePrefix . '.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Are you sure want to delet this record?")'
                                        ]) !!}
                                                <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="{{ route($routePrefix . '.show', $item->id) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-circle-info"></i> Details</a>
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
                    <div class="mt-2">
                        {{ $models->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
