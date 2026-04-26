@section('settings::notice')
    @if(config('pterodactyl.load_environment_only', false))
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    パネルは現在、環境からのみ設定を読み取るように構成されています。設定を動的に読み込むには、環境ファイルで <code>APP_ENVIRONMENT_ONLY=false</code> を設定する必要があります。
                </div>
            </div>
        </div>
    @endif
@endsection
