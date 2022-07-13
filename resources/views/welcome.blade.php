@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Tasklist</h1>
            {{--　ユーザー登録ページへのリンク　--}}
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' =>'btn btn-lg btn-success']) !!}
        </div>
    </div>
@endsection