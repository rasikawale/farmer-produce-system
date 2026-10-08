@extends('layouts.farmer')

@section('content')
<h3 class="mb-4">📦 Buyer Requests for Your Produce</h3>

@if($matches->count() == 0)
    <div class="alert alert-warning">
        ❌ सध्या तुमच्या produce साठी कोणतीही buyer demand नाही.
    </div>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Crop</th>
            <th>Your Quantity (KG)</th>
            <th>Buyer Demand (KG)</th>
            <th>Required Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matches as $m)
        <tr>
            <td>{{ $m->crop_name }}</td>
            <td>{{ $m->farmer_qty }}</td>
            <td>{{ $m->buyer_qty }}</td>
            <td>{{ $m->required_date }}</td>
            <td>
                <span class="badge bg-success">Demand Available</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
