@extends('layouts.admin')

@section('title')
    ネスト
@endsection

@section('content-header')
    <h1>ネスト<small>このシステムで現在利用可能なすべてのネストです。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">ネスト</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-danger">
            エッグはPterodactyl Panelの強力な機能で、高い柔軟性と構成能力を提供します。ただし強力である一方、エッグを誤って変更するとサーバーが簡単に壊れ、さらに多くの問題を引き起こす可能性があります。自分が何をしているか完全に理解していない限り、<code>support@pterodactyl.io</code> が提供するデフォルトエッグの編集は避けてください。
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">構成済みネスト</h3>
                <div class="box-tools">
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#importServiceOptionModal" role="button"><i class="fa fa-upload"></i> エッグをインポート</a>
                    <a href="{{ route('admin.nests.new') }}" class="btn btn-primary btn-sm">新規作成</a>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>説明</th>
                        <th class="text-center">エッグ</th>
                        <th class="text-center">サーバー</th>
                    </tr>
                    @foreach($nests as $nest)
                        <tr>
                            <td class="middle"><code>{{ $nest->id }}</code></td>
                            <td class="middle"><a href="{{ route('admin.nests.view', $nest->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $nest->author }}">{{ $nest->name }}</a></td>
                            <td class="col-xs-6 middle">{{ $nest->description }}</td>
                            <td class="text-center middle">{{ $nest->eggs_count }}</td>
                            <td class="text-center middle">{{ $nest->servers_count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="importServiceOptionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">エッグをインポート</h4>
            </div>
            <form action="{{ route('admin.nests.egg.import') }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label" for="pImportFile">エッグファイル <span class="field-required"></span></label>
                        <div>
                            <input id="pImportFile" type="file" name="import_file" class="form-control" accept="application/json" />
                            <p class="small text-muted">インポートする新しいエッグの <code>.json</code> ファイルを選択してください。</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="pImportToNest">関連付けるネスト <span class="field-required"></span></label>
                        <div>
                            <select id="pImportToNest" name="import_to_nest">
                                @foreach($nests as $nest)
                                   <option value="{{ $nest->id }}">{{ $nest->name }} &lt;{{ $nest->author }}&gt;</option>
                                @endforeach
                            </select>
                            <p class="small text-muted">このエッグを関連付けるネストをドロップダウンから選択してください。新しいネストに関連付ける場合は、続行する前にそのネストを作成する必要があります。</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary">インポート</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#pImportToNest').select2();
        });
    </script>
@endsection
