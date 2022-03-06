@extends("layouts.app")

@section("content")
    @isset($_GET["uid"])
        <aid-center-form-component :user-id="{{$_GET["uid"]}}"></aid-center-form-component>
    @else
        <aid-center-form-component></aid-center-form-component>
    @endisset
@endsection
