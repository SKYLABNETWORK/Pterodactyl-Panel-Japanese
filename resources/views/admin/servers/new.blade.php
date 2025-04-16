@extends('layouts.admin')

@section('title')
    新規サーバー
@endsection

@section('content-header')
    <h1>サーバー作成<small>パネルに新しいサーバーを追加します。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.servers') }}">サーバー</a></li>
        <li class="active">サーバー作成</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.servers.new') }}" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">基本情報</h3>
                </div>

                <div class="box-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pName">サーバー名</label>
                            <input type="text" class="form-control" id="pName" name="name" value="{{ old('name') }}" placeholder="サーバー名">
                            <p class="small text-muted no-margin">文字制限: <code>a-z A-Z 0-9 _ - .</code> および <code>[Space]</code>。</p>
                        </div>

                        <div class="form-group">
                            <label for="pUserId">サーバーオーナー</label>
                            <select id="pUserId" name="owner_id" class="form-control" style="padding-left:0;"></select>
                            <p class="small text-muted no-margin">サーバーオーナーのメールアドレス。</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pDescription" class="control-label">サーバーの説明</label>
                            <textarea id="pDescription" name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                            <p class="text-muted small">このサーバーの簡単な説明。</p>
                        </div>

                        <div class="form-group">
                            <div class="checkbox checkbox-primary no-margin-bottom">
                                <input id="pStartOnCreation" name="start_on_completion" type="checkbox" {{ \Pterodactyl\Helpers\Utilities::checked('start_on_completion', 1) }} />
                                <label for="pStartOnCreation" class="strong">インストール完了時にサーバーを起動</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="overlay" id="allocationLoader" style="display:none;"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-header with-border">
                    <h3 class="box-title">割り当て管理</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-sm-4">
                        <label for="pNodeId">ノード</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            @foreach($locations as $location)
                                <optgroup label="{{ $location->long }} ({{ $location->short }})">
                                @foreach($location->nodes as $node)

                                    <option value="{{ $node->id }}"
                                        @if($location->id === old('location_id')) selected @endif
                                    >{{ $node->name }}</option>

                                @endforeach
                                </optgroup>
                            @endforeach
                        </select>

                        <p class="small text-muted no-margin">このサーバーがデプロイされるノード。</p>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="pAllocation">デフォルト割り当て</label>
                        <select id="pAllocation" name="allocation_id" class="form-control"></select>
                        <p class="small text-muted no-margin">このサーバーに割り当てられるメインの割り当て。</p>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="pAllocationAdditional">追加の割り当て</label>
                        <select id="pAllocationAdditional" name="allocation_additional[]" class="form-control" multiple></select>
                        <p class="small text-muted no-margin">作成時にこのサーバーに割り当てる追加の割り当て。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="overlay" id="allocationLoader" style="display:none;"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-header with-border">
                    <h3 class="box-title">アプリケーション機能制限</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="pDatabaseLimit" class="control-label">データベース制限</label>
                        <div>
                            <input type="text" id="pDatabaseLimit" name="database_limit" class="form-control" value="{{ old('database_limit', 0) }}"/>
                        </div>
                        <p class="text-muted small">ユーザーがこのサーバーに対して作成できるデータベースの総数。</p>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="pAllocationLimit" class="control-label">割り当て制限</label>
                        <div>
                            <input type="text" id="pAllocationLimit" name="allocation_limit" class="form-control" value="{{ old('allocation_limit', 0) }}"/>
                        </div>
                        <p class="text-muted small">ユーザーがこのサーバーに対して作成できる割り当ての総数。</p>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="pBackupLimit" class="control-label">バックアップ制限</label>
                        <div>
                            <input type="text" id="pBackupLimit" name="backup_limit" class="form-control" value="{{ old('backup_limit', 0) }}"/>
                        </div>
                        <p class="text-muted small">このサーバーに対して作成できるバックアップの総数。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">リソース管理</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="pCPU">CPU制限</label>

                        <div class="input-group">
                            <input type="text" id="pCPU" name="cpu" class="form-control" value="{{ old('cpu', 0) }}" />
                            <span class="input-group-addon">%</span>
                        </div>

                        <p class="text-muted small">CPU使用率を制限しない場合は、値を <code>0</code> に設定してください。値を決定するには、スレッド数を 100 倍します。たとえば、ハイパースレッディングなしのクアッドコアシステムでは <code>(4 * 100 = 400)</code> で、<code>400%</code> が利用可能です。サーバーが単一スレッドの半分を使用するように制限するには、値を <code>50</code> に設定します。サーバーが最大 2 つのスレッドを使用できるようにするには、値を <code>200</code> に設定します。<p>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="pThreads">CPUピニング</label>

                        <div>
                            <input type="text" id="pThreads" name="threads" class="form-control" value="{{ old('threads') }}" />
                        </div>

                        <p class="text-muted small"><strong>高度な設定</strong>: このプロセスが実行できる特定の CPU スレッドを入力するか、すべてのスレッドを許可する場合は空白のままにします。これは単一の数値、またはカンマ区切りのリストにすることができます。例: <code>0</code>、<code>0-1,3</code>、または <code>0,1,3,4</code>。</p>
                    </div>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="pMemory">メモリ</label>

                        <div class="input-group">
                            <input type="text" id="pMemory" name="memory" class="form-control" value="{{ old('memory') }}" />
                            <span class="input-group-addon">MiB</span>
                        </div>

                        <p class="text-muted small">このコンテナに許可される最大メモリ量。これを <code>0</code> に設定すると、コンテナ内のメモリは無制限になります。</p>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="pSwap">スワップ</label>

                        <div class="input-group">
                            <input type="text" id="pSwap" name="swap" class="form-control" value="{{ old('swap', 0) }}" />
                            <span class="input-group-addon">MiB</span>
                        </div>

                        <p class="text-muted small">これを <code>0</code> に設定すると、このサーバーのスワップ領域が無効になります。<code>-1</code> に設定すると、無制限のスワップが許可されます。</p>
                    </div>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="pDisk">ディスク容量</label>

                        <div class="input-group">
                            <input type="text" id="pDisk" name="disk" class="form-control" value="{{ old('disk') }}" />
                            <span class="input-group-addon">MiB</span>
                        </div>

                        <p class="text-muted small">このサーバーは、この容量を超えるスペースを使用している場合、起動を許可されません。実行中にこの制限を超えた場合、十分なスペースが利用可能になるまで安全に停止され、ロックされます。無制限のディスク使用量を許可するには、<code>0</code> に設定します。</p>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="pIO">ブロックIOウェイト</label>

                        <div>
                            <input type="text" id="pIO" name="io" class="form-control" value="{{ old('io', 500) }}" />
                        </div>

                        <p class="text-muted small"><strong>高度な設定</strong>: システム上の他の<em>実行中の</em>コンテナに対するこのサーバーの IO パフォーマンス。値は <code>10</code> から <code>1000</code> の間でなければなりません。詳細については、<a href="https://docs.docker.com/engine/reference/run/#block-io-bandwidth-blkio-constraint" target="_blank">このドキュメント</a>を参照してください。</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <div class="checkbox checkbox-primary no-margin-bottom">
                            <input type="checkbox" id="pOomDisabled" name="oom_disabled" value="0" {{ \Pterodactyl\Helpers\Utilities::checked('oom_disabled', 0) }} />
                            <label for="pOomDisabled" class="strong">OOM Killerを有効にする</label>
                        </div>

                        <p class="small text-muted no-margin">メモリ制限を超えた場合にサーバーを強制終了します。OOM killerを有効にすると、サーバープロセスが予期せず終了する可能性があります。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ネスト構成</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-12">
                        <label for="pNestId">ネスト</label>

                        <select id="pNestId" name="nest_id" class="form-control">
                            @foreach($nests as $nest)
                                <option value="{{ $nest->id }}"
                                    @if($nest->id === old('nest_id'))
                                        selected="selected"
                                    @endif
                                >{{ $nest->name }}</option>
                            @endforeach
                        </select>

                        <p class="small text-muted no-margin">このサーバーがグループ化されるネストを選択してください。</p>
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="pEggId">エッグ</label>
                        <select id="pEggId" name="egg_id" class="form-control"></select>
                        <p class="small text-muted no-margin">このサーバーの動作を定義するエッグを選択してください。</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <div class="checkbox checkbox-primary no-margin-bottom">
                            <input type="checkbox" id="pSkipScripting" name="skip_scripts" value="1" {{ \Pterodactyl\Helpers\Utilities::checked('skip_scripts', 0) }} />
                            <label for="pSkipScripting" class="strong">エッグインストールスクリプトをスキップ</label>
                        </div>

                        <p class="small text-muted no-margin">選択したエッグにインストールスクリプトが添付されている場合、インストール中にスクリプトが実行されます。この手順をスキップする場合は、このチェックボックスをオンにしてください。</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Docker構成</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-12">
                        <label for="pDefaultContainer">Dockerイメージ</label>
                        <select id="pDefaultContainer" name="image" class="form-control"></select>
                        <input id="pDefaultContainerCustom" name="custom_image" value="{{ old('custom_image') }}" class="form-control" placeholder="またはカスタムイメージを入力..." style="margin-top:1rem"/>
                        <p class="small text-muted no-margin">これは、このサーバーを実行するために使用されるデフォルトの Docker イメージです。上記のドロップダウンからイメージを選択するか、上記のテキストフィールドにカスタムイメージを入力してください。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">起動構成</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-12">
                        <label for="pStartup">起動コマンド</label>
                        <input type="text" id="pStartup" name="startup" value="{{ old('startup') }}" class="form-control" />
                        <p class="small text-muted no-margin">起動コマンドには、<code>@{{SERVER_MEMORY}}</code>、<code>@{{SERVER_IP}}</code>、および <code>@{{SERVER_PORT}}</code> のデータ置換が利用可能です。これらは、それぞれ割り当てられたメモリ、サーバーIP、およびサーバーポートに置き換えられます。</p>
                    </div>
                </div>

                <div class="box-header with-border" style="margin-top:-10px;">
                    <h3 class="box-title">サービス変数</h3>
                </div>

                <div class="box-body row" id="appendVariablesTo"></div>

                <div class="box-footer">
                    {!! csrf_field() !!}
                    <input type="submit" class="btn btn-success pull-right" value="サーバーを作成" />
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}

    <script type="application/javascript">
        // 'サービス変数' の永続化
        function serviceVariablesUpdated(eggId, ids) {
            @if (old('egg_id'))
                // egg ID が一致するか確認します。
                if (eggId != '{{ old('egg_id') }}') {
                    return;
                }

                @if (old('environment'))
                    @foreach (old('environment') as $key => $value)
                        $('#' + ids['{{ $key }}']).val('{{ $value }}');
                    @endforeach
                @endif
            @endif
            @if(old('image'))
                $('#pDefaultContainer').val('{{ old('image') }}');
            @endif
        }
        // END 'サービス変数' の永続化
    </script>

    {!! Theme::js('js/admin/new-server.js?v=20220530') !!}

    <script type="application/javascript">
        $(document).ready(function() {
            // 'サーバーオーナー' select2 の永続化
            @if (old('owner_id'))
                $.ajax({
                    url: '/admin/users/accounts.json?user_id={{ old('owner_id') }}',
                    dataType: 'json',
                }).then(function (data) {
                    initUserIdSelect([ data ]);
                });
            @else
                initUserIdSelect();
            @endif
            // END 'サーバーオーナー' select2 の永続化

            // 'ノード' select2 の永続化
            @if (old('node_id'))
                $('#pNodeId').val('{{ old('node_id') }}').change();

                // 'デフォルト割り当て' select2 の永続化
                @if (old('allocation_id'))
                    $('#pAllocation').val('{{ old('allocation_id') }}').change();
                @endif
                // END 'デフォルト割り当て' select2 の永続化

                // '追加の割り当て' select2 の永続化
                @if (old('allocation_additional'))
                    const additional_allocations = [];

                    @for ($i = 0; $i < count(old('allocation_additional')); $i++)
                        additional_allocations.push('{{ old('allocation_additional.'.$i)}}');
                    @endfor

                    $('#pAllocationAdditional').val(additional_allocations).change();
                @endif
                // END '追加の割り当て' select2 の永続化
            @endif
            // END 'ノード' select2 の永続化

            // 'ネスト' select2 の永続化
            @if (old('nest_id'))
                $('#pNestId').val('{{ old('nest_id') }}').change();

                // 'エッグ' select2 の永続化
                @if (old('egg_id'))
                    $('#pEggId').val('{{ old('egg_id') }}').change();
                @endif
                // END 'エッグ' select2 の永続化
            @endif
            // END 'ネスト' select2 の永続化
        });
    </script>
@endsection