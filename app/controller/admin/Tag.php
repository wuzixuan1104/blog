<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Tag extends AdminCrudController {
  
  public function __construct() {
    parent::__construct();

    wtfTo('AdminArticleIndex');

    if (in_array(Router::methodName(), ['show', 'edit', 'update', 'delete', 'enable']))
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
                     ->setActionUrl(Url::toRouter('AdminTagCreate'))
                     ->setBackUrl(Url::toRouter('AdminTagIndex'));

    \M\AdminAction::read('準備新增文章');
    return $this->view->with('form', $form);
  }
  
  public function create() {
    wtfTo('AdminArticleAdd');
    $params = Input::post();
    $params['content'] = Input::post('content', false);
   
    validator(function() use (&$params, &$extras) {
      Validator::need($params, 'enable', '開關')->inEnum(\M\Article::ENABLE);
      Validator::need($params, 'type', '類型')->inEnum(\M\Article::TYPE);
      Validator::need($params, 'title', '標題')->isVarchar(190);
      Validator::maybe($params, 'tags', '標籤')->isText();
      Validator::maybe($params, 'references', '參考資料')->isText();
      Validator::need($params, 'desc', '敘述')->isText();
      Validator::need($params, 'content', '內容')->isStr()->trim();

      $extras = [];
      if($params['tags']) 
        ($extras['tags'] = \M\ArticleTag::checkFormat($params)) || error('標籤格式有誤');
        
      if($params['references']) 
        ($extras['references'] = \M\ArticleRef::checkFormat($params)) || error('參考資料格式有誤');
    });
      
    transaction(function() use ($params, $extras) {
      if(!$obj = \M\Article::create($params))
        return false;

      if(isset($extras['tags']) && $extras['tags'] && !(\M\ArticleTag::multiCreate($obj->id, $extras['tags']))) 
        return false;
      if(isset($extras['references']) && $extras['references'] && !(\M\ArticleRef::multiCreate($obj->id, $extras['references'])))
        return false;

      return true;
    }); 
    
    Url::refreshWithSuccessFlash(Url::toRouter('AdminArticleIndex'), '新增成功！');
  }
  
  public function edit() {
    $form = AdminForm::create($this->obj)
                     ->setActionUrl(Url::toRouter('AdminArticleUpdate', $this->obj))
                     ->setBackUrl(Url::toRouter('AdminArticleIndex'));
    
    \M\AdminAction::read('準備修改文章', '準備修改文章「' . $this->obj->title . '(' . $this->obj->id . ')' . '」');
  
    return $this->view->with('form', $form);
  }
  
  public function update() {
    wtfTo('AdminArticleEdit', $this->obj);

    $params = Input::post();
    $params['content'] = Input::post('content', false);

    validator(function() use (&$params, &$extras) {
      Validator::need($params, 'enable', '開關')->inEnum(\M\Article::ENABLE);
      Validator::need($params, 'type', '類型')->inEnum(\M\Article::TYPE);
      Validator::need($params, 'title', '標題')->isVarchar(190);
      Validator::maybe($params, 'tags', '標籤')->isText();
      Validator::maybe($params, 'references', '參考資料')->isText();
      Validator::need($params, 'desc', '敘述')->isText();
      Validator::need($params, 'content', '內容')->isStr()->trim();

      $extras = ['tags' => [], 'references' => []];
      if($params['tags']) 
        ($extras['tags'] = \M\ArticleTag::checkFormat($params)) || error('標籤格式有誤');
        
      if($params['references']) 
        ($extras['references'] = \M\ArticleRef::checkFormat($params)) || error('參考資料格式有誤');
    });

    transaction(function() use (&$params, &$extras) {
      if (!($this->obj->columnsUpdate($params) && $this->obj->save()))
        return false;

      $oris = arrayColumn($this->obj->tags, 'tagId');
      $dels = array_diff($oris, $extras['tags']);
      $adds = array_diff($extras['tags'], $oris);
    
      foreach ($dels as $del)
        if ($artiTag = \M\ArticleTag::one('articleId = ? and tagId = ?', $this->obj->id, $del))
          if (!$artiTag->delete())
            return false;

      foreach ($adds as $add)
        if (!\M\ArticleTag::create(['articleId' => $this->obj->id, 'tagId' => $add]))
          return false;

      if(\M\ArticleRef::deleteAll('articleId = ?', $this->obj->id) && $extras['references'] && !(\M\ArticleRef::multiCreate($this->obj->id, $extras['references']))) 
        return false;

      \M\AdminAction::write('修改文章', '修改文章「' . $this->obj->title . '(' . $this->obj->id . ')' . '」');
      return true;
    });
    
    Url::refreshWithSuccessFlash(Url::toRouter('AdminArticleIndex'), '修改成功！');
  }
  
  public function show() {
    $show = AdminShow::create($this->obj)
                     ->setBackUrl(Url::toRouter('AdminArticleIndex'), '回列表');
    \M\AdminAction::read('查看文章詳細內容');

    return $this->view->with('show', $show);
  }
  
  public function delete() {
    wtfTo('AdminArticleIndex');
    
    transaction(function() {
      \M\AdminAction::write('刪除文章', '刪除文章「' . $this->obj->title . '(' . $this->obj->id . ')' . '」');
      return $this->obj->delete();
    });

    Url::refreshWithSuccessFlash(Url::toRouter('AdminArticleIndex'), '刪除成功！');
  }

  public function enable() {
    wtf(function() {
      return ['messages' => func_get_args()];
    });

    $params = Input::post();
    
    validator(function() use (&$params) {
      Validator::need($params, 'enable', '開關')->inEnum(\M\Article::ENABLE);
    });
    
    transaction(function() use (&$params) {
      \M\AdminAction::write('調整文章狀態', '設定文章「' . $this->obj->title . '(' . $this->obj->id . ')」的開啟狀態，將其設為「' . \M\Article::ENABLE[$params['enable']] . '」');
      return $this->obj->columnsUpdate($params) && $this->obj->save();
    });

    return $params;
  }

}
