<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Tag extends AdminCrudController {
  
  public function __construct() {
    parent::__construct();

    wtfTo('AdminTagIndex');

    if (in_array(Router::methodName(), ['edit', 'update', 'delete']))
      if (!$this->obj = \M\Tag::one('id = ?', Router::params('id')))
        error('找不到資料！');

    $this->view->with('title', '標籤列表')
               ->with('currentUrl', Url::toRouter('AdminTagIndex'));
  }

  public function index() {
    $list = AdminList::create('\M\Tag')
              ->setAddUrl(Url::toRouter('AdminTagAdd'));

    \M\AdminAction::read('讀取標籤列表');
    return $this->view->with('list', $list);
  }
  
  public function add() {
    $form = AdminForm::create()
                     ->setActionUrl(Url::toRouter('AdminTagCreate'))
                     ->setBackUrl(Url::toRouter('AdminTagIndex'));

    \M\AdminAction::read('準備新增文章');
    return $this->view->with('form', $form);
  }
  
  public function create() {
    wtfTo('AdminTagAdd');
    $params = Input::post();

    validator(function() use (&$params) {
      Validator::need($params, 'name', '名稱')->isVarchar(190);
      Validator::need($params, 'color', '顏色')->isVarchar(50);
    });

    transaction(function() use ($params) {
      if(!$obj = \M\Tag::create($params))
        return false;
      return true;
    }); 
    
    Url::refreshWithSuccessFlash(Url::toRouter('AdminTagIndex'), '新增成功！');
  }
  
  public function edit() {
    $form = AdminForm::create($this->obj)
                    ->setActionUrl(Url::toRouter('AdminTagUpdate', $this->obj))
                    ->setBackUrl(Url::toRouter('AdminTagIndex'));

    \M\AdminAction::read('準備修改標籤', '準備修改標籤「' . $this->obj->name . '」');
    return $this->view->with('form', $form);
  }
  
  public function update() {
     wtfTo('AdminTagEdit', $this->obj);

    $params = Input::post();

    validator(function() use (&$params) {
      Validator::need($params, 'name', '名稱')->isVarchar(190);
      Validator::need($params, 'color', '顏色')->isVarchar(50);
    });


    transaction(function() use (&$params) {
      \M\AdminAction::write('修改標籤', '修改標籤「' . $this->obj->name . '」');
      return $this->obj->columnsUpdate($params) && $this->obj->save();
    });
    
    Url::refreshWithSuccessFlash(Url::toRouter('AdminTagIndex'), '修改成功！');
  }
  
  public function show() {
    $show = AdminShow::create($this->obj)
                     ->setBackUrl(Url::toRouter('AdminArticleIndex'), '回列表');
    \M\AdminAction::read('查看文章詳細內容');

    return $this->view->with('show', $show);
  }
  
  public function delete() {
    wtfTo('AdminTagIndex');
    
    transaction(function() {
      \M\AdminAction::write('刪除標籤', '刪除標籤「' . $this->obj->name . '(' . $this->obj->id . ')' . '」');
      return $this->obj->delete();
    });

    Url::refreshWithSuccessFlash(Url::toRouter('AdminTagIndex'), '刪除成功！');
  }
}
