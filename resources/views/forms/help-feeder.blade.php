@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <feeder-form-component :user-id="{{$_GET["uid"]}}"></feeder-form-component>
    @else
        <feeder-form-component></feeder-form-component>
    @endisset
@endsection
