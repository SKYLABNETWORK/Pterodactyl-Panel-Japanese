@extends('layouts.admin')

@section('title')
    データベースホスト
@endsection

@section('content-header')
    <h1>データベースホスト<small>サーバーがデータベースを作成できるデータベースホスト。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">データベースホスト</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ホストリスト</h3>
                <div class="box-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newHostModal">新規作成</button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>名前</th>
                            <th>ホスト</th>
                            <th>ポート</th>
                            <th>ユーザー名</th>
                            <th class="text-center">データベース</th>
                            <th class="text-center">ノード</th>
                        </tr>
                        @foreach ($hosts as $host)
                            <tr>
                                <td><code>{{ $host->id }}</code></td>
                                <td><a href="{{ route('admin.databases.view', $host->id) }}">{{ $host->name }}</a></td>
                                <td><code>{{ $host->host }}</code></td>
                                <td><code>{{ $host->port }}</code></td>
                                <td>{{ $host->username }}</td>
                                <td class="text-center">{{ $host->databases_count }}</td>
                                <td class="text-center">
                                    @if(! is_null($host->node))
                                        <a href="{{ route('admin.nodes.view', $host->node->id) }}">{{ $host->node->name }}</a>
                                    @else
                                        <span class="label label-default">なし</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newHostModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.databases') }}" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">新しいデータベースホストを作成</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">名前</label>
                        <input type="text" name="name" id="pName" class="form-control" />
                        <p class="text-muted small">他の場所と区別するための短い識別子。1〜60文字で指定してください（例：<code>us.nyc.lvl3</code>）。</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pHost" class="form-label">ホスト</label>
                            <input type="text" name="host" id="pHost" class="form-control" />
                            <p class="text-muted small">新しいデータベースを追加するために、<em>パネルから</em>このMySQLホストに接続する際に使用するIPアドレスまたはFQDN。</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPort" class="form-label">ポート</label>
                            <input type="text" name="port" id="pPort" class="form-control" value="3306"/>
                            <p class="text-muted small">このホストでMySQLが実行されているポート。</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pUsername" class="form-label">ユーザー名</label>
                            <input type="text" name="username" id="pUsername" class="form-control" />
                            <p class="text-muted small">システム上で新しいユーザーとデータベースを作成するのに十分な権限を持つアカウントのユーザー名。</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPassword" class="form-label">パスワード</label>
                            <input type="password" name="password" id="pPassword" class="form-control" />
                            <p class="text-muted small">定義されたアカウントのパスワード。</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pNodeId" class="form-label">リンクされたノード</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <option value="">なし</option>
                            @foreach($locations as $location)
                                <optgroup label="{{ $location->short }}">
                                    @foreach($location->nodes as $node)
                                        <option value="{{ $node->id }}">{{ $node->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <p class="text-muted small">この設定は、選択されたノードのサーバーにデータベースを追加する際に、このデータベースホストをデフォルトに設定する以外には影響しません。</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="text-danger small text-left">このデータベースホストに定義されたアカウントには、<code>WITH GRANT OPTION</code> 権限が<strong>必要</strong>です。定義されたアカウントにこの権限がない場合、データベースを作成するリクエストは<em>失敗</em>します。<strong>このパネルに定義したMySQLと同じアカウントの詳細を使用しないでください。</strong></p>
                    {!! csrf_field() !!}
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-success btn-sm">作成</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('#pNodeId').select2();
    </script>
@endsection
