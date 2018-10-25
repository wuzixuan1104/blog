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

  SearchSelect::create('主要標籤')
    ->sql('main = ?')
    ->items(\M\ArticleTag::MAIN);
});

echo $list->table(function($obj) use ($parent) {

  ListText::create('ID')
    ->content($obj->id)
    ->width(60)
    ->order('id');

  ListText::create('標籤')
    ->content(Url::toRouterHyperlink('AdminTagIndex')->text($obj->tag->name)->target('_blank'))
    ->width(100);

  ListText::create('文章標題')
    ->content(Url::toRouterHyperlink('AdminArticleShow', $obj->article->id)->text($obj->article->title)->target('_blank'));

  ListText::create('主要顯示')
    ->content(\M\ArticleTag::MAIN[$obj->main])
    ->width(100);

  ListText::create('新增時間')
    ->content($obj->createAt)
    ->width(150);

  ListCtrl::create()
    ->addDelete('AdminArticleTagDelete', $parent, $obj);
});

echo $list->pages();
