<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class ArticleTag extends AdminCrudController {
  
  public function __construct() {
    parent::__construct();

    wtfTo('AdminArticleIndex');
    $this->parent = \M\Article::one('id = ?', Router::params('articleId'));
    $this->parent || error('找不到資料！');

    if (in_array(Router::methodName(), ['show', 'edit', 'update', 'delete']))
      if (!$this->obj = \M\ArticleTag::one('id = ?', Router::params('id')))
        error('找不到資料！');

    wtfTo('AdminArticleTagIndex', $this->parent);

    $this->view->with('title', ['文章列表', $this->parent->title])
               ->with('currentUrl', Url::toRouter('AdminArticleIndex'))
               ->with('parent', $this->parent);
  }

  public function index() {
    $list = AdminList::create('\M\ArticleTag', ['order' => AdminListOrder::desc('createAt'), 'where' => ['articleId = ?', $this->parent->id]])
              ->setAddUrl(Url::toRouter('AdminArticleTagAdd', $this->parent));
    
    $show = AdminShow::create($this->parent)
                     ->setBackUrl(Url::toRouter('AdminArticleShow', $this->parent), '回內容頁');
   
    \M\AdminAction::read('讀取文章標籤列表', '讀取文章「' . $this->parent->title . '(' . $this->parent->id . ')」中的標籤列表');
    return $this->view->with('list', $list)
                      ->with('show', $show);
  }
  
  public function add() {
    $form = AdminForm::create()
                     ->setActionUrl(Url::toRouter('AdminArticleTagCreate', $this->parent))
                     ->setBackUrl(Url::toRouter('AdminArticleTagIndex', $this->parent));

    \M\AdminAction::read('準備新增文章標籤');
    return $this->view->with('form', $form);
  }
  
  public function create() {
    wtfTo('AdminArticleTagAdd', $this->parent);
    $params = Input::post();

    validator(function() use (&$params) {
      Validator::need($params, 'main', '設為主要')->inEnum(\M\ArticleTag::MAIN);
      Validator::need($params, 'tag', '標籤')->isId();

      if(\M\ArticleTag::one('tagId = ? and articleId = ?', $params['tag'], $this->parent->id))
        error('此標籤已新增過了');
    });

    transaction(function() use ($params) {
      if(!$obj = \M\ArticleTag::create(['articleId' => $this->parent->id, 'tagId' => $params['tag'], 'main' => $params['main']]))
        return false;
      return true;
    }); 
    
    Url::refreshWithSuccessFlash(Url::toRouter('AdminArticleTagIndex', $this->parent), '新增成功！');
  }
  
  
  public function delete() {
    wtfTo('AdminArticleTagIndex', $this->parent);
    
    transaction(function() {
      \M\AdminAction::write('刪除文章標籤', '刪除文章「' . $this->parent->title . '(' . $this->parent->id . ')' . '」中的標籤「' . $this->obj->tag->name . '(' . $this->obj->id . ')」');
      return $this->obj->delete();
    });

    Url::refreshWithSuccessFlash(Url::toRouter('AdminArticleTagIndex', $this->parent), '刪除成功！');
  }
}
