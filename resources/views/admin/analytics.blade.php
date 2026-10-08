@extends('layouts.app')

@section('content')
<div class="container">
<h3>📈 System Analytics</h3>

<ul class="list-group col-md-4">
<li class="list-group-item">✅ Accepted Matches: {{ $accepted }}</li>
<li class="list-group-item">❌ Rejected Matches: {{ $rejected }}</li>
</ul>
</div>
@endsection
