@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <assistance-form-component :user-id="{{$_GET["uid"]}}"></assistance-form-component>
    @else
        <assistance-form-component></assistance-form-component>

    @endisset
@endsection
