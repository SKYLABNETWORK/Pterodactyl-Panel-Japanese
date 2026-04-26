@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'mail'])

@section('title')
    メール設定
@endsection

@section('content-header')
    <h1>メール設定<small>Pterodactylのメール送信方法を構成します。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">設定</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">メール設定</h3>
                </div>
                @if($disabled)
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-info no-margin-bottom">
                                    この画面は、メールドライバーとしてSMTPを使用しているインスタンスに限定されています。<code>php artisan p:environment:mail</code> コマンドを使用してメール設定を更新するか、環境ファイルで <code>MAIL_DRIVER=smtp</code> を設定してください。
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <form>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">SMTPホスト</label>
                                    <div>
                                        <input required type="text" class="form-control" name="mail:mailers:smtp:host" value="{{ old('mail:mailers:smtp:host', config('mail.mailers.smtp.host')) }}" />
                                        <p class="text-muted small">メール送信に使用するSMTPサーバーアドレスを入力してください。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">SMTPポート</label>
                                    <div>
                                        <input required type="number" class="form-control" name="mail:mailers:smtp:port" value="{{ old('mail:mailers:smtp:port', config('mail.mailers.smtp.port')) }}" />
                                        <p class="text-muted small">メール送信に使用するSMTPサーバーポートを入力してください。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">暗号化</label>
                                    <div>
                                        @php
                                            $encryption = old('mail:mailers:smtp:encryption', config('mail.mailers.smtp.encryption'));
                                        @endphp
                                        <select name="mail:mailers:smtp:encryption" class="form-control">
                                            <option value="" @if($encryption === '') selected @endif>なし</option>
                                            <option value="tls" @if($encryption === 'tls') selected @endif>Transport Layer Security (TLS)</option>
                                            <option value="ssl" @if($encryption === 'ssl') selected @endif>Secure Sockets Layer (SSL)</option>
                                        </select>
                                        <p class="text-muted small">メール送信時に使用する暗号化の種類を選択してください。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">ユーザー名 <span class="field-optional"></span></label>
                                    <div>
                                        <input type="text" class="form-control" name="mail:mailers:smtp:username" value="{{ old('mail:mailers:smtp:username', config('mail.mailers.smtp.username')) }}" />
                                        <p class="text-muted small">SMTPサーバーへの接続時に使用するユーザー名です。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">パスワード <span class="field-optional"></span></label>
                                    <div>
                                        <input type="password" class="form-control" name="mail:mailers:smtp:password"/>
                                        <p class="text-muted small">SMTPユーザー名と併用するパスワードです。既存のパスワードを引き続き使用する場合は空欄のままにしてください。パスワードを空の値に設定するには、フィールドに <code>!e</code> と入力してください。</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr />
                                <div class="form-group col-md-6">
                                    <label class="control-label">メール送信元</label>
                                    <div>
                                        <input required type="email" class="form-control" name="mail:from:address" value="{{ old('mail:from:address', config('mail.from.address')) }}" />
                                        <p class="text-muted small">すべての送信メールの送信元となるメールアドレスを入力してください。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">メール送信者名 <span class="field-optional"></span></label>
                                    <div>
                                        <input type="text" class="form-control" name="mail:from:name" value="{{ old('mail:from:name', config('mail.from.name')) }}" />
                                        <p class="text-muted small">メールの送信者として表示される名前です。</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            {{ csrf_field() }}
                            <div class="pull-right">
                                <button type="button" id="testButton" class="btn btn-sm btn-success">テスト</button>
                                <button type="button" id="saveButton" class="btn btn-sm btn-primary">保存</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent

    <script>
        function saveSettings() {
            return $.ajax({
                method: 'PATCH',
                url: '/admin/settings/mail',
                contentType: 'application/json',
                data: JSON.stringify({
                    'mail:mailers:smtp:host': $('input[name="mail:mailers:smtp:host"]').val(),
                    'mail:mailers:smtp:port': $('input[name="mail:mailers:smtp:port"]').val(),
                    'mail:mailers:smtp:encryption': $('select[name="mail:mailers:smtp:encryption"]').val(),
                    'mail:mailers:smtp:username': $('input[name="mail:mailers:smtp:username"]').val(),
                    'mail:mailers:smtp:password': $('input[name="mail:mailers:smtp:password"]').val(),
                    'mail:from:address': $('input[name="mail:from:address"]').val(),
                    'mail:from:name': $('input[name="mail:from:name"]').val()
                }),
                headers: { 'X-CSRF-Token': $('input[name="_token"]').val() }
            }).fail(function (jqXHR) {
                showErrorDialog(jqXHR, 'save');
            });
        }

        function testSettings() {
            swal({
                type: 'info',
                title: 'メール設定をテスト',
                text: 'テストを開始するには「テスト」をクリックしてください。',
                showCancelButton: true,
                confirmButtonText: 'テスト',
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    method: 'POST',
                    url: '/admin/settings/mail/test',
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                }).fail(function (jqXHR) {
                    showErrorDialog(jqXHR, 'test');
                }).done(function () {
                    swal({
                        title: '成功',
                        text: 'テストメッセージを正常に送信しました。',
                        type: 'success'
                    });
                });
            });
        }

        function saveAndTestSettings() {
            saveSettings().done(testSettings);
        }

        function showErrorDialog(jqXHR, verb) {
            console.error(jqXHR);
            var errorText = '';
            if (!jqXHR.responseJSON) {
                errorText = jqXHR.responseText;
            } else if (jqXHR.responseJSON.error) {
                errorText = jqXHR.responseJSON.error;
            } else if (jqXHR.responseJSON.errors) {
                $.each(jqXHR.responseJSON.errors, function (i, v) {
                    if (v.detail) {
                        errorText += v.detail + ' ';
                    }
                });
            }
            var action = verb === 'save' ? '保存' : 'テスト';

            swal({
                title: 'エラー',
                text: 'メール設定を' + action + 'しようとしている間にエラーが発生しました: ' + errorText,
                type: 'error'
            });
        }

        $(document).ready(function () {
            $('#testButton').on('click', saveAndTestSettings);
            $('#saveButton').on('click', function () {
                saveSettings().done(function () {
                    swal({
                        title: '成功',
                        text: 'メール設定が正常に更新され、変更を適用するためにキューワーカーが再起動されました。',
                        type: 'success'
                    });
                });
            });
        });
    </script>
@endsection
