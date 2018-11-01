<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Life extends SiteController {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $where = Where::create(['enable = ? and type = ?', \M\Article::ENABLE_YES, \M\Article::TYPE_LIFE]);
    
    $q = Input::get('keyword');
    $q && $where->and('title LIKE ?', '%' . $q . '%');
    $q && $this->view->with('keyword', $q) && \M\SearchLog::create(['keyword' => $q]);
 
    $asset = $this->asset->addCSS('/asset/css/site/Article/list.css');

    return $this->view->setPath('site/articles.php')
                      ->with('title', '生活點滴 - Hsuan\'s Blog')
                      ->with('asset', $asset)
                      ->with('objs', \M\Article::all(['where' => $where, 'order' => 'createAt DESC']));
  }

  public function show() {
    $asset = $this->asset->addCSS('/asset/css/site/Article/index.css');
    $obj = \M\Article::one('id = ? and type = ? and enable = ?', Router::params('id'), \M\Article::TYPE_LIFE, \M\Article::ENABLE_YES);

    return $this->view->setPath('site/article.php')
                      ->with('title', $obj->title . ' - Hsuan\'s Blog')
                      ->with('asset', $asset)
                      ->with('obj', $obj)
                      ->with('hots', \M\Article::all([ 'where' => ['type = ? and enable = ?', \M\Article::TYPE_LIFE, \M\Article::ENABLE_YES], 'order' => 'cntPv DESC', 'limit' => 4]));
  }
}