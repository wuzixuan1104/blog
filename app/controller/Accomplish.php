<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Accomplish extends SiteController {
  public function __construct() {
    parent::__construct();

    $this->view->with('title', '成就紀錄 - Hsuan\'s Blog');
  }

  public function index() {
    $asset = $this->asset->addCSS('/asset/css/site/Accomplish/index.css');

    return $this->view->setPath('site/accomplish.php')
               ->with('asset', $asset);
  }
}
