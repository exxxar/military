@extends("layouts.app")

@section("content")

    @isset($_GET["uid"])
        <base-help-form-component :user-id="{{$_GET["uid"]}}"></base-help-form-component>
    @else
        <base-help-form-component></base-help-form-component>
    @endisset
@endsection
