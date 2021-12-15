@if(isset($ads))
    <div class="container">
        <div class="row">
            <div class="agileinfo_single">
                <h5>Название:{{ $ads->title }}</h5>
                @foreach($ads->imges as $item)

                    <img class="img-responsive" src="{{ asset('storage/'.$item->path) }}" width="500" alt="">

                @endforeach
                <div class="snipcart-item block">
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        <h4>
                            Стоимость:{{  $ads->cost }}
                        </h4>
                        <h4>
                            категория:<br>
                            @foreach($ads->cat as $item)
                                {{ $item->title}}<br>
                            @endforeach
                        </h4>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
@endif
