@extends('layouts.app')

@section('content')
    Se hicieron los momos en video
    <form action="{{ route('logout') }}" method="get">
        <button type="submit">Logout</button>
    </form>
@endsection
