@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <search-in-base-form-component user-id="{{$_GET["uid"]??null}}"></search-in-base-form-component>
    @else
        <search-in-base-form-component></search-in-base-form-component>
    @endisset

@endsection
