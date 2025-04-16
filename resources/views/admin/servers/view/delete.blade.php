@extends('layouts.admin')

@section('title')
    サーバー — {{ $server->name }}: 削除
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>パネルからこのサーバーを削除します。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.servers') }}">サーバー</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">削除</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">安全にサーバーを削除</h3>
            </div>
            <div class="box-body">
                <p>この操作は、パネルとデーモンの両方からサーバーを削除しようとします。どちらか一方からエラーが報告された場合、操作はキャンセルされます。</p>
                <p class="text-danger small">サーバーの削除は元に戻せない操作です。<strong>すべてのサーバーデータ</strong> (ファイルとユーザーを含む) がシステムから削除されます。</p>
            </div>
            <div class="box-footer">
                <form id="deleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button id="deletebtn" class="btn btn-danger">このサーバーを安全に削除</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">強制的にサーバーを削除</h3>
            </div>
            <div class="box-body">
                <p>この操作は、パネルとデーモンの両方からサーバーを削除しようとします。デーモンが応答しない場合、またはエラーを報告した場合でも、削除は続行されます。</p>
                <p class="text-danger small">サーバーの削除は元に戻せない操作です。<strong>すべてのサーバーデータ</strong> (ファイルとユーザーを含む) がシステムから削除されます。この方法では、デーモンがエラーを報告した場合、デーモン上に不要なファイルが残る可能性があります。</p>
            </div>
            <div class="box-footer">
                <form id="forcedeleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="force_delete" value="1" />
                    <button id="forcedeletebtn" class="btn btn-danger">このサーバーを強制的に削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#deletebtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '',
            type: 'warning',
            text: 'このサーバーを削除してもよろしいですか？元に戻すことはできず、すべてのデータは直ちに削除されます。',
            showCancelButton: true,
            confirmButtonText: '削除',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false
        }, function () {
            $('#deleteform').submit()
        });
    });

    $('#forcedeletebtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '',
            type: 'warning',
            text: 'このサーバーを削除してもよろしいですか？元に戻すことはできず、すべてのデータは直ちに削除されます。',
            showCancelButton: true,
            confirmButtonText: '削除',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false
        }, function () {
            $('#forcedeleteform').submit()
        });
    });
    </script>
@endsection