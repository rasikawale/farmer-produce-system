@extends('layouts.app')

@section('content')
<h3>Create Demand</h3>

<form method="POST" action="{{ route('buyer.intent.store') }}">
@csrf

<input type="text" name="crop_name" placeholder="Crop Name" required class="form-control mb-2">

<input type="number" name="required_quantity" placeholder="Required Quantity (KG)" required class="form-control mb-2">

<input type="date" name="required_date" required class="form-control mb-2">

<button class="btn btn-primary">Submit Demand</button>
</form>
@endsection
