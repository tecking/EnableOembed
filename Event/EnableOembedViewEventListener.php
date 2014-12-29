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

		$content = $view->Blocks->get('content');
		// $content = preg_replace('/({http.+?})/', Security::cipher("$1", Configure::read('Security.cipherSeed')), $content);
		// $content = preg_replace('/({http.+?})/', "$1", $content);

		preg_match_all('/(?P<search>({)(?P<url>https?.+?)(}))/i', $content, $matches);

		foreach ($matches['search'] as $key => $value) {
			// $value['encrypt'] = Security::cipher($value, Configure::read('Security.cipherSeed'));
			$matches['encrypt']{$key} = Security::cipher($value, Configure::read('Security.cipherSeed'));
			// $encrypt[] = Security::cipher($value, Configure::read('Security.cipherSeed'));
		}

		// var_dump($matches['search']);
		// var_dump($matches['url']);
		// var_dump($matches['encrypt']);

		// $patterns = $matches['url'];
		// $replacements = $matches['encrypt'];

		$content = str_replace($matches['search'], $matches['encrypt'], $content);

		// $content = preg_replace('/({)(https?.+?)(})/i', "$2", $content);


// // 
// 		foreach ($encrypt as $key => $value) {
// 			$decode[] = Security::cipher($value, Configure::read('Security.cipherSeed'));
// 		}
// 		var_dump($decode);

		// 記事本文（ content ）内の対象 URL を置換
		// $content = $Essence->replace($view->Blocks->get('content'));
		$content = $Essence->replace($content);

		$content = str_replace($matches['encrypt'], $matches['url'], $content);
		$view->Blocks->set('content', $content);

		return;
	}
}
