<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Search extends AdminCrudController {
  
  public function __construct() {
    parent::__construct();

    wtfTo('AdminSearchIndex');

    $this->view->with('title', '搜尋列表')
               ->with('currentUrl', Url::toRouter('AdminSearchIndex'));
  }

  public function index() {
    $list = AdminList::create('\M\SearchLog');

    \M\AdminAction::read('讀取搜尋紀錄列表');
    return $this->view->with('list', $list);
  }
}
