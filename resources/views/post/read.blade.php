@extends('layouts.app')

@section('content')
<div class="container">
	<read-component :post="{{$post}}" :my_id="{{Auth::user()->id}}"></read-component>
</div>
@endsection
