@extends('layouts.app')

@section('content')
    <h1>タスク一覧</h1>
    
    @if(count($tasks) > 0)
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">task</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task) 
                    <tr>
                        {{--  メッセージ詳細ページのリンク  --}}
                        <th scope="row">{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</th>
                        <td>{{ $task->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {{--  タスク作成ページへのリンク  --}}
    {!! link_to_route('tasks.create', '新規タスク作成', [], ['class' => 'btn btn-success']) !!}
    
@endsection