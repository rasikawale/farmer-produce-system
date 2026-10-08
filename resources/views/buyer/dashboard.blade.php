@extends('layouts.buyer')

@section('content')
<h3>📊 Buyer Dashboard</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif


<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Crop</th>
            <th>Quantity (KG)</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $req)
        <tr>
            <td>{{ $req->crop_name }}</td>
            <td>{{ $req->required_quantity_kg }}</td>
            <td>{{ $req->required_date }}</td>
            <td>{{ $req->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('buyer.intent.create') }}" class="btn btn-primary mt-3">
    ➕ Create New Demand
</a>

<a href="{{ route('buyer.matches') }}" class="btn btn-success mt-3">
    🤝 View Matching Farmers
</a>
@endsection
