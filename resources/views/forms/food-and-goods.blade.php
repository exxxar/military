@extends("layouts.app")

@section("content")

     @isset($_GET["uid"])
         <food-and-goods-form-component :user-id="{{$_GET["uid"]}}"></food-and-goods-form-component>
     @else
         <food-and-goods-form-component></food-and-goods-form-component>
     @endisset

@endsection
