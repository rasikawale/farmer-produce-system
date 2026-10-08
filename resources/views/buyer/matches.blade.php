@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="mb-4">🌾 Matching Farmers</h3>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Crop</th>
                <th>Required Qty (KG)</th>
                <th>Available Qty (KG)</th>
                <th>Farmer</th>
                <th>Village</th>
                <th>Distance</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($matches as $m)
            <tr>
                <td>{{ $m->crop_name }}</td>
                <td>{{ $m->required_quantity_kg }}</td>
                <td>{{ $m->available_qty }}</td>
                <td>{{ $m->farmer_name }}</td>
                <td>{{ $m->village }}</td>
                <td>
                    {{ number_format($m->distance, 1) }} km
                    <span class="badge bg-success ms-1">Nearby</span>
                </td>
                <td>
                    <span class="badge bg-warning text-dark">
                        {{ ucfirst($m->status) }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    No matching farmers found within 60 km 🚜
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection
