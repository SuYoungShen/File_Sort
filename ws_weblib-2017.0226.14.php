<?php

class ws_weblib {

	// 基本網址
	private $baseUrl;

	// 初始化
	public function __construct ($fn_baseUrl = '')
	{
		// 基本網址
		$this->baseUrl = str_replace('\\', '/', $fn_baseUrl);
	}

	// 變更基本路徑
	public function baseUrl ($fn_baseUrl)
	{
		$this->baseUrl = str_replace('\\', '/', $fn_baseUrl);
	}

	// 檔案清單
	public function list ($fn_list, $fn_tag = '')
	{
		// 分析「外掛清單」文字轉陣列
		$list_list = explode('|', preg_replace('/\t|\r|\n/', '', $fn_list));
		// 處理「外掛清單」
		foreach ($list_list as $list_file) {
			//
			$list_file = str_replace('\\', '/', $list_file);
			// 基本網址
			$list_parse_url = parse_url($list_file);
			$list_url = (count($list_parse_url) > 1) ? $list_file : $this->baseUrl . $list_file;
			// 處理
			$list_tag = strtolower($fn_tag);
			$list_pathinfo = strtolower(pathinfo($list_url, PATHINFO_EXTENSION));
			$lsit_tag_js = '<script src="%s"></script>';
			$list_tag_css = '<link rel="stylesheet" href="%s" />';
			if (substr_count($list_file, '/p*') == 1) {
				// 程式注解 <!-- %s -->，不處理
			} elseif (substr_count($list_file, '/h*') == 1) {
				// 網頁注解 <!-- %s -->
				echo sprintf("\n <!-- %s -->", str_replace('/h*', '', $list_file));
			} elseif ($list_tag == 'js') {
				// 強制 js <script src="%s"></script>
				echo sprintf("\n" . $lsit_tag_js, $list_url);
			} elseif ($list_tag == 'css') {
				// 強制 css <link rel="stylesheet" href="%s" />
				echo sprintf("\n" . $list_tag_css, $list_url);
			} elseif (substr_count($fn_tag, '%s') == 1) {
				// 自訂，如：<div>%s</div> 或 <link id="css" rel="stylesheet" href="%s" />
				echo sprintf("\n" . $fn_tag, $list_url);
			} elseif ($list_pathinfo == 'js') {
				// 分析後為 js <script src="%s"></script>
				echo sprintf("\n" . $lsit_tag_js, $list_url);
			} elseif ($list_pathinfo == 'css') {
				// 分析後為 css <link rel="stylesheet" href="%s" />
				echo sprintf("\n" . $list_tag_css, $list_url);
			} else {
				echo sprintf("\n <!-- %s -->", $list_url);
			}
		}
	}

	// 網頁語言:script
	public function script ($fn_code)
	{
		echo sprintf("\n<script>%s</script>", $fn_code);
	}

	// 網頁語言:jquery
	public function jquery ($fn_code)
	{
		echo sprintf("\n<script>\n$(function(){%s});\n</script>", $fn_code);
	}

	// 網頁語言:style
	public function style ($fn_code)
	{
		echo sprintf("\n<style>\n%s\n</style>", $fn_code);
	}

	public function web ($fn_text, $fn_tag = '')
	{

		if (in_array(strtolower($fn_tag), array(
			'script',
			'jquery',
			'style'
		))) { // 網頁語言
			switch (strtolower($fn_tag)) {
				// script
				case 'script':
					$this->script($fn_text);
					break;
				// jquery
				case 'jquery':
					$this->jquery($fn_text);
					break;
				// style
				case 'style':
					$this->style($fn_text);
					break;
			}
		} else { // 外掛清單
			$this->list($fn_text, $fn_tag);
		}
	}
}

	$web = new ws_weblib();

	echo $web->web("test.js");



?>
