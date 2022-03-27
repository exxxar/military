@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <search-people-form-component :user-id="{{$_GET["uid"]}}"></search-people-form-component>
    @else
        <search-people-form-component></search-people-form-component>
    @endisset

@endsection
