@if(isset($ads))
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul>
                    @foreach($ads as $item)
                            <li><a href="{{ 'ads/'.$item->cat()->first()->slug.'/'.$item->id }}">{{ $item->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
