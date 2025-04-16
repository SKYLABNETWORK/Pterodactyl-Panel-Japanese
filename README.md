# Pterodactyl Panel 日本語ファイル導入手順

Pterodactyl Panelを日本語化するためのファイルセットです。

**注意:** `resources/scripts/`には一部のファイルが入っていますので、置き換える際はご注意ください。

---

## 導入手順

### 1. ファイルの置き換え

提供されたファイルを、Pterodactyl Panelが設置されているディレクトリに上書きしてください。

### 2. ビルドの実行

以下の手順で、ビルドを行います。

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

## 注意事項

- 本ファイルの使用により生じたトラブルに関して、提供者は一切の責任を負いません。
- 翻訳を使っているので、日本語が不自然なところがあるかもしれません。
- 本ドキュメントの作成日: 2025年4月16日
- 今後も日本語ファイルの改良を予定しています。
