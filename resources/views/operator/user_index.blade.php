@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Data User</h5>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Access</th>
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
