@extends('layouts.app')

@section('content')
    {{ "Fajar Ketjeh" }}
    
    <form action="{{ route('handleLogout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection