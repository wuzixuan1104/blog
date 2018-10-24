<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Article extends AdminCrudController {
  private $ignoreIds;
  
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
                     ->setActionUrl(Url::toRouter('AdminArticleCreate'))
                     ->setBackUrl(Url::toRouter('AdminArticleIndex'));

    \M\AdminAction::read('準備新增文章');
    return $this->view->with('form', $form);
  }
  
  public function create() {
    wtfTo('AdminArticleAdd');
    $params = Input::post();
   
    validator(function() use (&$params, &$extras) {
      Validator::need($params, 'enable', '開關')->inEnum(\M\Article::ENABLE);
      Validator::need($params, 'type', '類型')->inEnum(\M\Article::TYPE);
      Validator::need($params, 'title', '標題')->isVarchar(190);
      Validator::maybe($params, 'tags', '標籤')->isText();
      Validator::maybe($params, 'references', '參考資料')->isText();
      Validator::need($params, 'desc', '敘述')->isText();
      Validator::need($params, 'content', '內容')->isText();

      $extras = [];
      if(isset($params['tags'])) {
        preg_match_all("/#\s*(?P<name>[^#\n]+)/", $params['tags'], $matches);

        ($tags = \M\Tag::all()) && ($ids = arrayColumn($tags, 'id')) && ($names = arrayColumn($tags, 'name'));
        foreach($matches['name'] as $k => $t) {
          if(false === ($key = array_search(trim($t), $names)))
            error('尚未新增 #' . $t . ' 請至標籤設定新增');
          $extras['tags'][$k] = $ids[$key];
        }
      }

      if(isset($params['references'])) {
        preg_match_all("/\s*(?P<title>[^-]+)\s*-\s*(?P<href>[^\n]+)/", $params['references'], $matches);
        $matches['title'] && ($extras['references']['title'] = $matches['title']) && ($extras['references']['href'] = $matches['href']);
      }
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
   
  }
  
  public function update() {
    
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
