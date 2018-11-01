<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Dev extends SiteController {
  public function __construct() {
    parent::__construct();

    $this->view->with('title', '開發心得 - Hsuan\'s Blog');
  }

  public function index() {
    $asset = $this->asset->addCSS('/asset/css/site/Article/list.css');

    return $this->view->setPath('site/articles.php')
                      ->with('title', '開發心得 - Hsuan\'s Blog')
                      ->with('asset', $asset)
                      ->with('objs', \M\Article::all(['where' => ['enable = ? and type = ?', \M\Article::ENABLE_YES, \M\Article::TYPE_DEV], 'order' => 'createAt DESC']));
  }

  public function show() {
    $asset = $this->asset->addCSS('/asset/css/site/Article/index.css');
    $obj = \M\Article::one('id = ? and type = ? and enable = ?', Router::params('id'), \M\Article::TYPE_DEV, \M\Article::ENABLE_YES);
    
    return $this->view->setPath('site/article.php')
                      ->with('title', $obj->title . ' - Hsuan\'s Blog')
                      ->with('asset', $asset)
                      ->with('obj', $obj)
                      ->with('hots', \M\Article::all([ 'where' => ['type = ? and enable = ?', \M\Article::TYPE_DEV, \M\Article::ENABLE_YES], 'order' => 'cntPv DESC', 'limit' => 4]));
  }
}
