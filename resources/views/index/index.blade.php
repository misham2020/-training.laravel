<div class="container p-6">
    <div class="row">
        <div class="col-md-4">
           <div class="my-3"> <h3>Список категорий:</h3></div>
            <div class="list-group list-group-flush">
                @if(isset($category))
                    @foreach($category as $item)
                        <a class="list-group-item list-group-item" href="{{'ads/'. $item->id }}">{{ $item->title }}</a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item h4 my-2" href="{{ route('category') }}">Все категории</a>
            </div>
        </div>
    </div>
    <h3 class="my-3">Объявления:</h3>
    <div class="row row-cols-5">
        @foreach($ads as $item)
            <div class="col">
                <div><a href="{{'ads/'.$item->cat->first()->slug.'/'. $item->id }}"><strong
                            class="title">{{ Str::substr($item->title, 0, 25) }}</strong></a></div>
                <img class="d-block float-left" src="{{ asset('storage/'.$item->imges->first()->path) }}" width="240px"
                     alt="">
                <div>{{ $item->cost.'руб' }}</div>
            </div>
        @endforeach
        {{$ads->links()}}
    </div>
</div>


