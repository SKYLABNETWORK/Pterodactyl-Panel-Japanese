@extends('layouts.admin')

@section('title')
    {{ $node->name }}: 構成
@endsection

@section('content-header')
    <h1>{{ $node->name }}<small>デーモンの構成ファイル。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.nodes') }}">ノード</a></li>
        <li><a href="{{ route('admin.nodes.view', $node->id) }}">{{ $node->name }}</a></li>
        <li class="active">構成</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="{{ route('admin.nodes.view', $node->id) }}">概要</a></li>
                <li><a href="{{ route('admin.nodes.view.settings', $node->id) }}">設定</a></li>
                <li class="active"><a href="{{ route('admin.nodes.view.configuration', $node->id) }}">構成</a></li>
                <li><a href="{{ route('admin.nodes.view.allocation', $node->id) }}">割り当て</a></li>
                <li><a href="{{ route('admin.nodes.view.servers', $node->id) }}">サーバー</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">構成ファイル</h3>
            </div>
            <div class="box-body">
                <pre class="no-margin">{{ $node->getYamlConfiguration() }}</pre>
            </div>
            <div class="box-footer">
                <p class="no-margin">このファイルは、デーモンのルートディレクトリ (通常は <code>/etc/pterodactyl</code>) に <code>config.yml</code> という名前で配置する必要があります。</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">自動デプロイ</h3>
            </div>
            <div class="box-body">
                <p class="text-muted small">
                    以下のボタンを使用して、ターゲットサーバーに単一のコマンドで wings を構成するために使用できるカスタムデプロイメントコマンドを生成します。
                </p>
            </div>
            <div class="box-footer">
                <button type="button" id="configTokenBtn" class="btn btn-sm btn-default" style="width:100%;">トークンを生成</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#configTokenBtn').on('click', function (event) {
        $.ajax({
            method: 'POST',
            url: '{{ route('admin.nodes.view.configuration.token', $node->id) }}',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        }).done(function (data) {
            swal({
                type: 'success',
                title: 'トークンが作成されました。',
                text: '<p>ノードを自動構成するには、次のコマンドを実行してください:<br /><small><pre>cd /etc/pterodactyl && sudo wings configure --panel-url {{ config('app.url') }} --token ' + data.token + ' --node ' + data.node + '{{ config('app.debug') ? ' --allow-insecure' : '' }}</pre></small></p>',
                html: true
            })
        }).fail(function () {
            swal({
                title: 'エラー',
                text: 'トークンの作成中に問題が発生しました。',
                type: 'error'
            });
        });
    });
    </script>
@endsection