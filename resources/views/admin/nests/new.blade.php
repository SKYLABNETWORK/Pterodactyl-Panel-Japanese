@extends('layouts.admin')

@section('title')
    新規ネスト
@endsection

@section('content-header')
    <h1>新規ネスト<small>すべてのノードにデプロイするための新しいネストを構成します。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.nests') }}">ネスト</a></li>
        <li class="active">新規</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.nests.new') }}" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">新規ネスト</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label">名前</label>
                        <div>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                            <p class="text-muted"><small>これは、ネスト内のすべてのエッグを包含する説明的なカテゴリ名である必要があります。</small></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">説明</label>
                        <div>
                            <textarea name="description" class="form-control" rows="6">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary pull-right">保存</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection