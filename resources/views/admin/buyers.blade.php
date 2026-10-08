@extends('layouts.app')

@section('content')
<div class="container">
<h3>🛒 All Buyers</h3>

<table class="table table-bordered mt-3">
<tr class="table-dark">
<th>Name</th><th>Mobile</th><th>City</th>
</tr>

@foreach($buyers as $b)
<tr>
<td>{{ $b->name }}</td>
<td>{{ $b->mobile }}</td>
<td>{{ $b->city }}</td>
</tr>
@endforeach
</table>
</div>
@endsection
