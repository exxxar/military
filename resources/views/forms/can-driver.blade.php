@extends("layouts.app")

@section("content")
    @isset($_GET["uid"])
        <driver-form-component :user-id="{{$_GET["uid"]}}"></driver-form-component>
    @else
        <driver-form-component></driver-form-component>
    @endisset
@endsection
