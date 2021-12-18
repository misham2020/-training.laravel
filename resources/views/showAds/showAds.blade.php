@if(isset($ads))
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5 class="p-3">{{ $ads->title }}</h5>
                @foreach($ads->imges as $item)
                    <img class="img-responsive" src="{{ asset('storage/'.$item->path) }}" width="500" alt="">
                @endforeach
                        <h4 class="p-3">
                            Стоимость:{{  $ads->cost }}руб
                        </h4>
                        <h4 class="p-3">
                            категория:<br>
                            @foreach($ads->cat as $item)
                                {{ $item->title}}
                            @endforeach
                        </h4>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
@endif
