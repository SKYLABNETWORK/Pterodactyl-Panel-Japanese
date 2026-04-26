@extends('layouts.admin')

@section('title')
    サーバー — {{ $server->name }}: ビルド詳細
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>このサーバーの割り当てとシステムリソースを管理します。</small></h1>
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
                        <p class="text-muted small">システム上の各<em>仮想</em>コア（スレッド）は <code>100%</code> とみなされます。この値を <code>0</code> に設定すると、サーバーはCPU時間を制限なく使用できます。</p>
                    </div>
                    <div class="form-group">
                        <label for="threads" class="control-label">CPU固定</label>
                        <div>
                            <input type="text" name="threads" class="form-control" value="{{ old('threads', $server->threads) }}"/>
                        </div>
                        <p class="text-muted small"><strong>高度:</strong> このプロセスが実行できる特定のCPUコアを入力するか、すべてのコアを許可する場合は空欄のままにしてください。単一の数値、またはカンマ区切りの一覧を指定できます。例: <code>0</code>、<code>0-1,3</code>、<code>0,1,3,4</code>。</p>
                    </div>
                    <div class="form-group">
                        <label for="memory" class="control-label">割り当てメモリ</label>
                        <div class="input-group">
                            <input type="text" name="memory" data-multiplicator="true" class="form-control" value="{{ old('memory', $server->memory) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">このコンテナに許可される最大メモリ量です。<code>0</code> に設定すると、コンテナのメモリは無制限になります。</p>
                    </div>
                    <div class="form-group">
                        <label for="swap" class="control-label">割り当てスワップ</label>
                        <div class="input-group">
                            <input type="text" name="swap" data-multiplicator="true" class="form-control" value="{{ old('swap', $server->swap) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small"><code>0</code> に設定すると、このサーバーのスワップ領域が無効になります。<code>-1</code> に設定するとスワップが無制限になります。</p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">ディスク容量制限</label>
                        <div class="input-group">
                            <input type="text" name="disk" class="form-control" value="{{ old('disk', $server->disk) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">この容量を超えて使用している場合、このサーバーの起動は許可されません。実行中にこの制限を超えた場合、十分な空き容量が確保されるまで安全に停止され、ロックされます。ディスク使用量を無制限にするには <code>0</code> を設定してください。</p>
                    </div>
                    <div class="form-group">
                        <label for="io" class="control-label">ブロックIO比率</label>
                        <div>
                            <input type="text" name="io" class="form-control" value="{{ old('io', $server->io) }}"/>
                        </div>
                        <p class="text-muted small"><strong>高度</strong>: システム上の他の<em>実行中</em>コンテナと比較した、このサーバーのIO性能です。値は <code>10</code> から <code>1000</code> の間にしてください。</code></p>
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
                                OOM Killerを有効にすると、サーバープロセスが予期せず終了する可能性があります。
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
                                    <p class="text-muted small">ユーザーがこのサーバー用に作成できるデータベースの合計数です。</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="allocation_limit" class="control-label">割り当て制限</label>
                                    <div>
                                        <input type="text" name="allocation_limit" class="form-control" value="{{ old('allocation_limit', $server->allocation_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">ユーザーがこのサーバー用に作成できる割り当ての合計数です。</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="backup_limit" class="control-label">バックアップ制限</label>
                                    <div>
                                        <input type="text" name="backup_limit" class="form-control" value="{{ old('backup_limit', $server->backup_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">このサーバー用に作成できるバックアップの合計数です。</p>
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
                                <p class="text-muted small">このゲームサーバーで使用されるデフォルト接続アドレスです。</p>
                            </div>
                            <div class="form-group">
                                <label for="pAddAllocations" class="control-label">追加ポートを割り当て</label>
                                <div>
                                    <select name="add_allocations[]" class="form-control" multiple id="pAddAllocations">
                                        @foreach ($unassigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">ソフトウェアの制限により、異なるIP上の同一ポートを同じサーバーに割り当てることはできません。</p>
                            </div>
                            <div class="form-group">
                                <label for="pRemoveAllocations" class="control-label">追加ポートを削除</label>
                                <div>
                                    <select name="remove_allocations[]" class="form-control" multiple id="pRemoveAllocations">
                                        @foreach ($assigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">上の一覧から削除したいポートを選択してください。既に使用中の別IP上のポートを割り当てたい場合は、左側から選択してここで削除できます。</p>
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
