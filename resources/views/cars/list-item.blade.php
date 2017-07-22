<li>
    <div class="panel panel-default">
        <div class="panel-heading"><a href="{{ route('cars.show', ['id' => $car['id']]) }}">{{ $car['model'] }}</a></div>
        <div class="panel-body">
            <p><span class="text-muted">Color:</span>&nbsp;{{ $car['color'] }}</p>
            <p><span class="text-muted">Price:</span>&nbsp;{{ $car['price'] }}</p>
        </div>
    </div>
</li>