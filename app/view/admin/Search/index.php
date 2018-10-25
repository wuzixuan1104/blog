<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminListSearchInput as SearchInput;

use AdminListText as ListText;

echo $list->search(function() {
  
  SearchInput::create('ID')
    ->sql('id = ?');

  SearchInput::create('關鍵字')
    ->sql('keyword LIKE ?');
});

echo $list->table(function($obj) {

  ListText::create('ID')
    ->content($obj->id)
    ->width(60)
    ->order('id');

  ListText::create('關鍵字')
    ->content($obj->keyword)
    ->order('keyword');

  ListText::create('新增時間')
    ->content($obj->createAt)
    ->width(150);
});

echo $list->pages();
