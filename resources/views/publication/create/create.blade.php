@section('create')
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
			<li class="textarea-field">
			{!!Form::label('Photo-ads', 'Фото объявления:', ['class' => 'label'])!!}
				{{ Html::image(asset('/img/'.$item->path, ''))}} 
				{!! Form::hidden('old_image',$item->path) !!}
		@endforeach
			<div class="input-prepend">
				{!! Form::file('images[]', ['multiple' => true,'class' => 'filestyle','style'=>'width:200', 'data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>""]) !!}
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
	{!!Form::label('Ad-category', 'Категория объявления:', ['class' => 'label'])!!}
			@if(isset($ads))
			@foreach ($categories as $category) 
			<select name="category[]" multiple>
			@foreach($cat as $key => $item)
				<option @if ($category->id == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
			@endforeach 
			</select>
			@endforeach 
            @else
			<div class="input-prepend">
			<select name="category[]" multiple>
			@foreach($lists as $key => $valeu)
				<option  value="{{ $key }}">{{ $valeu }}</option>
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
{{-- <style>
.img1 { 
    w: 120%; 
    
   }
</style> --}}

</div>
</div>	
@endsection