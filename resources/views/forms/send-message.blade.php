@extends("layouts.app")

@section("content")


    @if(!is_null($id))
        <send-message-form-component :user-id="{{$id}}" :type="{{$_GET["by"]}}"></send-message-form-component>
    @else
        <send-message-form-component></send-message-form-component>
    @endif

@endsection
