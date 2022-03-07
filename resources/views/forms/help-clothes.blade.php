@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <clothes-form-component :user-id="{{$_GET["uid"]}}"></clothes-form-component>
    @else
        <clothes-form-component></clothes-form-component>
    @endisset
@endsection
