@section('index')
@if($ads)
	<div id="content-page" class="content group">
				            <div class="hentry group">
				                <h2>Добавленные объявление</h2>
				                <div class="short-table white">
				                    <table style="width: 100%" cellspacing="0" cellpadding="0">
				                        <thead>
				                            <tr>
				                                <th class="align-left">ID</th>
				                                <th>Заголовок</th>
				                                {{-- <th>Текст</th> --}}
				                                <th>Изображение</th>
				                                <th>Категория</th>
				                                <th>Псевдоним</th>
				                                <th>Дествие</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                            
											@foreach($ads as $item)
											<tr>
				                                <td class="align-left">{{$item->id}}</td>
				                                <td class="align-left">{!! Html::link(route('edit', $item->id), $item->title) !!}</td>
				                                {{-- <td class="align-left">{{str_limit($article->text,200)}}</td> --}}
                                                @foreach($item->imges as $img)
				                                <td><img src="{{ asset('img/'.$img->path.'.jpg') }}" width="75" alt="">
												
                                                @endforeach
													{{-- @if(isset($article->img->mini))
													{!! Html::image(asset(config('settings.theme')).'/images/articles/'.$article->img->mini) !!}
													{{ Html::image(asset('img/'.$img->path.'.jpg','',['style'=>'width:75px']) }}
													@endif --}}
												</td>
                                                @foreach($item->cat as $category)
				                                <td>{{$category->title}}</td>
                                                @endforeach
				                                <td>{{$item->slug}}</td>
				                                <td>
												{!! Form::open(['url' => route('destroy', $item->id),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
												{!! Form::close() !!}
												</td>
                                                
											 </tr>	
											@endforeach	
				                           
				                        </tbody>
				                    </table>
				                </div>
								
								 {!! Html::link(route('create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-3']) !!}
                                
				                
				            </div>
				            <!-- START COMMENTS -->
				            <div id="comments">
				            </div>
				            <!-- END COMMENTS -->
				        </div>
@endif
@endsection