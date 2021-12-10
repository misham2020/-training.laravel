@if(isset($category))
<div class="conteiner">
    <div class="raw">
        <div class="col md 6">
            <ul>
            @foreach($category as $item)
                <li><a href="{{'ads/'. $item->id }}">{{ $item->title }}</a></li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
