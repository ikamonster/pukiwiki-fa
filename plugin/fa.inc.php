<?php
/*
PukiWiki - Yet another WikiWikiWeb clone.
fa.inc.php, v1.01 2020 M.Taniguchi
License: GPL v3 or (at your option) any later version

FontAwesome Version 5 によるアイコンを表示するプラグイン。

Font Awesome公式サイトにユーザー登録して Kit Code を取得するか、ファイル一式をダウンロードしてあらかじめスキンに組み込んでおく必要があります。
FontAwesome Version 5 向けに実装しているため、互換性にご注意ください。

【使い方】
&fa(code[,[color][,scale]]){[code2[,color2]]};

code  … アイコンコード。Font Awesomeサイト発行の各アイコンHTML「<i class="faX fa-XXXX XXX"></i>」の「faX fa-XXXX XXX」部分
color … 表示色。形式は #RRGGBB, rgba(R,G,B,A), 色名, CSSカスタムプロパティ等（CSSで使える形式）。省略すると文字と同じ色
scale … 表示倍率。単位は px, %, em, CSSカスタムプロパティ等（CSSで使える単位）。省略時の既定値は 100%
code2,color2 … アイコンを2つ重ねる場合に使用。両code内に fa-stack-?x 指定が必須。下記使用例4)を参照

【使用例】
1) &fa(far fa-smile);
2) &fa(fas fa-save fa-2x);
3) &fa(fa fa-cog fa-fw,#009999);
4) &fa(fas fa-camera fa-stack-1x){fas fa-ban fa-stack-2x,Tomato};
*/

/////////////////////////////////////////////////
// アイコン表示プラグイン設定（fa.inc.php）
if (!defined('PLUGIN_FA_KITCODE')) define('PLUGIN_FA_KITCODE', ''); // Font Awesomeをロードするための Kit Code（例：'<script src="https://kit.fontawesome.com/xxxxxxxxxx.js" crossorigin="anonymous"></script>'）※スキン側でロード済みなら設定不要（空文字にしておく）
if (!defined('PLUGIN_FA_STYLE'))   define('PLUGIN_FA_STYLE',   ''); // アイコンに共通して適用するスタイル（例：'.fa,.fab,.fad,.fal,.far,.fas { vertical-align: middle; }'）


function plugin_fa_inline() {
	$args = func_get_args();
	list($id, $color, $scale) = $args;

	$scale = ($scale)? ('font-size:' . htmlsc($scale) . ';') : '';
	$color = ($color)? ('color:' . htmlsc($color) . ';') : '';

	$second = end($args);
	if (!$second) {
		$style = ($scale || $color)? (' style="' . $scale . $color . '"') : '';
		$code = '<i class="' . htmlsc($id) . '"' . $style . '></i>';
	} else {
		$style = ($color)? (' style="' . $color . '"') : '';
		$code = '<i class="' . htmlsc($id) . '"' . $style . '></i>';

		list($id, $color) = explode(',', $second);
		$style = ($color)? (' style="color:' . htmlsc($color) . '"') : '';

		$code = '<span class="fa-stack"' . (($scale)? (' style="' . $scale . '"') : '') . '>' . $code . '<i class="' . htmlsc($id) . '"' . $style . '></i></span>';
	}

	static	$included = false;
	if (!$included) {
		if (PLUGIN_FA_STYLE != '') $code .= '<style>' . trim(PLUGIN_FA_STYLE) . '</style>';
		if (PLUGIN_FA_KITCODE != '') $code .= trim(PLUGIN_FA_KITCODE);
		$included = true;
	}

	return $code;
}
