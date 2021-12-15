@if(isset($category))
    <div class="container">
        <div class="row">
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
