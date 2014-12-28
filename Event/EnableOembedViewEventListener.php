<?php

/**
 * [Enable oEmbed] Enable oEmbed ビューイベントリスナー
 *
 * @copyright  Copyright 2014 - , tecking
 * @link       http://baser-for-wper.tecking.org
 * @package    tecking.bcplugins.enable_oembed
 * @since      baserCMS v 3.0.6
 * @version    0.1
 * @license    MIT License
 */


// イベントリスナの登録
class EnableOembedViewEventListener extends BcViewEventListener {

	// Essence のロード
	function __construct() {
		require_once(dirname(__FILE__) . '/../Vendor/essence/lib/bootstrap.php');
	}

	// イベントの登録
	public $events = array('beforeLayout');

	// oEmbed の処理
	public function beforeLayout(CakeEvent $event) {

		// インスタンス生成
		$Essence = Essence\Essence::instance();

		// レイアウト前のサブジェクトの取得
		$view = $event->subject();

		// 管理画面のビューなら何もしない
		$request = $view->request;
		if (preg_match('/^admin_/', $request->action)) {
			return;
		}

		// 記事本文（ content ）内の対象 URL を置換
		$content = $Essence->replace($view->Blocks->get('content'));
		$view->Blocks->set('content', $content);

		return;
	}
}
