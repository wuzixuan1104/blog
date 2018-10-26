<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Main extends SiteController {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $asset = Asset::create()
                  ->addJS('/asset/js/res/jquery-1.10.2.min.js')
                  ->addJS('/asset/js/site/layout.js')
                  ->addJS('/asset/js/res/imgLiquid-min.js')
                  ->addCSS('/asset/css/icon-site.css')
                  ->addCSS('/asset/css/site/public.css')
                  ->addCSS('/asset/css/site/Main/index.css');

    return View::create('site/Main/index.php')
               ->with('asset', $asset)
               ->with('me', \M\Me::one())
               ->with('devCnt', \M\Article::count('type = ?', \M\Article::TYPE_DEV))
               ->with('lifeCnt', \M\Article::count('type = ?', \M\Article::TYPE_LIFE));
  }
}
