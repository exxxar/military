@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <water-help-form-component :user-id="{{$_GET["uid"]}}"></water-help-form-component>
    @else
        <water-help-form-component></water-help-form-component>
    @endisset
@endsection
