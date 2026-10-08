@extends('layouts.buyer')

@section('content')
<h3>➕ Create Buyer Demand</h3>

<form method="POST" action="{{ route('buyer.intent.store') }}">
    @csrf

    <div class="mb-3">
        <label>Crop Name</label>
        <input type="text" name="crop_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Required Quantity (KG)</label>
        <input type="number" name="required_quantity" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Required Date</label>
        <input type="date" name="required_date" class="form-control" required>
    </div>

    <button class="btn btn-success">Create Demand</button>
</form>
@endsection
