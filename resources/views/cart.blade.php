@extends('layouts.app')
@section('content')
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        @if($hasItems)
        @dd($cart)
            @foreach($cart as $item)
                <div class="p-3 bg-white rounded shadow w-40 m-3">
                    <div class="grid grid-flow-row">
                        <img src="https://i.pinimg.com/564x/dc/3a/b3/dc3ab3154c223bcb18a5bdecd4f291bd.jpg" alt="">
                        <p class="font-bold text-xl">{{$item->name}}</p>
                        <div class="grid grid-flow-col">
                            <p class=" text-xs">${{$item->price}}</p>
                            <p class="text-xs text-yellow-500 text-right">10/10</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-3xl font-extrabold ">No items in cart</p>
        @endif
    </div>
@endsection
