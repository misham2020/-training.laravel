@foreach(['success','danger'] as $status)
    @if(session()->has($status))
        <div class="alert alert-{{$status}} text-center">
            {{session()->get($status)}}
        </div>
    @endif
@endforeach
@if ($errors->any())
    <div class="alert alert-danger text-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(count($ads))
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="p-3">Мои объявления:</h1>
                @foreach($ads as $item)
                    <div>
                        <div class="my-2">№объявления:{{$item->id}}</div>
                        <div class="my-2">Заголовок
                            объявления:{!! Html::link(route('edit.publication', $item->id), $item->title) !!}</div>
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                    $active = ' active';
                                @endphp
                                @foreach($item->imges as $img)
                                    <div class="carousel-item {{$active}}">
                                        @php
                                            $active = '';
                                        @endphp
                                        <img src="{{ asset('storage/'.$img->path) }}" width="100%" alt="">
                                    </div>
                                @endforeach
                            </div>
                            @if(count($item->imges) > 1)
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
                        <div>
                            {!! Form::open(['url' => route('destroy.publication', $item->id),'class'=>'form-horizontal','method'=>'POST']) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button('Удалить', ['class' => 'm-1 btn btn-french-5','type'=>'submit']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {!! Html::link(route('create.publication'),'Добавить  объявление',['class' => 'btn btn-the-salmon-dance-3']) !!}
    </div>
    </div>
@else
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="my-4 h3">У Вас пока нет объявлений</div>
                {!! Html::link(route('create.publication'),'Добавить  объявление',['class' => 'btn btn-the-salmon-dance-3']) !!}
            </div>
        </div>
    </div>
@endif

