@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- PAGE TITLE -->
    <h3 class="mb-4">🛠 Admin Dashboard</h3>

    <!-- ================= SUMMARY CARDS ================= -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <h6>👨‍🌾 Farmers</h6>
                    <h2 class="fw-bold text-success">{{ $farmersCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <h6>🛒 Buyers</h6>
                    <h2 class="fw-bold text-primary">{{ $buyersCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <h6>🤝 Total Matches</h6>
                    <h2 class="fw-bold text-warning">{{ $totalMatches }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <h6>✅ Accepted</h6>
                    <h2 class="fw-bold text-success">{{ $accepted }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= CHARTS ================= -->
    <div class="row g-4 mb-5">
        <div class="col-md-7">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="mb-3">📈 Match Status Overview</h5>
                    <canvas id="statusLineChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="mb-3">🥧 Match Distribution</h5>
                    <canvas id="statusPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MONTHLY ANALYTICS ================= -->
    <div class="card shadow border-0 mb-5">
        <div class="card-body">
            <h5 class="mb-3">📅 Monthly Matches Analytics</h5>
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    <!-- ================= FARMERS TABLE ================= -->
    <div class="card shadow border-0 mb-5">
        <div class="card-header bg-success text-white">
            👨‍🌾 Farmers Details
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Village</th>
                        <th>District</th>
                        <th>Reliability</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($farmersList as $f)
                    <tr>
                        <td>{{ $f->name }}</td>
                        <td>{{ $f->mobile }}</td>
                        <td>{{ $f->village ?? '-' }}</td>
                        <td>{{ $f->district ?? '-' }}</td>
                        <td>
                            @php
                                $badge = $f->reliability_score < 30 ? 'danger' :
                                         ($f->reliability_score < 70 ? 'warning' : 'success');
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $f->reliability_score }}</span>
                        </td>
                        <td>
                            @if($f->approved)
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if(!$f->approved)
                                <form method="POST" action="{{ route('admin.farmer.approve', $f->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= BUYERS TABLE ================= -->
    <div class="card shadow border-0 mb-5">
        <div class="card-header bg-primary text-white">
            🛒 Buyers Details
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>City</th>
                        <th>Buyer Type</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($buyersList as $b)
                    <tr>
                        <td>{{ $b->name }}</td>
                        <td>{{ $b->mobile }}</td>
                        <td>{{ $b->city ?? '-' }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ ucfirst($b->buyer_type) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= MAP ================= -->
    <div class="card shadow border-0">
        <div class="card-header bg-success text-white">
            📍 Farmers & Buyers Location Map
        </div>
        <div class="card-body">
            <div id="map" style="height:400px;"></div>
        </div>
    </div>

</div>

<!-- ================= JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
/* ---------- DATA ---------- */
const accepted = {{ $matchesByStatus['accepted'] }};
const rejected = {{ $matchesByStatus['rejected'] }};
const pending  = {{ $matchesByStatus['pending'] }};
const total    = accepted + rejected + pending;

/* ---------- LINE CHART ---------- */
new Chart(document.getElementById('statusLineChart'), {
    type: 'line',
    data: {
        labels: ['Accepted','Rejected','Pending'],
        datasets: [{
            label: 'Matches',
            data: [accepted, rejected, pending],
            borderColor: '#198754',
            backgroundColor: 'rgba(25,135,84,0.2)',
            fill: true,
            tension: 0.4
        }]
    }
});

/* ---------- PIE CHART ---------- */
new Chart(document.getElementById('statusPieChart'), {
    type: 'pie',
    plugins: [ChartDataLabels],
    data: {
        labels: ['Accepted','Rejected','Pending'],
        datasets: [{
            data: [accepted, rejected, pending],
            backgroundColor: ['#198754','#dc3545','#ffc107']
        }]
    },
    options: {
        plugins: {
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 14 },
                formatter: value => ((value / total) * 100).toFixed(1) + '%'
            }
        }
    }
});

/* ---------- MONTHLY CHART ---------- */
new Chart(document.getElementById('monthlyChart'), {
    type: 'line',
    data: {
        labels: [
            @foreach($monthlyMatches as $m)
                "{{ $m->month }}",
            @endforeach
        ],
        datasets: [{
            label: 'Monthly Matches',
            data: [
                @foreach($monthlyMatches as $m)
                    {{ $m->total }},
                @endforeach
            ],
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,0.2)',
            fill: true,
            tension: 0.4
        }]
    }
});

/* ---------- MAP ---------- */
var map = L.map('map').setView([20.5937, 78.9629], 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

const farmerIcon = L.icon({
    iconUrl: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',
    iconSize: [32,32],
    iconAnchor: [16,32]
});

const buyerIcon = L.icon({
    iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
    iconSize: [32,32],
    iconAnchor: [16,32]
});

var allMarkers = [];

/* ---------- FARMERS ---------- */
@foreach($farmerLocations as $f)
    @if($f->latitude && $f->longitude)
        var marker = L.marker([{{ $f->latitude }}, {{ $f->longitude }}], {icon: farmerIcon})
            .addTo(map)
            .bindPopup(`<b style="color:green;">👨‍🌾 Farmer</b><br>Name: {{ $f->name }}<br>Mobile: {{ $f->mobile }}<br>City: {{ $f->city ?? '-' }}`);
        allMarkers.push([{{ $f->latitude }}, {{ $f->longitude }}]);
    @endif
@endforeach

/* ---------- BUYERS ---------- */
@foreach($buyerLocations as $b)
    @if($b->latitude && $b->longitude)
        var marker = L.marker([{{ $b->latitude }}, {{ $b->longitude }}], {icon: buyerIcon})
            .addTo(map)
            .bindPopup(`<b style="color:red;">🛒 Buyer</b><br>Name: {{ $b->name }}<br>Mobile: {{ $b->mobile }}<br>City: {{ $b->city ?? '-' }}`);
        allMarkers.push([{{ $b->latitude }}, {{ $b->longitude }}]);
    @endif
@endforeach

/* Fit map to markers */
if(allMarkers.length) map.fitBounds(allMarkers, {padding:[50,50]});

/* ---------- LEGEND ---------- */
const legend = L.control({position: "bottomright"});
legend.onAdd = function() {
    var div = L.DomUtil.create('div', 'legend');
    div.style.background = "white";
    div.style.padding = "10px";
    div.style.borderRadius = "8px";
    div.style.boxShadow = "0 0 5px rgba(0,0,0,0.3)";
    div.innerHTML = "<b>Legend</b><br>🟢 Farmer<br>🔴 Buyer";
    return div;
};
legend.addTo(map);
</script>

@endsection
