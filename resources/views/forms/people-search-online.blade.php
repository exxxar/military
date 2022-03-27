@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <search-people-online-form-component
            :user-id="{{$_GET["uid"]}}"
            :type="{{$_GET["t"]}}">

        </search-people-online-form-component>
    @else
        <search-people-online-form-component></search-people-online-form-component>
    @endisset

@endsection
