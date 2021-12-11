@if(isset($ads))
    <div class="banner">
        <div class="w3l_banner_nav_right">
            <div class="agileinfo_single">
                <h5>Название:{{ $ads->title }}</h5>
                @foreach($ads->imges as $item)

                    <img class="img-responsive" src="{{ asset('storage/'.$item->path) }}" width="200" alt="">

                @endforeach
                <div class="snipcart-item block">
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        <h4>
                            Стоимость:{{  $ads->cost }}
                        </h4>
                        <h4>
                            категория:
                            @foreach($ads->cat as $item)
                                {{ $item->title.', ' }}
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
