@section('index')
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
    @if(isset($ads))
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Мои объявления:</h1>
                    @foreach($ads as $item)
                        <div>
                            <div class="align-left">№объявления:{{$item->id}}</div>
                            <div class="align-left">Заголовок
                                объявления:{!! Html::link(route('edit.publication', $item->id), $item->title) !!}</div>
                            @foreach($item->imges as $img)
                                <img class="img-responsive" src="{{ asset('storage/'.$img->path) }}" width="200" alt="">
                            @endforeach
                            <div>
                                {!! Form::open(['url' => route('destroy.publication', $item->id),'class'=>'form-horizontal','method'=>'POST']) !!}
                                {{ method_field('DELETE') }}
                                {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
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
        <h2>У Вас пока нет объявлений</h2>
        {!! Html::link(route('create.publication'),'Добавить  объявление',['class' => 'btn btn-the-salmon-dance-3']) !!}
    @endif
@endsection
