<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tasks = Task::all();
        $tasks = [];
        
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->get();
            
        }
        
        return view('welcome', [
            'tasks' => $tasks
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
        //  バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required',
        ]);
        
        //　タスクを作成
        $task = new Task;
        $task->user_id = \Auth::user()->id;
        $task->status = $request->status;
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
        
        //  認証済みユーザーがそのタスクの所有者である場合は、表示
        if (\Auth::id() === $task->user_id) {
            //  タスク詳細ビューで表示
            return view('tasks.show',[
                'task' => $task,
                ]);
        }
        //  トップページへのリダイレクトさせる
        return redirect('/');
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
        
        //  認証済みユーザーがそのタスクの所有者である場合は、表示
        if (\Auth::id() === $task->user_id) {
            //  編集ビューで表示
            return view('tasks.edit', [
                'task' => $task,
                ]);
        }
         //  トップページへのリダイレクトさせる
        return redirect('/');
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
        //  バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required',
        ]);
        
        //　idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //  認証済みユーザーがそのタスクの所有者である場合は、タスクを更新
        if (\Auth::id() === $task->user_id) {
            //  タスクを更新
            $task->status = $request->status;
            $task->content = $request->content;
            $task->save();
        }
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
        
        //  認証済みユーザーがそのタスクの所有者である場合は、タスクを削除
        if (\Auth::id() === $task->user_id) {
            //  メッセージを削除
            $task->delete();
        }
        
        //  トップページへリダイレクトさせる
        return redirect('/');
    }
}
