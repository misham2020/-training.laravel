@if(isset($ads))
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul>
                    @foreach($ads as $item)
                        @foreach($item->cat as $catgory)
                            <li><a href="{{ 'ads/'.$catgory->slug.'/'.$item->id }}">{{ $item->title }}</a></li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
