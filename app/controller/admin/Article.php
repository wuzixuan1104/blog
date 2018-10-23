<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Article extends AdminCrudController {
  private $ignoreIds;
  
  public function __construct() {
    parent::__construct();

    wtfTo('AdminArticleIndex');

    if (in_array(Router::methodName(), ['show', 'edit', 'update']))
      if (!$this->obj = \M\Article::one('id = ?', Router::params('id')))
        error('找不到資料！');

    $this->view->with('title', '文章列表')
               ->with('currentUrl', Url::toRouter('AdminArticleIndex'));
  }

  public function index() {
    $list = AdminList::create('\M\Article')
              ->setAddUrl(Url::toRouter('AdminArticleAdd'));

    \M\AdminAction::read('讀取文章列表');
    return $this->view->with('list', $list);
  }
  
  public function add() {
    $form = AdminForm::create()
                     ->setActionUrl(Url::toRouter('AdminArticleCreate'))
                     ->setBackUrl(Url::toRouter('AdminArticleIndex'));

    \M\AdminAction::read('準備新增文章');
    return $this->view->with('form', $form);
  }
  
  public function create() {
    
  }
  
  public function edit() {
   
  }
  
  public function update() {
    
  }
  
  public function show() {
    
  }
  
  public function delete() {
   
  }

  public function enable() {

  }

}
