@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h3>Following</h3>
            <following-component :user="{{auth::user()}}"></following-component>
        </div>
        <div class="col-md-5">
            <h3>Followers</h3>
            <followers-component></followers-component>
        </div>
    </div>
@endsection