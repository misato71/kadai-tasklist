<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //　一覧表示
        $tasks =  Task::All();
        
        //メッセージ一覧を表示
        return view('tasks.index', [
            'tasks' => $tasks,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  新規登録画面表示処理
    public function create()
    {
        $task = new Task;
        
        //  タスク作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //  新規登録処理
    public function store(Request $request)
    {
        //　タスクを作成
        $task = new Task;
        $task->content = $request->content;
        $task->save();
        
        //  トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //  取得表示処理
    public function show($id)
    {
        //　idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //  タスク詳細ビューで表示
        return view('tasks.show',[
            'task' => $task,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //　更新画面表示処理
    public function edit($id)
    {
        //　idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //  編集ビューで表示
        return view('tasks.edit', [
            'task' => $task,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //　更新処理
    public function update(Request $request, $id)
    {
        //　idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //  タスクを更新
        $task->content = $request->content;
        $task->save();
        
        //  トップページへのリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //削除処理
    public function destroy($id)
    {
        //　idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //  メッセージを削除
        $task->delete();
        
        //  トップページへリダイレクトさせる
        return redirect('/');
    }
}
