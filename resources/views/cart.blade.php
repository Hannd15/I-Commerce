@extends('layouts.app')
@section('content')
    @if($hasItems)
    @php
        $total = 0
    @endphp
        <form action="{{ route('cart.update') }}" method="post">
            @csrf
            <input type="hidden" name="id_user" id="id_user" value="{{ Auth::user()->id }}">
            <div class='grid grid-flow-row space-y-3 mx-4'>
                @foreach($items as $item)
                @php $total += $item->price * $item->amount @endphp
                    <div class="p-3 bg-white rounded shadow h-28">
                        <div class="flex flex-wrap space-x-4">
                            <img src="https://i.pinimg.com/564x/dc/3a/b3/dc3ab3154c223bcb18a5bdecd4f291bd.jpg" alt="" class="h-20">
                            <div>
                                <p class="font-bold text-xl">{{$item->name}}</p>
                                <p class=" text-xs">$ {{$item->price}}</p>
                                <input type="number" name="{{$item->id}}" id="{{$item->id}}" value="{{$item->amount}}">
                            </div>
                        </div>
                    </div>
                @endforeach

                <div>
                    <p class="font-bold text-xl">Total</p>
                    <p class=" text-xs">$ {{$total}}</p>
                </div>
                <div class="flex justify-end">
            </div>
            <button type="submit">Save</button>
        </form>
    @else
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <p class="text-center text-3xl font-extrabold ">No items in cart</p>
        </div>
    @endif
@endsection
