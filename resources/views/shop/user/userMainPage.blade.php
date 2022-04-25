@extends('layouts.userMainTemplate')
@section('offers')

    <div style="display:grid;" class="main">
        <a href="{{ route('televisions') }}">
            <img class="image-offers" src="{{ asset('storage/images/TvCategoryImage.png') }}" alt="Tv's"></img>
        </a>
    </div>
@stop
@extends('layouts.userHeaderTemplate')

