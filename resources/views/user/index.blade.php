@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            {{ $user->name }}

            <follow-component 
                :user = "{{$user}}"
                :my_id = "{{auth::id()}}">
                </follow-component>
            <following-component :user="{{$user}}"></following-component>
        </div> 
        <div class="col-md-8">
            <list-component :user="{{$user}}"></list-component>
        </div>
    </div>
</div>
@endsection