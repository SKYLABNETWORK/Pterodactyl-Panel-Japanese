@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'advanced'])

@section('title')
    詳細設定
@endsection

@section('content-header')
    <h1>詳細設定<small>Pterodactylの詳細設定を構成します。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">設定</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="" method="POST">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">reCAPTCHA</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">状態</label>
                                <div>
                                    <select class="form-control" name="recaptcha:enabled">
                                        <option value="true">有効</option>
                                        <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>無効</option>
                                    </select>
                                    <p class="text-muted small">有効にすると、ログインフォームとパスワードリセットフォームでサイレントCAPTCHAチェックを行い、必要に応じて表示型CAPTCHAを表示します。</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">サイトキー</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:website_key" value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">シークレットキー</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:secret_key" value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}">
                                    <p class="text-muted small">サイトとGoogleの通信に使用されます。必ず秘密にしてください。</p>
                                </div>
                            </div>
                        </div>
                        @if($showRecaptchaWarning)
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning no-margin">
                                        現在、このパネルに同梱されているreCAPTCHAキーを使用しています。セキュリティ向上のため、このWebサイト専用の<a href="https://www.google.com/recaptcha/admin">新しいInvisible reCAPTCHAキーを生成</a>することを推奨します。
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">HTTP接続</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">接続タイムアウト</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:connect_timeout" value="{{ old('pterodactyl:guzzle:connect_timeout', config('pterodactyl.guzzle.connect_timeout')) }}">
                                    <p class="text-muted small">エラーを投げる前に、接続が開かれるまで待機する秒数です。</p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">リクエストタイムアウト</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:timeout" value="{{ old('pterodactyl:guzzle:timeout', config('pterodactyl.guzzle.timeout')) }}">
                                    <p class="text-muted small">エラーを投げる前に、リクエストの完了を待機する秒数です。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">自動割り当て作成</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">状態</label>
                                <div>
                                    <select class="form-control" name="pterodactyl:client_features:allocations:enabled">
                                        <option value="false">無効</option>
                                        <option value="true" @if(old('pterodactyl:client_features:allocations:enabled', config('pterodactyl.client_features.allocations.enabled'))) selected @endif>有効</option>
                                    </select>
                                    <p class="text-muted small">有効にすると、ユーザーはフロントエンドからサーバー用の新しい割り当てを自動作成できるようになります。</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">開始ポート</label>
                                <div>
                                    <input type="number" class="form-control" name="pterodactyl:client_features:allocations:range_start" value="{{ old('pterodactyl:client_features:allocations:range_start', config('pterodactyl.client_features.allocations.range_start')) }}">
                                    <p class="text-muted small">自動割り当て可能な範囲の開始ポートです。</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">終了ポート</label>
                                <div>
                                    <input type="number" class="form-control" name="pterodactyl:client_features:allocations:range_end" value="{{ old('pterodactyl:client_features:allocations:range_end', config('pterodactyl.client_features.allocations.range_end')) }}">
                                    <p class="text-muted small">自動割り当て可能な範囲の終了ポートです。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
