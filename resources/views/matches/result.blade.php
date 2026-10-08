<h2>Matching Farmers for {{ $intent->crop_name }}</h2>

<table border="1">
    <tr>
        <th>Farmer</th>
        <th>Village</th>
        <th>Quantity (KG)</th>
        <th>Harvest Date</th>
    </tr>

    @foreach($matches as $produce)
    <tr>
        <td>{{ $produce->farmer->name }}</td>
        <td>{{ $produce->farmer->village }}</td>
        <td>{{ $produce->quantity_kg }}</td>
        <td>{{ $produce->harvest_date }}</td>
    </tr>
    @endforeach
</table>
