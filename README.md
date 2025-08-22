# Pterodactyl Panel 日本語ファイル導入手順

Pterodactyl Panelを日本語化するためのファイルセットです。

**パネルバージョン:** 本翻訳ファイルは`v1.11.11`に対応しております。

## 注意事項

- 本ファイルの使用により生じたトラブルに関して、提供者は一切の責任を負いません。
- アドオンやテーマを使用している場合は、使用しないでください。
- 一部翻訳ができていない場合があります。
- 翻訳を使っているので、日本語が不自然なところがあるかもしれません。
- 今後も日本語ファイルの改良を予定しています。

---

## 導入手順

### 1. ファイルの置き換え

`resources/`内にあるすべてのデータを入れ替えてください。

### 2. ビルドの実行

以下の手順で、ビルドを行います。

詳細は下記のURLよりご確認ください。
https://pterodactyl.io/community/customization/panel.html

#### NodeJSのインストール

使用するOSに応じて、以下のコマンドを実行してください。

- **Ubuntu / Debianの場合:**

```bash
curl -sL https://deb.nodesource.com/setup_16.x | sudo -E bash -
sudo apt install -y nodejs
```

- **CentOSの場合:**

```bash
curl -sL https://rpm.nodesource.com/setup_16.x | sudo -E bash -

# CentOS 7の場合
sudo yum install -y nodejs yarn

# CentOS 8, Rocky Linux 8, AlmaLinux 8の場合
sudo dnf install -y nodejs yarn
```

#### 必要なJavaScriptパッケージのインストール

```bash
npm i -g yarn
cd /var/www/pterodactyl
yarn
```

#### パネルアセットのビルド

```bash
cd /var/www/pterodactyl
export NODE_OPTIONS=--openssl-legacy-provider # NodeJS v17以上の場合に必要です。
yarn build:production
```

ビルドが完了したら、Pterodactyl Panelが日本語化されています。

---

本ドキュメントの作成日: 2025年08月22日
