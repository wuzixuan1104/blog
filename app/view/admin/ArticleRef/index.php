<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminListSearchInput as SearchInput;
use AdminListSearchCheckbox as SearchCheckbox;
use AdminListSearchSelect as SearchSelect;

use AdminListSwitcher as ListSwitcher;
use AdminListText as ListText;
use AdminListCtrl as ListCtrl;
use AdminListItems as ListItems;


echo $show->back();

echo $list->search(function() {
  SearchInput::create('ID')
    ->sql('id = ?');

  SearchInput::create('標題')
    ->sql('name LIKE ?');

  SearchInput::create('連結')
    ->sql('url LIKE ?');
  });

echo $list->table(function($obj) use ($parent) {

  ListText::create('ID')
    ->content($obj->id)
    ->width(60)
    ->order('id');

  ListText::create('文章標題')
    ->content(Url::toRouterHyperlink('AdminArticleShow', $obj->article->id)->text($obj->article->title)->target('_blank'))
    ->width(200);

  ListText::create('標題')
    ->content($obj->name)
    ->width(150);

  ListText::create('連結')
    ->content($obj->url);

  ListText::create('新增時間')
    ->content($obj->createAt)
    ->width(150);

  ListCtrl::create()
    ->addEdit('AdminArticleRefEdit', $parent, $obj)
    ->addDelete('AdminArticleRefDelete', $parent, $obj);
});

echo $list->pages();
