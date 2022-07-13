@if (count($tasks) > 0)
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">status</th>
                <th scope="col">task</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task) 
                <tr>
                    {{--  メッセージ詳細ページのリンク  --}}
                    <th scope="row">{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</th>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->content }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endif
