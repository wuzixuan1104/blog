<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Main extends SiteController {
  public function __construct() {
    parent::__construct();

    $this->view->with('title', '首頁 - Hsuan\'s Blog');
  }

  public function index() {
    $asset = $this->asset->addCSS('/asset/css/site/Main/index.css');

    return $this->view->setPath('site/main.php')
               ->with('asset', $asset);

  }
}
