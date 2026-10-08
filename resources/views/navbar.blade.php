<nav class="navbar navbar-dark bg-success px-3">
    <span class="navbar-brand">🌾 Farmer Produce System</span>

    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-light btn-sm">Logout</button>
    </form>
</nav>
