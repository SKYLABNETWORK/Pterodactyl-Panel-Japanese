@extends('layouts.admin')

@section('title')
    データベースホスト
@endsection

@section('content-header')
    <h1>データベースホスト<small>サーバー用データベースを作成できるデータベースホストです。</small></h1>
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
                <h3 class="box-title">ホスト一覧</h3>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">新しいデータベースホストを作成</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">名前</label>
                        <input type="text" name="name" id="pName" class="form-control" />
                        <p class="text-muted small">このロケーションを他と区別するための短い識別子です。1文字以上60文字以下である必要があります。例: <code>us.nyc.lvl3</code></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pHost" class="form-label">ホスト</label>
                            <input type="text" name="host" id="pHost" class="form-control" />
                            <p class="text-muted small">新しいデータベースを追加するために、<em>パネルから</em>このMySQLホストへ接続するときに使用するIPアドレスまたはFQDNです。</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPort" class="form-label">ポート</label>
                            <input type="text" name="port" id="pPort" class="form-control" value="3306"/>
                            <p class="text-muted small">このホストでMySQLが動作しているポートです。</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pUsername" class="form-label">ユーザー名</label>
                            <input type="text" name="username" id="pUsername" class="form-control" />
                            <p class="text-muted small">システム上に新しいユーザーとデータベースを作成する十分な権限を持つアカウントのユーザー名です。</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPassword" class="form-label">パスワード</label>
                            <input type="password" name="password" id="pPassword" class="form-control" />
                            <p class="text-muted small">指定したアカウントのパスワードです。</p>
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
                        <p class="text-muted small">この設定は、選択したノード上のサーバーにデータベースを追加するとき、このデータベースホストをデフォルトにする以外の動作はしません。</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="text-danger small text-left">このデータベースホストに指定するアカウントには、<strong>必ず</strong> <code>WITH GRANT OPTION</code> 権限が必要です。指定したアカウントにこの権限がない場合、データベース作成要求は<em>失敗します</em>。<strong>このパネルに設定しているMySQLのアカウント情報と同じものは使用しないでください。</strong></p>
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
