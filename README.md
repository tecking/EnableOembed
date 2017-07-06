# Enable oEmbed

## これは何?

[baserCMS](https://basercms.net/) で [oEmbed](http://oembed.com/) を利用可能にするプラグインです。URL の解析に [Embera](https://github.com/mpratt/Embera) を使っています。

## インストール方法

git clone または ZIP ファイルをダウンロードして /app/Plugin ディレクトリ内に配置してください。ZIP ファイルの場合 EnableOembed-master というフォルダ名で展開されるので、あらかじめ EnableOembed とリネームする必要があります。

インストール後、管理画面の [プラグイン管理] で『Enable oEmbed』プラグインを有効化してください。

## 使い方

埋め込みたいメディア（動画, ツイート, スライドなど）の URL を記事本文に記述してください。自動的に埋め込みコードに置換され、ウェブページ上に表示されます。

自動的に置換されるウェブサービス（ oEmbed プロバイダ）一覧は [Embera の Supported Sites の項](https://github.com/mpratt/Embera#supported-sites)にあります。

### メディアの埋め込みを避けたいとき

記事本文に記述する URL を {} で囲んでください。

### 記事本文の記述例と表示結果

* ````http://example.com/?foo=bar```` … メディアが埋め込まれます
* ````{http://example.com/?foo=bar}```` … メディアは埋め込まれません（ URL がそのまま表示されます）

## 更新履歴

* 0.4 ( 2017-07-06 )
	* 同梱ライブラリを Embera に変更  
	（ cURL サポートまたは allow_url_fopen = on が必須）
* 0.3.2（ 2015-02-06 ）
	* コーディング規約に沿ってリファクタリング
* 0.3.1（ 2015-01-18 ）
	* 記事内に {} で囲まれた URL がないとき Undefined index の警告を回避する処理を追加
* 0.3（ 2014-12-30 ）
	* 初期設定の記述を Config/bootstrap.php に分離  
	（ thanks to [@n_1215 さん](https://twitter.com/n_1215/status/549548359648677889) ）
* 0.2（ 2014-12-29 ）
	* メディアの埋め込みを避けるための処理を追加
* 0.1（ 2014-12-29 ）
	* 公開