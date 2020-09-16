<?php

/**
 * [Enable oEmbed] Enable oEmbed ビューイベントリスナ
 *
 * @copyright  Copyright 2014 - , tecking
 * @link       https://baser-for-wper.tecking.org
 * @package    tecking.bcplugins.enable_oembed
 * @since      baserCMS v 3.0.6
 * @version    1.0.0
 * @license    MIT License
 */

// 設定ファイルのロード
Configure::load('Config', 'bootstrap');

// イベントリスナの登録
class EnableOembedViewEventListener extends BcViewEventListener {

	// イベントの登録
	public $events = array('beforeLayout');

	// oEmbed の処理
	public function beforeLayout(CakeEvent $event) {	

		// インスタンス生成
		$Embera = new Embera\Embera();
		
		// レイアウト前のサブジェクトの取得
		$Subject = $event->subject();

		// 管理画面のビューなら何もしない
		$request = $Subject->request;
		if (preg_match('/^admin_/', $request->action)) {
			return;
		}

		// 記事本文（ content ）を取得
		$content = $Subject->Blocks->get('content');

		// {} で囲まれている URL 文字列を暗号化して置換
		$matches = '';
		preg_match_all('/(?P<search>({)(?P<url>https?.+?)(}))/i', $content, $matches);
		foreach ($matches['search'] as $key => $value) {
			$matches['encrypt']{$key} = Security::cipher($value, Configure::read('Security.cipherSeed'));
		}
		if (!empty($matches['encrypt'])) {
			$content = str_replace($matches['search'], $matches['encrypt'], $content);
		}

		// 記事本文（ content ）内の oEmbed 対象 URL 文字列を置換
		$content = $Embera->autoEmbed($content);
		
		// 暗号化された URL 文字列を {} なしの URL 文字列に置換
		if (!empty($matches['encrypt'])) {
			$content = str_replace($matches['encrypt'], $matches['url'], $content);
		}

		// 記事本文（ content ）として設定
		$Subject->Blocks->set('content', $content);

		return;
	}
}
