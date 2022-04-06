@extends("layouts.app")

@section("content")


    @if(!is_null($id)&&isset($_GET["uid"]))
        <send-message-form-component :person-id="{{$id??null}}" data-type="{{$_GET["by"]??"haids"}}" :user-id="{{$_GET["uid"]??null}}"></send-message-form-component>

    @endif

    @if(isset($_GET["uid"]))
        <send-message-form-component :user-id="{{$_GET["uid"]??null}}"></send-message-form-component>
    @endif

    @if(!isset($_GET["uid"]))
        <send-message-form-component></send-message-form-component>
    @endif


@endsection
