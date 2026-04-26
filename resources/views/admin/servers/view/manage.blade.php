@extends('layouts.admin')

@section('title')
    サーバー — {{ $server->name }}: 管理
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>このサーバーを制御する追加操作です。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.servers') }}">サーバー</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">管理</li>
    </ol>
@endsection

@section('content')
    @include('admin.servers.partials.navigation')
    <div class="row equal-height">
        <div class="col-sm-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">サーバーを再インストール</h3>
                </div>
                <div class="box-body">
                    <p>割り当てられたサービススクリプトを使用してサーバーを再インストールします。<strong>危険!</strong> サーバーデータが上書きされる可能性があります。</p>
                </div>
                <div class="box-footer">
                    @if($server->isInstalled())
                        <form action="{{ route('admin.servers.view.manage.reinstall', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">サーバーを再インストール</button>
                        </form>
                    @else
                        <button class="btn btn-danger disabled">再インストールするにはサーバーが正常にインストールされている必要があります</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">インストール状態</h3>
                </div>
                <div class="box-body">
                    <p>インストール状態を未インストールからインストール済みへ、またはその逆へ変更する必要がある場合は、下のボタンで実行できます。</p>
                </div>
                <div class="box-footer">
                    <form action="{{ route('admin.servers.view.manage.toggle', $server->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary">インストール状態を切り替え</button>
                    </form>
                </div>
            </div>
        </div>

        @if(! $server->isSuspended())
            <div class="col-sm-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">サーバーを一時停止</h3>
                    </div>
                    <div class="box-body">
                        <p>サーバーを一時停止し、実行中のプロセスを停止して、ユーザーがパネルまたはAPIを通じてファイルへアクセスしたりサーバーを管理したりすることを直ちにブロックします。</p>
                    </div>
                    <div class="box-footer">
                        <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="action" value="suspend" />
                            <button type="submit" class="btn btn-warning @if(! is_null($server->transfer)) disabled @endif">サーバーを一時停止</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">サーバーの一時停止を解除</h3>
                    </div>
                    <div class="box-body">
                        <p>サーバーの一時停止を解除し、通常のユーザーアクセスを復元します。</p>
                    </div>
                    <div class="box-footer">
                        <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="action" value="unsuspend" />
                            <button type="submit" class="btn btn-success">一時停止を解除</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if(is_null($server->transfer))
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">サーバーを転送</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            このサーバーを、このパネルに接続された別のノードへ転送します。
                            <strong>警告!</strong> この機能は完全にはテストされておらず、バグがある可能性があります。
                        </p>
                    </div>

                    <div class="box-footer">
                        @if($canTransfer)
                            <button class="btn btn-success" data-toggle="modal" data-target="#transferServerModal">サーバーを転送</button>
                        @else
                            <button class="btn btn-success disabled">サーバーを転送</button>
                            <p style="padding-top: 1rem;">サーバーを転送するには、パネルに複数のノードが構成されている必要があります。</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">サーバーを転送</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            このサーバーは現在、別のノードへ転送中です。
                            転送は <strong>{{ $server->transfer->created_at }}</strong> に開始されました
                        </p>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-success disabled">サーバーを転送</button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="transferServerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.servers.view.manage.transfer', $server->id) }}" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">サーバーを転送</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="pNodeId">ノード</label>
                                <select name="node_id" id="pNodeId" class="form-control">
                                    @foreach($locations as $location)
                                        <optgroup label="{{ $location->long }} ({{ $location->short }})">
                                            @foreach($location->nodes as $node)

                                                @if($node->id != $server->node_id)
                                                    <option value="{{ $node->id }}"
                                                            @if($location->id === old('location_id')) selected @endif
                                                    >{{ $node->name }}</option>
                                                @endif

                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <p class="small text-muted no-margin">このサーバーの転送先となるノードです。</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pAllocation">デフォルト割り当て</label>
                                <select name="allocation_id" id="pAllocation" class="form-control"></select>
                                <p class="small text-muted no-margin">このサーバーに割り当てられるメインの割り当てです。</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pAllocationAdditional">追加割り当て</label>
                                <select name="allocation_additional[]" id="pAllocationAdditional" class="form-control" multiple></select>
                                <p class="small text-muted no-margin">作成時にこのサーバーへ割り当てる追加の割り当てです。</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {!! csrf_field() !!}
                        <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-success btn-sm">確認</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}

    @if($canTransfer)
        {!! Theme::js('js/admin/server/transfer.js') !!}
    @endif
@endsection
