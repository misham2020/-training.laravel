@if($category)
<div class="conteiner">
    <div class="raw">
        <div class="col md 6">
            @if($cat)
            {{ $cat->title }}:
            @endif
            <ul>
                @foreach($category as $item)
                    <li><a href="{{'ads/'. $item->id }}">{{ $item->title }}</a></li>
                @endforeach
            </ul>
            {{$category->links()}}
        </div>
    </div>
</div>
@endif