@section('header')
    <a href="{{ route('index') }}">Главная</a><br>
    @if (Auth::check())
        <a href="{{ route('index.publication') }}">Мои объявления</a><br>
    @endif
    @if (!Auth::check())
        <a href="{{ route('home') }}">Войти</a>
    @endif

@endsection
