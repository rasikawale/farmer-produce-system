@extends('layouts.app')

@section('content')
<div class="container">
<h3>👨‍🌾 All Farmers</h3>

<table class="table table-bordered mt-3">
<tr class="table-dark">
<th>Name</th><th>Mobile</th><th>Village</th><th>Reliability</th>
</tr>

@foreach($farmers as $f)
<tr>
<td>{{ $f->name }}</td>
<td>{{ $f->mobile }}</td>
<td>{{ $f->village }}</td>
<td>{{ $f->reliability_score }}</td>
</tr>
@endforeach
</table>
</div>
@endsection
