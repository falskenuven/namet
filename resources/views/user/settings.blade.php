@extends('layouts.app')

@section('content')
<div class="container">
    <settings-component :user="{{Auth::user()}}"></settings-component>
</div>
@endsection