@extends('layouts.admin')

@section('title')
    サーバー — {{ $server->name }}: データベース
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>サーバーデータベースを管理します。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.servers') }}">サーバー</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">データベース</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <div class="col-sm-7">
        <div class="alert alert-info">
            データベースのパスワードは、フロントエンドで<a href="/server/{{ $server->uuidShort }}/databases">このサーバーにアクセス</a>すると確認できます。
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">アクティブなデータベース</h3>
            </div>
            <div class="box-body table-responsible no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>データベース</th>
                        <th>ユーザー名</th>
                        <th>接続元</th>
                        <th>ホスト</th>
                        <th>最大接続数</th>
                        <th></th>
                    </tr>
                    @foreach($server->databases as $database)
                        <tr>
                            <td>{{ $database->database }}</td>
                            <td>{{ $database->username }}</td>
                            <td>{{ $database->remote }}</td>
                            <td><code>{{ $database->host->host }}:{{ $database->host->port }}</code></td>
                            @if($database->max_connections != null)
                                <td>{{ $database->max_connections }}</td>
                            @else
                                <td>無制限</td>
                            @endif
                            <td class="text-center">
                                <button data-action="reset-password" data-id="{{ $database->id }}" class="btn btn-xs btn-primary"><i class="fa fa-refresh"></i></button>
                                <button data-action="remove" data-id="{{ $database->id }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">新しいデータベースを作成</h3>
            </div>
            <form action="{{ route('admin.servers.view.database', $server->id) }}" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="pDatabaseHostId" class="control-label">データベースホスト</label>
                        <select id="pDatabaseHostId" name="database_host_id" class="form-control">
                            @foreach($hosts as $host)
                                <option value="{{ $host->id }}">{{ $host->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-muted small">このデータベースを作成するホストデータベースサーバーを選択してください。</p>
                    </div>
                    <div class="form-group">
                        <label for="pDatabaseName" class="control-label">データベース</label>
                        <div class="input-group">
                            <span class="input-group-addon">s{{ $server->id }}_</span>
                            <input id="pDatabaseName" type="text" name="database" class="form-control" placeholder="データベース" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pRemote" class="control-label">接続</label>
                        <input id="pRemote" type="text" name="remote" class="form-control" value="%" />
                        <p class="text-muted small">接続を許可するIPアドレスを指定してください。標準のMySQL表記を使用します。不明な場合は <code>%</code> のままにしてください。</p>
                    </div>
                    <div class="form-group">
                        <label for="pmax_connections" class="control-label">同時接続数</label>
                        <input id="pmax_connections" type="text" name="max_connections" class="form-control"/>
                        <p class="text-muted small">このユーザーからデータベースへの同時接続の最大数を指定してください。無制限にする場合は空欄のままにしてください。</p>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <p class="text-muted small no-margin">フォーム送信後、このデータベース用のユーザー名とパスワードがランダムに生成されます。</p>
                    <input type="submit" class="btn btn-sm btn-success pull-right" value="データベースを作成" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pDatabaseHost').select2();
    $('[data-action="remove"]').click(function (event) {
        event.preventDefault();
        var self = $(this);
        swal({
            title: '',
            type: 'warning',
            text: 'このデータベースを削除してもよろしいですか？元に戻すことはできず、すべてのデータが直ちに削除されます。',
            showCancelButton: true,
            confirmButtonText: '削除',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                method: 'DELETE',
                url: '/admin/servers/view/{{ $server->id }}/database/' + self.data('id') + '/delete',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            }).done(function () {
                self.parent().parent().slideUp();
                swal.close();
            }).fail(function (jqXHR) {
                console.error(jqXHR);
                swal({
                    type: 'error',
                    title: 'エラー',
                    text: (typeof jqXHR.responseJSON.error !== 'undefined') ? jqXHR.responseJSON.error : 'このリクエストの処理中にエラーが発生しました。'
                });
            });
        });
    });
    $('[data-action="reset-password"]').click(function (e) {
        e.preventDefault();
        var block = $(this);
        $(this).addClass('disabled').find('i').addClass('fa-spin');
        $.ajax({
            type: 'PATCH',
            url: '/admin/servers/view/{{ $server->id }}/database',
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            data: { database: $(this).data('id') },
        }).done(function (data) {
            swal({
                type: 'success',
                title: '',
                text: 'このデータベースのパスワードをリセットしました。',
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error(jqXHR);
            var error = 'このリクエストを処理しようとしている間にエラーが発生しました。';
            if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                error = jqXHR.responseJSON.error;
            }
            swal({
                type: 'error',
                title: 'エラー',
                text: error
            });
        }).always(function () {
            block.removeClass('disabled').find('i').removeClass('fa-spin');
        });
    });
    </script>
@endsection
