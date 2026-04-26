@extends('layouts.admin')

@section('title')
    ネスト &rarr; エッグ: {{ $egg->name }}
@endsection

@section('content-header')
    <h1>{{ $egg->name }}<small>{{ str_limit($egg->description, 50) }}</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.nests') }}">ネスト</a></li>
        <li><a href="{{ route('admin.nests.view', $egg->nest->id) }}">{{ $egg->nest->name }}</a></li>
        <li class="active">{{ $egg->name }}</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ route('admin.nests.egg.view', $egg->id) }}">構成</a></li>
                <li><a href="{{ route('admin.nests.egg.variables', $egg->id) }}">変数</a></li>
                <li><a href="{{ route('admin.nests.egg.scripts', $egg->id) }}">インストールスクリプト</a></li>
            </ul>
        </div>
    </div>
</div>
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" enctype="multipart/form-data" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-group no-margin-bottom">
                                <label for="pName" class="control-label">エッグファイル</label>
                                <div>
                                    <input type="file" name="import_file" class="form-control" style="border: 0;margin-left:-10px;" />
                                    <p class="text-muted small no-margin-bottom">新しいJSONファイルをアップロードしてこのエッグの設定を置き換える場合は、ここで選択して「エッグを更新」を押してください。既存サーバーの既存の起動文字列やDockerイメージは変更されません。</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            {!! csrf_field() !!}
                            <button type="submit" name="_method" value="PUT" class="btn btn-sm btn-danger pull-right">エッグを更新</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">構成</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pName" class="control-label">名前 <span class="field-required"></span></label>
                                <input type="text" id="pName" name="name" value="{{ $egg->name }}" class="form-control" />
                                <p class="text-muted small">このエッグの識別子として使用する、人が読みやすいシンプルな名前です。</p>
                            </div>
                            <div class="form-group">
                                <label for="pUuid" class="control-label">UUID</label>
                                <input type="text" id="pUuid" readonly value="{{ $egg->uuid }}" class="form-control" />
                                <p class="text-muted small">これは、このエッグを識別するためにデーモンが使用するグローバルに一意な識別子です。</p>
                            </div>
                            <div class="form-group">
                                <label for="pAuthor" class="control-label">作成者</label>
                                <input type="text" id="pAuthor" readonly value="{{ $egg->author }}" class="form-control" />
                                <p class="text-muted small">このバージョンのエッグの作成者です。別の作成者による新しいエッグ構成をアップロードすると変更されます。</p>
                            </div>
                            <div class="form-group">
                                <label for="pDockerImage" class="control-label">Dockerイメージ <span class="field-required"></span></label>
                                <textarea id="pDockerImages" name="docker_images" class="form-control" rows="4">{{ implode(PHP_EOL, $images) }}</textarea>
                                <p class="text-muted small">
                                    このエッグを使用するサーバーで利用できるDockerイメージです。1行に1つずつ入力してください。
                                    複数の値を指定すると、ユーザーはこのイメージ一覧から選択できます。
                                    任意で、イメージの前に表示名、パイプ文字、イメージURLの順に指定して表示名を設定できます。例: <code>表示名|ghcr.io/my/egg</code>
                                </p>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-primary no-margin-bottom">
                                    <input id="pForceOutgoingIp" name="force_outgoing_ip" type="checkbox" value="1" @if($egg->force_outgoing_ip) checked @endif />
                                    <label for="pForceOutgoingIp" class="strong">送信元IPを強制</label>
                                    <p class="text-muted small">
                                        すべての送信ネットワークトラフィックの送信元IPを、サーバーのプライマリ割り当てIPにNATします。
                                        ノードに複数の公開IPアドレスがある場合、一部のゲームを正常に動作させるために必要です。
                                        <br>
                                        <strong>
                                            このオプションを有効にすると、このエッグを使用するすべてのサーバーで内部ネットワークが無効になり、
                                            同じノード上の他のサーバーへ内部的にアクセスできなくなります。
                                        </strong>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pDescription" class="control-label">説明</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="8">{{ $egg->description }}</textarea>
                                <p class="text-muted small">必要に応じてパネル全体で表示される、このエッグの説明です。</p>
                            </div>
                            <div class="form-group">
                                <label for="pStartup" class="control-label">起動コマンド <span class="field-required"></span></label>
                                <textarea id="pStartup" name="startup" class="form-control" rows="8">{{ $egg->startup }}</textarea>
                                <p class="text-muted small">このエッグを使用する新しいサーバーに使用するデフォルトの起動コマンドです。</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigFeatures" class="control-label">機能</label>
                                <div>
                                    <select class="form-control" name="features[]" id="pConfigFeatures" multiple>
                                        @foreach(($egg->features ?? []) as $feature)
                                            <option value="{{ $feature }}" selected>{{ $feature }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted small">エッグに属する追加機能です。追加のパネル変更を構成する場合に便利です。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">プロセス管理</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="alert alert-warning">
                                <p>このシステムの仕組みを理解していない限り、以下の構成オプションは編集しないでください。誤って変更すると、デーモンが動作しなくなる可能性があります。</p>
                                <p>「設定のコピー元」ドロップダウンから別のオプションを選択しない限り、すべてのフィールドは必須です。その場合、空欄のフィールドにはそのエッグの値が使用されます。</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFrom" class="form-label">設定のコピー元</label>
                                <select name="config_from" id="pConfigFrom" class="form-control">
                                    <option value="">なし</option>
                                    @foreach($egg->nest->eggs as $o)
                                        <option value="{{ $o->id }}" {{ ($egg->config_from !== $o->id) ?: 'selected' }}>{{ $o->name }} &lt;{{ $o->author }}&gt;</option>
                                    @endforeach
                                </select>
                                <p class="text-muted small">別のエッグの設定をデフォルトとして使用する場合は、上のメニューから選択してください。</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStop" class="form-label">停止コマンド</label>
                                <input type="text" id="pConfigStop" name="config_stop" class="form-control" value="{{ $egg->config_stop }}" />
                                <p class="text-muted small">サーバープロセスを正常に停止するために送信するコマンドです。<code>SIGINT</code> を送信する必要がある場合は、ここに <code>^C</code> と入力してください。</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigLogs" class="form-label">ログ構成</label>
                                <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" class="form-control" rows="6">{{ ! is_null($egg->config_logs) ? json_encode(json_decode($egg->config_logs), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">ログファイルの保存場所、およびデーモンがカスタムログを作成するかどうかを表すJSONを指定してください。</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFiles" class="form-label">構成ファイル</label>
                                <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" class="form-control" rows="6">{{ ! is_null($egg->config_files) ? json_encode(json_decode($egg->config_files), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">変更する構成ファイルと、変更する箇所を表すJSONを指定してください。</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStartup" class="form-label">起動構成</label>
                                <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" class="form-control" rows="6">{{ ! is_null($egg->config_startup) ? json_encode(json_decode($egg->config_startup), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">サーバー起動時に完了判定のためにデーモンが探す値を表すJSONを指定してください。</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" name="_method" value="PATCH" class="btn btn-primary btn-sm pull-right">保存</button>
                    <a href="{{ route('admin.nests.egg.export', $egg->id) }}" class="btn btn-sm btn-info pull-right" style="margin-right:10px;">エクスポート</a>
                    <button id="deleteButton" type="submit" name="_method" value="DELETE" class="btn btn-danger btn-sm muted muted-hover">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pConfigFrom').select2();
    $('#deleteButton').on('mouseenter', function (event) {
        $(this).find('i').html(' エッグを削除');
    }).on('mouseleave', function (event) {
        $(this).find('i').html('');
    });
    $('textarea[data-action="handle-tabs"]').on('keydown', function(event) {
        if (event.keyCode === 9) {
            event.preventDefault();

            var curPos = $(this)[0].selectionStart;
            var prepend = $(this).val().substr(0, curPos);
            var append = $(this).val().substr(curPos);

            $(this).val(prepend + '    ' + append);
        }
    });
    $('#pConfigFeatures').select2({
        tags: true,
        selectOnClose: false,
        tokenSeparators: [',', ' '],
    });
    </script>
@endsection
