@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Data User</h5>
            <div class="card-body">
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Add Record</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Access</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($models as  $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nohp }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->access }}</td>
                                <td>
                                    
                                    {!! Form::open([
                                        'route' => ['user.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Are you sure want to delet this record?")'
                                        ]) !!}
                                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Records</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $models->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
