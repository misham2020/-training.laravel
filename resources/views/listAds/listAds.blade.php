<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if($cat)
                <h3 class="p-3">{{ $cat->title }}:</h3>
            @endif
            {{--@if(isset($category))--}}
            <div class="list-group list-group-flush">
                @if(!($category->isEmpty()))
                    @foreach($category as $item)
                        <a class="list-group-item" href="{{$cat->slug.'/'. $item->id }}">{{ $item->title }}</a>
                    @endforeach
                @else
                    <div> В данной категории пока нет объявлений</div>
                @endif
            </div>
            {{$category->links()}}
        </div>
    </div>
</div>

