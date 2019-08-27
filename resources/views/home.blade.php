@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <friend-component></friend-component>
        </div>
        <div class="col-md-8">
        	<rand-post-component></rand-post-component>
            <fo-list-component></fo-list-component>
        </div>
    </div>
</div>
@endsection
