@extends('layouts.app')

@section('content')
<div class="container">
<h3>➕ Add Produce</h3>

<form method="POST" action="{{ route('farmer.produce.store') }}">
@csrf

<input name="crop_name" class="form-control mb-2" placeholder="Crop Name" required>
<input name="quantity_kg" class="form-control mb-2" placeholder="Quantity (KG)" required>
<input type="date" name="harvest_date" class="form-control mb-2" required>
<input type="date" name="available_date" class="form-control mb-2" required>

<button class="btn btn-primary">Save</button>
</form>
</div>
@endsection
