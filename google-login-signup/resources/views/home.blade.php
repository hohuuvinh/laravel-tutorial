@extends('layout.master')

@section('Content')
<p>Email: {{Auth::user()->email}}</p>
<p>Email: {{Auth::user()->name}}</p>
<p>Image: {{Auth::user()->avatar}}</p>
<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <input type="submit" name="" value="logout">

</form>
@endsection