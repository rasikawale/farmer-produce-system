<ul class="nav flex-column text-white mt-4">

@if(auth()->user()->role === 'admin')
    <li class="nav-item"><a class="nav-link text-white" href="/admin/dashboard">Dashboard</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="/admin/farmers">Farmers</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="/admin/produce">Produce</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="/admin/analytics">Analytics</a></li>
@else
    <li class="nav-item"><a class="nav-link text-white" href="/user/dashboard">Dashboard</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="/user/produce">My Produce</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="/user/intents">Buyer Intents</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="/user/matches">Matches</a></li>
@endif

</ul>
