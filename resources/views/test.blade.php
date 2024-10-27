@extends('layouts.app')
@section('content')
    <div class="flex flex-wrap justify-center">
        @for($i = 0; $i < 20; $i++)
            @component('components.item_card')
            @endcomponent('components.item_card')
        @endfor

    </div>
@endsection
