# PukiWiki用プラグイン<br>アイコン表示 fa.inc.php

[Font Awesome](https://fontawesome.com/) によるアイコンを表示する[PukiWiki](https://pukiwiki.osdn.jp/)用プラグイン。  
Font Awesome 公式サイトにユーザー登録して Kit Code を取得するか、ファイル一式をダウンロードしてあらかじめスキンに組み込んでおく必要があります。  
FontAwesome Version 5 向けに実装しているため、互換性にご注意ください。

|対象PukiWikiバージョン|対象PHPバージョン|
|:---:|:---:|
|PukiWiki 1.5.3 ~ 1.5.4RC (UTF-8)|PHP 7.4 ~ 8.1|

## インストール

fa.inc.php を PukiWiki の plugin ディレクトリに配置してください。

## 使い方

```
&fa(code[,[color][,scale]]){[code2[,color2]]};
```

* code … アイコンコード。Font Awesomeサイト発行の各アイコンHTML「<i class="faX fa-XXXX XXX"></i>」の「faX fa-XXXX XXX」部分
* color … 表示色。形式は #RRGGBB, rgba(R,G,B,A), 色名, CSSカスタムプロパティ等（CSSで使える形式）。省略すると文字と同じ色
* scale … 表示倍率。単位は px, %, em, CSSカスタムプロパティ等（CSSで使える単位）。省略時の既定値は 100%
* code2,color2 … アイコンを2つ重ねる場合に使用。両code内に fa-stack-?x 指定が必須。下記の最後の使用例を参照

## 使用例

```
&fa(far fa-smile);
&fa(fas fa-save fa-2x);
&fa(fa fa-cog fa-fw,#009999);
&fa(fas fa-camera fa-stack-1x){fas fa-ban fa-stack-2x,Tomato};
```

## 設定

ソース内の下記の定数で動作を制御することができます。

|定数名|値|既定値|意味|
|:---|:---:|:---:|:---|
|PLUGIN_FA_KITCODE|文字列|1|Font Awesome をロードするための Kit Code<br>（例：'<script src="https://kit.fontawesome.com/xxxxxxxxxx.js" crossorigin="anonymous"></script>'）|
|PLUGIN_FA_STYLE|文字列||アイコンに共通して適用するスタイル<br>（例：'.fa,.fab,.fad,.fal,.far,.fas { vertical-align: middle; }'）|
