<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Me extends AdminCrudController {
  
  public function __construct() {
    parent::__construct();

    wtfTo('AdminMeIndex');

    if (in_array(Router::methodName(), ['edit', 'update', 'delete']))
      if (!$this->obj = \M\Me::one('id = ?', Router::params('id')))
        error('找不到資料！');

    $this->view->with('title', '我的列表')
               ->with('currentUrl', Url::toRouter('AdminMeIndex'));
  }

  public function index() {
    $list = AdminList::create('\M\Me')
              ->setAddUrl(Url::toRouter('AdminMeAdd'));

    \M\AdminAction::read('讀取我的列表');
    return $this->view->with('list', $list);
  }
  
  public function add() {
    $form = AdminForm::create()
                     ->setActionUrl(Url::toRouter('AdminMeCreate'))
                     ->setBackUrl(Url::toRouter('AdminMeIndex'));

    \M\AdminAction::read('準備新增自己');
    return $this->view->with('form', $form);
  }

  public function create() {
    wtfto('AdminMeAdd');

    $files = Input:: file();
    $params = Input::post();
    $params['content'] = Input::post('content', false);

    validator(function() use (&$params, &$files) {
      Validator::need($params, 'name', '姓名')->isVarchar(190);
      Validator::need($params, 'title', '標語')->isVarchar(190);
      Validator::need($params, 'github', 'GitHub')->isVarchar(190);
      Validator::need($params, 'slogan', '標語')->isText();
      Validator::need($params, 'content', '內容')->isText();
      Validator::need($files, 'avatar', '頭像')->isUploadFile(config('upload', 'picture'));
      Validator::maybe($files, 'cover', '封面')->isUploadFile(config('upload', 'picture'));
    });

    transaction(function() use ($params, $files) {
      if(!$obj = \M\Me::create($params))
        return false;

      if(!$obj->putFiles($files))
        return false;
      return true;
    });

    Url::refreshWithSuccessFlash(Url::toRouter('AdminMeIndex'), '新增成功！');
  }

  public function edit() {
    $form = AdminForm::create($this->obj)
                    ->setActionUrl(Url::toRouter('AdminMeUpdate', $this->obj))
                    ->setBackUrl(Url::toRouter('AdminMeIndex'));

    \M\AdminAction::read('準備修改我的資料');
    return $this->view->with('form', $form);
  }
  
  public function update() {
    wtfTo('AdminMeEdit', $this->obj);

    $params = Input::post();
    $files = Input::file();

    validator(function() use (&$params, &$files) {
      Validator::need($params, 'name', '名稱')->isVarchar(190);
      Validator::need($params, 'title', '名稱')->isVarchar(190);
      Validator::need($params, 'github', '名稱')->isVarchar(190);
      Validator::need($params, 'slogan', '名稱')->isVarchar(190);
      Validator::need($params, 'content', '內容')->isText();
      Validator::maybe($files,  'avatar', '頭像')->isUploadFile(config('upload', 'picture'));
      Validator::maybe($files,  'cover', '封面')->isUploadFile(config('upload', 'picture'));
    });

    transaction(function() use (&$params, &$files) {
      \M\AdminAction::write('修改我的資料');

      if (!($this->obj->columnsUpdate($params) && $this->obj->save()))
        return false;

      if (!$this->obj->putFiles($files))
        return false;

      return true;
    });
    
    Url::refreshWithSuccessFlash(Url::toRouter('AdminMeIndex'), '修改成功！');
  }
  
  public function show() {
    $show = AdminShow::create($this->obj)
                     ->setBackUrl(Url::toRouter('AdminArticleIndex'), '回列表');
    \M\AdminAction::read('查看文章詳細內容');

    return $this->view->with('show', $show);
  }
  
  public function delete() {
    wtfTo('AdminMeIndex');
    
    transaction(function() {
      \M\AdminAction::write('刪除自介', '刪除自介「' . $this->obj->name . '(' . $this->obj->id . ')' . '」');
      return $this->obj->delete();
    });

    Url::refreshWithSuccessFlash(Url::toRouter('AdminMeIndex'), '刪除成功！');
  }
}
