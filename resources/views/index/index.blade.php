<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Список категорий:</h3>
            <ul>
                @if(isset($category))
                    @foreach($category as $item)
                        <li><a href="{{'ads/'. $item->id }}">{{ $item->title }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

    <a href="{{ route('category') }}">Все категории</a>
    <div class="row">
        <h3>Объявления:</h3>
        @foreach($ads as $item)
            <div class="col">
                <a href="{{'ads/'.$item->cat->first()->slug.'/'. $item->id }}"><strong class="title">{{ Str::substr($item->title, 0, 25) }}</strong></a>
                <img class="img-responsive" src="{{ asset('storage/'.$item->imges->first()->path) }}" width="240px"
                     alt="">
                {{ $item->cost.'руб' }}
            </div>
        @endforeach
        {{$ads->links()}}
    </div>
</div>


