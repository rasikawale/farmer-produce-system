@extends('layouts.buyer')

@section('content')
<div class="container mt-4">
    <h4>📋 My Crop Requests</h4>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Crop</th>
            <th>Quantity (KG)</th>
            <th>Required Date</th>
            <th>Status</th>
        </tr>

        @foreach($requests as $r)
        <tr>
            <td>{{ $r->crop_name }}</td>
            <td>{{ $r->required_quantity_kg }}</td>
            <td>{{ $r->required_date }}</td>
            <td>{{ $r->status }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
