@section('create')
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
    <div id="content-page" class="content group">
        <div class="hentry group">
            {!! Form::open(['url' => (isset($ads->id)) ? route('update.publication', $ads->id) : route('store.publication'), 'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <ul>
                <li class="text-field">
                    {!!Form::label('Ad-Title', 'Заголовок объявления:', ['class' => 'label'])!!}
                    <div class="input-prepend"><span class="add-on"></span>
                        {!! Form::text('title',isset($ads->title) ? $ads->title  : old('title'), ['placeholder'=>'Введите название объявления']) !!}
                    </div>
                </li>
                <li class="text-field">
                    {!!Form::label('cost', 'Стоимость:', ['class' => 'label'])!!}
                    <div class="input-prepend"><span class="add-on"></span>
                        {!! Form::number('cost',isset($ads->cost) ? $ads->cost  : old('cost'), ['placeholder'=>'Введите стоимость объявления']) !!}
                    </div>
                </li>
                @if(isset($ads))
                    @foreach($ads->imges as $item)

                        <li class="img-field">
                            {!!Form::label('Photo-ads', 'Фото объявления:', ['class' => 'label'])!!}
                            {{ Html::image(asset('storage/'.$item->path, ''))}}
                            {!! Form::hidden('old_image',$item->path) !!}
<!--                         <div>

                                {!! Form::open(['url' => route('destroy.image', $item->id),'class'=>'form-horizontal','method'=>'POST']) !!}

                                {{ method_field('DELETE') }}
                                {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </div>-->
                       <a class="btn btn-french-5" href="{{ route('destroy.image', $item->id) }}">удалить</a>

                        </li>
                    @endforeach
                    <li>
                        <div class="input-prepend">
                            {!! Form::file('images[]', ['multiple' => true,'class' => 'filestyle', 'data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>""]) !!}
                        </div>
                    </li>
                @else
                    <li class="text-field">
                        {!!Form::label('Photo-ads', 'Фото объявления:', ['class' => 'label'])!!}
                        <div class="input-prepend">
                            {!! Form::file('images[]', ['multiple' => true, 'class' => 'filestyle','data-buttonText'=>'Выберите изображение',
                            'data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
                        </div>

                    </li>
                @endif
                <li class="text-field">
                    @if(isset($ads))
                        {!!Form::label('Ad-category', 'Выберите категорию:', ['class' => 'label'])!!}
                        @foreach($cat as $key => $item)
                            <p><input type="checkbox" name="category[]" value="{{ $key }}"
                                      @foreach ($ads->cat as $category) @if($category->id === $key ) checked @else
                                    '' @endif @endforeach>
                                {{ $item }}</p>
                        @endforeach
                    @else
                        {!!Form::label('Ad-category', 'Выберите категорию:', ['class' => 'label'])!!}
                        <div class="input-prepend">
                            <select name="category[]" multiple>
                                @foreach($lists as $key => $valeu)
                                    <option value="{{ $key }}">{{ $valeu }}</option>
                                @endforeach
                            </select>

                        </div>
                    @endif
                </li>
                @if(isset($ads->id))
                    <input type="hidden" name="_method" value="PUT">

                @endif
                <li class="submit-button">
                    {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
                </li>

            </ul>

            {!! Form::close() !!}

</div>
</div>
@endsection
