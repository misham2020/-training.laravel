@if($ads)
<div class="banner">
    <div class="w3l_banner_nav_right">
        <div class="agileinfo_single">
            <h5>Название:{{ $ads->title }}</h5>
            <div class="col-md-4 agileinfo_single_left">
                <img src="{{ asset('img/'.$ads->img.'.jpg') }}" width="250" height="200" alt="">
            </div>
                <div class="snipcart-item block">
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        <h4>
                            Стоимость:{{ $ads->cost }}
                        </h4>
                        <h4>
                        @foreach($category as $item)
                            категория:{{ $item->title }}
                        @endforeach
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