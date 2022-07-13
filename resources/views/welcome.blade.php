@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <h1>タスク一覧</h1>
        @include('tasks.index')
        {{--  タスク作成ページへのリンク  --}}
        {!! link_to_route('tasks.create', '新規タスク作成', [], ['class' => 'btn btn-success']) !!}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Tasklist</h1>
                {{--　ユーザー登録ページへのリンク　--}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' =>'btn btn-lg btn-success']) !!}
            </div>
        </div>
    @endif
   
@endsection