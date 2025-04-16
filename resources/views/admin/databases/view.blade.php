@extends('layouts.admin')

@section('title')
    データベースホスト → 表示 → {{ $host->name }}
@endsection

@section('content-header')
    <h1>{{ $host->name }}<small>このデータベースホストに関連付けられたデータベースと詳細を表示しています。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.databases') }}">データベースホスト</a></li>
        <li class="active">{{ $host->name }}</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.databases.view', $host->id) }}" method="POST">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ホストの詳細</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">名前</label>
                        <input type="text" id="pName" name="name" class="form-control" value="{{ old('name', $host->name) }}" />
                    </div>
                    <div class="form-group">
                        <label for="pHost" class="form-label">ホスト</label>
                        <input type="text" id="pHost" name="host" class="form-control" value="{{ old('host', $host->host) }}" />
                        <p class="text-muted small">新しいデータベースを追加するために、<em>パネルから</em>このMySQLホストに接続する際に使用するIPアドレスまたはFQDN。</p>
                    </div>
                    <div class="form-group">
                        <label for="pPort" class="form-label">ポート</label>
                        <input type="text" id="pPort" name="port" class="form-control" value="{{ old('port', $host->port) }}" />
                        <p class="text-muted small">このホストでMySQLが実行されているポート。</p>
                    </div>
                    <div class="form-group">
                        <label for="pNodeId" class="form-label">リンクされたノード</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <option value="">なし</option>
                            @foreach($locations as $location)
                                <optgroup label="{{ $location->short }}">
                                    @foreach($location->nodes as $node)
                                        <option value="{{ $node->id }}" {{ $host->node_id !== $node->id ?: 'selected' }}>{{ $node->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <p class="text-muted small">この設定は、選択されたノードのサーバーにデータベースを追加する際に、このデータベースホストをデフォルトに設定する以外には影響しません。</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ユーザーの詳細</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pUsername" class="form-label">ユーザー名</label>
                        <input type="text" name="username" id="pUsername" class="form-control" value="{{ old('username', $host->username) }}" />
                        <p class="text-muted small">システム上で新しいユーザーとデータベースを作成するのに十分な権限を持つアカウントのユーザー名。</p>
                    </div>
                    <div class="form-group">
                        <label for="pPassword" class="form-label">パスワード</label>
                        <input type="password" name="password" id="pPassword" class="form-control" />
                        <p class="text-muted small">定義されたアカウントのパスワード。割り当てられたパスワードを引き続き使用する場合は、空白のままにしてください。</p>
                    </div>
                    <hr />
                    <p class="text-danger small text-left">このデータベースホストに定義されたアカウントには、<code>WITH GRANT OPTION</code> 権限が<strong>必要</strong>です。定義されたアカウントにこの権限がない場合、データベースを作成するリクエストは<em>失敗</em>します。<strong>このパネルに定義したMySQLと同じアカウントの詳細を使用しないでください。</strong></p>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">保存</button>
                    <button name="_method" value="DELETE" class="btn btn-sm btn-danger pull-left muted muted-hover"><i class="fa fa-trash-o"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">データベース</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>サーバー</th>
                        <th>データベース名</th>
                        <th>ユーザー名</th>
                        <th>接続元</th>
                        <th>最大接続数</th>
                        <th></th>
                    </tr>
                    @foreach($databases as $database)
                        <tr>
                            <td class="middle"><a href="{{ route('admin.servers.view', $database->getRelation('server')->id) }}">{{ $database->getRelation('server')->name }}</a></td>
                            <td class="middle">{{ $database->database }}</td>
                            <td class="middle">{{ $database->username }}</td>
                            <td class="middle">{{ $database->remote }}</td>
                            @if($database->max_connections != null)
                                <td class="middle">{{ $database->max_connections }}</td>
                            @else
                                <td class="middle">無制限</td>
                            @endif
                            <td class="text-center">
                                <a href="{{ route('admin.servers.view.database', $database->getRelation('server')->id) }}">
                                    <button class="btn btn-xs btn-primary">管理</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if($databases->hasPages())
                <div class="box-footer with-border">
                    <div class="col-md-12 text-center">{!! $databases->render() !!}</div>
                </div>
            @endif
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
