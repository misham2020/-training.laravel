@if($category)
    <div class="container">
        <div class="row">
            <div class="col md 6">
                @if($cat)
                    {{ $cat->title }}:
                @endif
                <ul>
                    @foreach($category as $item)
                        <li><a href="{{$cat->slug.'/'. $item->id }}">{{ $item->title }}</a></li>
                    @endforeach
                </ul>
                {{$category->links()}}
            </div>
        </div>
    </div>
@endif
