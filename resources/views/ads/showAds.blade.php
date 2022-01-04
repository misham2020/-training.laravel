@if(isset($ads))
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="p-3">{{ $ads->title }}</h5>

                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $active = ' active';
                        @endphp
                        @foreach($ads->imges as $item)
                            <div class="carousel-item {{$active}}">
                                @php
                                    $active = '';
                                @endphp
                                <img src="{{ asset('storage/'.$item->path) }}" width="100%" alt="">
                            </div>
                        @endforeach
                    </div>
                    @if(count($ads->imges) > 1)
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    @endif
                </div>
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
