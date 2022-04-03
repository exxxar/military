@extends("layouts.app")

@section("content")


    @if(!is_null($id))
        <send-message-form-component :person-id="{{$id}}" data-type="{{$_GET["by"]??"haids"}}" :user-id="{{$_GET["uid"]??null}}"></send-message-form-component>

    @else
        <send-message-form-component :user-id="{{$_GET["uid"]??null}}"></send-message-form-component>
    @endif

@endsection
