@extends("layouts.app")

@section("content")


    @isset($_GET["uid"])
        <delivery-form-component :user-id="{{$_GET["uid"]}}"></delivery-form-component>
    @else
        <delivery-form-component></delivery-form-component>

    @endisset
@endsection
