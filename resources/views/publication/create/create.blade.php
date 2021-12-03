@section('create')
<div id="content-page" class="content group">
<div class="hentry group">
{!! Form::open(['url' => (isset($ads->id)) ? route('update', $ads->id) : route('store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
	<ul>
		<li class="text-field">
			<label for="Ad-Title">
				<span class="label">Заголовок объявления:</span>
				<br />
			</label>
			<div class="input-prepend"><span class="add-on"></span>
			{!! Form::text('title',isset($ads->title) ? $ads->title  : old('title'), ['placeholder'=>'Введите название объявления']) !!}
			 </div>
		 </li>
			<li class="text-field">
				<label for="cost">
					<span class="label">Стоимость</span><br />
				</label>
				<div class="input-prepend"><span class="add-on"></span>
				{!! Form::number('cost',isset($ads->cost) ? $ads->cost  : old('cost'), ['placeholder'=>'Введите стоимость объявления']) !!}
				 </div>
		</li>
		@if(isset($ads))
		@foreach($ads->imges as $item)
			<li class="textarea-field">
				<label>
					 <span class="label">Фото объявления:</span>
				</label>
				{{ Html::image(asset('/img/'.$item->path.'.jpg','',['style'=>'width:400px'])) }}
				{!! Form::hidden('old_image',$item->path) !!}
			
				</li>
		@endforeach
		@else
		<li class="text-field">
			<label for="Photo-ads">
				<br />
				<span class="label">Фото объявления</span><br />
			</label>
			<div class="input-prepend">
				{!! Form::file('image', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
			 </div>
			 
		</li>	
		@endif
	<li class="text-field">
			<label for="Ad-category">
				<br />
				<span class="label">Категория объявления</span><br />
			</label>
			@if(isset($ads))
			@foreach($ads->cat as $item)
			<div class="input-prepend">
				{!! Form::select('category_id', $item->id) !!}
			</div>
			@endforeach
            @else
			<div class="input-prepend">
				{!! Form::select('category_id', $lists, '') !!}
			</div>
			@endif 
	</li>	 
		
		@if(isset($article->id))
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