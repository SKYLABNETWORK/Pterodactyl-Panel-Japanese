@section('settings::notice')
    @if(config('pterodactyl.load_environment_only', false))
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    現在のパネルは、環境設定のみから設定を読み取るように構成されています。設定を動的に読み込むには、環境ファイルで <code>APP_ENVIRONMENT_ONLY=false</code> を設定する必要があります。
                </div>
            </div>
        </div>
    @endif
@endsection