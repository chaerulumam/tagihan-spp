@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">DETAIL INVOICE</h5>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td colspan="8" width="100">
                            <img src="{{ \Storage::url($student->foto) }}" alt="{{ $student->name }}" width="150">
                        </td>
                    </tr>
                    <tr>
                        <td width="50">NISN</td>
                        <td>: {{ $student->nisn }}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>: {{ $student->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                INVOICE DATE
            </div>
            <div class="card-body">
                invoice date
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                SPP CARD
            </div>
            <div class="card-body">
                spp card
            </div>
        </div>
    </div>
</div>
@endsection
