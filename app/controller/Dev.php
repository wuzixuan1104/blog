<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Dev extends SiteController {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    wtfto('DevIndex');

    $where = Where::create(['enable = ? and type = ?', \M\Article::ENABLE_YES, \M\Article::TYPE_DEV]);
    
    $params = Input::get();

    validator(function() use (&$params) {
      Validator::maybe($params, 'offset', '位移', 0)->isNum()->trim()->stripTags()->greaterEqual(0);
      Validator::maybe($params, 'limit',  '長度', 10)->isNum()->trim()->stripTags()->greaterEqual(0);
      Validator::maybe($params, 'keyword',  '關鍵字')->trim()->stripTags()->isText();
    });

    if(isset($params['keyword'])) {
      $where->and('title LIKE ? or `desc` LIKE ?', '%' . $params['keyword'] . '%', '%' . $params['keyword'] . '%');
      $this->view->with('keyword', $params['keyword']) && \M\SearchLog::create(['keyword' => $params['keyword']]);
    }

    $asset = $this->asset->addCSS('/asset/css/site/Article/list.css');

    return $this->view->setPath('site/articles.php')
                      ->with('title', (isset($params['keyword']) ? '搜尋結果' : '開發心得') . ' - Hsuan\'s Blog')
                      ->with('asset', $asset)
                      ->with('objs', \M\Article::all(['where' => $where, 'order' => 'createAt DESC', 'offset' => $params['offset'] * 10, 'limit' => $params['limit']]));
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
