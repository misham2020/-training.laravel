<div class="container">
    <div class="row">
        <div class="col-md-6">
        <h3>Список категорий:</h3>
            <ul>
            @if($category)
            @foreach($category as $item)
                <li><a href="{{'ads/'. $item->id }}">{{ $item->title }}</a></li>
            @endforeach
            @endif
            </ul>
        </div>
    </div>
    <a href="/publication">Мои объявления</a>
</div>


