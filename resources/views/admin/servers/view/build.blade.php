@extends('layouts.admin')

@section('title')
    サーバー — {{ $server->name }}: ビルド詳細
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>このサーバーの割り当てとシステムリソースを制御します。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.servers') }}">サーバー</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">ビルド構成</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <form action="{{ route('admin.servers.view.build', $server->id) }}" method="POST">
        <div class="col-sm-5">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">リソース管理</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="cpu" class="control-label">CPU制限</label>
                        <div class="input-group">
                            <input type="text" name="cpu" class="form-control" value="{{ old('cpu', $server->cpu) }}"/>
                            <span class="input-group-addon">%</span>
                        </div>
                        <p class="text-muted small">システム上の各<em>仮想</em>コア (スレッド) は <code>100%</code> と見なされます。この値を <code>0</code> に設定すると、サーバーは CPU 時間を無制限に使用できます。</p>
                    </div>
                    <div class="form-group">
                        <label for="threads" class="control-label">CPUピニング</label>
                        <div>
                            <input type="text" name="threads" class="form-control" value="{{ old('threads', $server->threads) }}"/>
                        </div>
                        <p class="text-muted small"><strong>高度な設定:</strong> このプロセスが実行できる特定の CPU コアを入力するか、すべてのコアを許可する場合は空白のままにします。これは単一の数値、またはカンマ区切りのリストにすることができます。例: <code>0</code>、<code>0-1,3</code>、または <code>0,1,3,4</code>。</p>
                    </div>
                    <div class="form-group">
                        <label for="memory" class="control-label">割り当てられたメモリ</label>
                        <div class="input-group">
                            <input type="text" name="memory" data-multiplicator="true" class="form-control" value="{{ old('memory', $server->memory) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">このコンテナに許可される最大メモリ量。これを <code>0</code> に設定すると、コンテナ内のメモリは無制限になります。</p>
                    </div>
                    <div class="form-group">
                        <label for="swap" class="control-label">割り当てられたスワップ</label>
                        <div class="input-group">
                            <input type="text" name="swap" data-multiplicator="true" class="form-control" value="{{ old('swap', $server->swap) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">これを <code>0</code> に設定すると、このサーバーのスワップ領域が無効になります。<code>-1</code> に設定すると、無制限のスワップが許可されます。</p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">ディスク容量制限</label>
                        <div class="input-group">
                            <input type="text" name="disk" class="form-control" value="{{ old('disk', $server->disk) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">このサーバーは、この容量を超えるスペースを使用している場合、起動を許可されません。実行中にこの制限を超えた場合、十分なスペースが利用可能になるまで安全に停止され、ロックされます。無制限のディスク使用量を許可するには、<code>0</code> に設定します。</p>
                    </div>
                    <div class="form-group">
                        <label for="io" class="control-label">ブロックIO比率</label>
                        <div>
                            <input type="text" name="io" class="form-control" value="{{ old('io', $server->io) }}"/>
                        </div>
                        <p class="text-muted small"><strong>高度な設定:</strong> システム上の他の<em>実行中の</em>コンテナに対するこのサーバーの IO パフォーマンス。値は <code>10</code> から <code>1000</code> の間でなければなりません。</p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">OOM Killer</label>
                        <div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pOomKillerEnabled" value="0" name="oom_disabled" @if(!$server->oom_disabled)checked @endif>
                                <label for="pOomKillerEnabled">有効</label>
                            </div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pOomKillerDisabled" value="1" name="oom_disabled" @if($server->oom_disabled)checked @endif>
                                <label for="pOomKillerDisabled">無効</label>
                            </div>
                            <p class="text-muted small">
                                OOM killer を有効にすると、サーバープロセスが予期せず終了する可能性があります。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">アプリケーション機能制限</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label for="database_limit" class="control-label">データベース制限</label>
                                    <div>
                                        <input type="text" name="database_limit" class="form-control" value="{{ old('database_limit', $server->database_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">ユーザーがこのサーバーに対して作成できるデータベースの総数。</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="allocation_limit" class="control-label">割り当て制限</label>
                                    <div>
                                        <input type="text" name="allocation_limit" class="form-control" value="{{ old('allocation_limit', $server->allocation_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">ユーザーがこのサーバーに対して作成できる割り当ての総数。</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="backup_limit" class="control-label">バックアップ制限</label>
                                    <div>
                                        <input type="text" name="backup_limit" class="form-control" value="{{ old('backup_limit', $server->backup_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">このサーバーに対して作成できるバックアップの総数。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">割り当て管理</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pAllocation" class="control-label">ゲームポート</label>
                                <select id="pAllocation" name="allocation_id" class="form-control">
                                    @foreach ($assigned as $assignment)
                                        <option value="{{ $assignment->id }}"
                                            @if($assignment->id === $server->allocation_id)
                                                selected="selected"
                                            @endif
                                        >{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                    @endforeach
                                </select>
                                <p class="text-muted small">このゲームサーバーに使用されるデフォルトの接続アドレス。</p>
                            </div>
                            <div class="form-group">
                                <label for="pAddAllocations" class="control-label">追加ポートの割り当て</label>
                                <div>
                                    <select name="add_allocations[]" class="form-control" multiple id="pAddAllocations">
                                        @foreach ($unassigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">ソフトウェアの制限により、異なる IP 上の同一ポートを同じサーバーに割り当てることはできません。</p>
                            </div>
                            <div class="form-group">
                                <label for="pRemoveAllocations" class="control-label">追加ポートの削除</label>
                                <div>
                                    <select name="remove_allocations[]" class="form-control" multiple id="pRemoveAllocations">
                                        @foreach ($assigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">上記のリストから削除したいポートを選択するだけです。既に使用中の異なる IP 上のポートを割り当てたい場合は、左側から選択してここで削除できます。</p>
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary pull-right">ビルド構成を更新</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pAddAllocations').select2();
    $('#pRemoveAllocations').select2();
    $('#pAllocation').select2();
    </script>
@endsection