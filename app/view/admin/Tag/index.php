<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminListSearchInput as SearchInput;
use AdminListSearchSelect as SearchSelect;

use AdminListText as ListText;
use AdminListCtrl as ListCtrl;

echo $list->search(function() {
  
  SearchInput::create('ID')
    ->sql('id = ?');

  SearchInput::create('名稱')
    ->sql('name LIKE ?');

  SearchSelect::create('顏色')
    ->sql('color = ?')
    ->items(\M\Tag::COLOR);
});

echo $list->table(function($obj) {

  ListText::create('ID')
    ->content($obj->id)
    ->width(60)
    ->order('id');

  ListText::create('名稱')
    ->content($obj->name)
    ->order('name');

  ListText::create('顏色')
    ->content(\M\Tag::COLOR[$obj->color])
    ->order('color')
    ->width(100);

  ListText::create('新增時間')
    ->content($obj->createAt)
    ->width(150);

  ListCtrl::create()
    ->addEdit('AdminTagEdit', $obj)
    ->addDelete('AdminTagDelete', $obj);
});

echo $list->pages();
