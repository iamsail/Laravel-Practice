<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

use \App\Article;

class ArticleController extends Controller
{
    public function index(){
        return view('admin/article/index')->with('articles',\App\Article::all());
    }

    public function create(){
        return view('admin/article/create');
    }

    public function edit($id){
        return view('admin/article/edit')->with('articles',Article::find($id));
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
        ]);

        $article = new Article;
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->user_id = $request->user()->id;

        if ($article->save()){
            return redirect('admin/articles');
        } else {
            return redirect()->back()->withInput()->withErrors("保存失败!");
        }
    }

    public function update(Request $request){
        $this->validate($request,[
            'title' => 'required|unique:articles,title,|max:255',
            'body' => 'required',
        ]);
        $id = $request->get('id');
//        echo $id;
//        var_dump($id);
        $article = Article::find($id);
        $article->title = $request->get('title');
        $article->body  = $request->get('body');
        if ($article->save()) {
            return redirect('admin/articles');
        } else {
            return redirect()->back()->withInput()->withErrors("更新失败");
        }
    }

    public function destroy($id){
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors("删除成功!");
    }
}
