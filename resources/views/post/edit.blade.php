@extends('layouts.app')

@section('content')
<div class="container">
	<form-edit-component :post="{{$post}}"></form-edit-component>
</div>
@endsection
