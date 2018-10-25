<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class ArticleRef extends AdminCrudController {
  
  public function __construct() {
    parent::__construct();

    wtfTo('AdminArticleIndex');
    $this->parent = \M\Article::one('id = ?', Router::params('articleId'));
    $this->parent || error('找不到資料！');

    if (in_array(Router::methodName(), ['show', 'edit', 'update', 'delete']))
      if (!$this->obj = \M\ArticleRef::one('id = ?', Router::params('id')))
        error('找不到資料！');

    wtfTo('AdminArticleRefIndex', $this->parent);

    $this->view->with('title', ['參考資料列表', $this->parent->title])
               ->with('currentUrl', Url::toRouter('AdminArticleIndex'))
               ->with('parent', $this->parent);
  }

  public function index() {
    $list = AdminList::create('\M\ArticleRef', ['order' => AdminListOrder::desc('createAt'), 'where' => ['articleId = ?', $this->parent->id]])
              ->setAddUrl(Url::toRouter('AdminArticleRefAdd', $this->parent));
    
    $show = AdminShow::create($this->parent)
                     ->setBackUrl(Url::toRouter('AdminArticleShow', $this->parent), '回內容頁');
   
    \M\AdminAction::read('讀取文章參考資料列表', '讀取文章「' . $this->parent->title . '(' . $this->parent->id . ')」中的參考資料列表');

    return $this->view->with('list', $list)
                      ->with('show', $show);
  }
  
  public function add() {
    $form = AdminForm::create()
                     ->setActionUrl(Url::toRouter('AdminArticleRefCreate', $this->parent))
                     ->setBackUrl(Url::toRouter('AdminArticleRefIndex', $this->parent));

    \M\AdminAction::read('準備新增文章標籤');
    return $this->view->with('form', $form);
  }
  
  public function create() {
    wtfTo('AdminArticleRefAdd', $this->parent);
    $params = Input::post();

    validator(function() use (&$params) {
      Validator::need($params, 'name', '設為主要')->isVarchar(190);
      Validator::need($params, 'url', '連結')->isUrl();
    });

    transaction(function() use ($params) {
      if(!$obj = \M\ArticleRef::create(array_merge($params, ['articleId' => $this->parent->id])))
        return false;
      return true;
    }); 
    
    Url::refreshWithSuccessFlash(Url::toRouter('AdminArticleRefIndex', $this->parent), '新增成功！');
  }
  
  public function edit() {
    $form = AdminForm::create($this->obj)
                    ->setActionUrl(Url::toRouter('AdminArticleRefUpdate', $this->parent, $this->obj))
                    ->setBackUrl(Url::toRouter('AdminArticleRefIndex', $this->parent));

    \M\AdminAction::read('準備修改參考資料', '準備修改文章「' . $this->parent->title . '(' . $this->parent->id . ')' . '」中的參考資料「' . $this->obj->name . '(' . $this->obj->id . ')」');
    return $this->view->with('form', $form);
  } 

  public function update() {
    wtfTo('AdminArticleRefEdit', $this->parent, $this->obj);

    $params = Input::post();

    validator(function() use (&$params) {
      Validator::need($params, 'name', '設為主要')->isVarchar(190);
      Validator::need($params, 'url', '連結')->isUrl();
    });

    transaction(function() use (&$params) {
      \M\AdminAction::write('修改參考資料', '修改文章「' . $this->parent->title . '(' . $this->parent->id . ')' . '」中的參考資料「' . $this->obj->name . '(' . $this->obj->id . ')」');
      return $this->obj->columnsUpdate($params) && $this->obj->save();
    });
    
    Url::refreshWithSuccessFlash(Url::toRouter('AdminArticleRefIndex', $this->parent), '修改成功！');
  }
  
  public function delete() {
    wtfTo('AdminArticleRefIndex', $this->parent);
    
    transaction(function() {
      \M\AdminAction::write('刪除文章參考資料', '刪除文章「' . $this->parent->title . '(' . $this->parent->id . ')' . '」中的參考資料「' . $this->obj->name . '(' . $this->obj->id . ')」');
      return $this->obj->delete();
    });

    Url::refreshWithSuccessFlash(Url::toRouter('AdminArticleRefIndex', $this->parent), '刪除成功！');
  }
}
