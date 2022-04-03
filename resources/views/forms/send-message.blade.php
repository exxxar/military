@extends("layouts.app")

@section("content")


    @if(!is_null($id))
        <send-message-form-component :user-id="{{$id}}" data-type="{{$_GET["by"]??"haids"}}"></send-message-form-component>
    @else
        <send-message-form-component></send-message-form-component>
    @endif

@endsection
