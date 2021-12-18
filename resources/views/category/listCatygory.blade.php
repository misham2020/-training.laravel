@if(isset($category))
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="my-3">Все категории</h3>
                <div class="list-group list-group-flush">
                    @foreach($category as $item)
                        <a class="list-group-item" href="{{'ads/'. $item->id }}">{{ $item->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
