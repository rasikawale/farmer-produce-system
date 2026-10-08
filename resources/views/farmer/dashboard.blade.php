@extends('layouts.farmer')

@section('content')
<div class="container">

    <h2 class="mb-3">👨‍🌾 Farmer Dashboard</h2>

    <a href="{{ route('farmer.produce') }}" class="btn btn-success mb-4">
        ➕ Add Produce
    </a>

    {{-- ================= PRODUCES ================= --}}
    <h4>🌾 My Produces</h4>
    <table class="table table-bordered">
        <tr class="table-dark">
            <th>Crop</th>
            <th>Quantity</th>
            <th>Status</th>
        </tr>

        @forelse($produces as $p)
            <tr>
                <td>{{ $p->crop_name }}</td>
                <td>{{ $p->quantity_kg }} KG</td>
                <td>{{ ucfirst($p->status) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-muted">
                    No produce added yet
                </td>
            </tr>
        @endforelse
    </table>

    {{-- ================= MATCHES ================= --}}
    <h4 class="mt-4">📥 Buyer Matches</h4>
    <table class="table table-bordered">
        <tr class="table-dark">
            <th>Crop</th>
            <th>Required Qty</th>
            <th>Required Date</th>
            <th>Buyer Name</th>
            <th>Buyer Mobile</th>
            <th>Match %</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @forelse($matches as $m)
            <tr>
                <td>{{ $m->crop_name }}</td>
                <td>{{ $m->required_quantity_kg }} KG</td>
                <td>{{ $m->required_date }}</td>
                <td>{{ $m->buyer_name }}</td>
                <td>{{ $m->mobile }}</td>
                <td>{{ $m->match_score ?? 0 }}%</td>
                <td>{{ ucfirst($m->status) }}</td>

                <td>
                    {{-- WhatsApp Button --}}
                    <a href="https://wa.me/91{{ $m->mobile }}"
                       target="_blank"
                       class="btn btn-success btn-sm mb-1">
                        📱 WhatsApp
                    </a>

                    @if($m->status === 'pending')
                        <form method="POST"
                              action="{{ route('farmer.match.accept', $m->match_id) }}"
                              class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                Accept
                            </button>
                        </form>

                        <form method="POST"
                              action="{{ route('farmer.match.reject', $m->match_id) }}"
                              class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">
                                Reject
                            </button>
                        </form>
                    @else
                        <span class="text-muted">No Action</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted">
                    No matches found
                </td>
            </tr>
        @endforelse
    </table>

</div>
@endsection
