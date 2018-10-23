<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminListSearchInput as SearchInput;
use AdminListSearchCheckbox as SearchCheckbox;
use AdminListSearchSelect as SearchSelect;

use AdminListSwitcher as ListSwitcher;
use AdminListText as ListText;
use AdminListCtrl as ListCtrl;
use AdminListItems as ListItems;

echo $list->search(function() {
  
  SearchInput::create('ID')
    ->sql('id = ?');

  SearchInput::create('標題')
    ->sql('title LIKE ?');

  SearchSelect::create('類型')
    ->items(\M\Article::TYPE);

  SearchSelect::create('開關')
    ->items(\M\Article::ENABLE);

});

echo $list->table(function($obj) {

  ListSwitcher::create('開關')
    ->on(\M\Article::ENABLE_YES)
    ->off(\M\Article::ENABLE_NO)
    ->url(Url::toRouter('AdminArticleEnable', $obj))
    ->column('enable');

  ListText::create('ID')
    ->content($obj->id)
    ->width(60)
    ->order('id');

  ListText::create('類型')
    ->content(\M\Article::TYPE[$obj->type])
    ->width(100);

  ListText::create('標題')
    ->content($obj->title)
    ->order('title');

  // ListItems::create('標籤')
  //   ->content(array_map(function($role) { return \M\Article::ROLE[$role->role]; }, $obj))
  //   ->width(200);

  ListText::create('瀏覽數')
    ->content(number_format(count($obj->cntPv)) . '次')
    ->width(100);

  ListText::create('搜尋數')
    ->content(number_format(count($obj->cntSearch)) . '次')
    ->width(100);

  ListText::create('新增時間')
    ->content($obj->createAt)
    ->width(150);

  ListCtrl::create()
    ->addShow('AdminAdminShow', $obj)
    ->addEdit('AdminAdminEdit', $obj)
    ->addDelete('AdminAdminDelete', $obj);
});

echo $list->pages();
