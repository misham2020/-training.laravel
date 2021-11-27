@if($ads)
<div class="banner">
    <div class="w3l_banner_nav_right">
        <div class="agileinfo_single">
            <h5>Название:{{ $ads->title }}</h5>
                @foreach($ads->imges as $item)
                <div class="col-md-4 agileinfo_single_left">
                <img src="{{ asset('img/'.$item->path.'.jpg') }}" width="250" height="200" alt="">
                </div>
                @endforeach
        <div class="snipcart-item block">
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        <h4>
                          Стоимость:{{  $ads->cost }}
                        </h4>
                        <h4>
                        категория:
                        @if($category)
                        @foreach($category as $item)
                            {{ $item->title }}
                        @endforeach
                        @endif
                        </h4>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endif 