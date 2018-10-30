<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Life extends SiteController {
  public function __construct() {
    parent::__construct();
    
    $this->view->with('title', '生活點滴 - Hsuan\'s Blog');
  }

  public function index() {
    $asset = $this->asset->addCSS('/asset/css/site/Article/list.css');

    return $this->view->setPath('site/articles.php')
                      ->with('asset', $asset);
  }

  public function detail() {
    $asset = $this->asset->addCSS('/asset/css/site/Article/index.css');

    return $this->view->setPath('site/article.php')
                      ->with('asset', $asset);
  }
}