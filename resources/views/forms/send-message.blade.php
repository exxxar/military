@extends("layouts.app")

@section("content")


    @isset($_GET["id"])
        <send-message-form-component :user-id="{{$_GET["id"]}}"></send-message-form-component>
    @else
        <send-message-form-component></send-message-form-component>
    @endisset

@endsection
