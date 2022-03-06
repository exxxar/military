@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <shelter-form-component :user-id="{{$_GET["uid"]}}"></shelter-form-component>
    @else
        <shelter-form-component></shelter-form-component>
    @endisset

@endsection
