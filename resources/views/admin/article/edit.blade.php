@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">编辑文章</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>编辑失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        {{--这里传入的变量应该是 articles,作者code中有错误--}}
                        <form action="{{ url('admin/articles/'.$articles->id) }}" method="POST">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <input type="text" name="title" class="form-control" required="required" placeholder="请输入标题" value="{{ $articles->title }}">
                            <input type="hidden" name="id"  class="form-control" required="required" placeholder="请输入标题" value="{{ $articles->id }}">
                            <br>
                            <textarea name="body" rows="10" class="form-control" required="required" placeholder="请输入内容">{{ $articles->body }}</textarea>
                            <br>
                            <button class="btn btn-lg btn-info">提交修改</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection