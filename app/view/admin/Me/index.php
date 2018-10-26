<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminListText as ListText;
use AdminListCtrl as ListCtrl;
use AdminListImage as ListImage;

echo $list->table(function($obj) {

  ListImage::create('頭像')
    ->content($obj->avatar)
    ->width(50);

  ListImage::create('封面')
    ->content($obj->cover)
    ->width(50);

  ListText::create('名稱')
    ->content($obj->name)
    ->width(100);

  ListText::create('標題')
    ->content($obj->title)
    ->width(100);

  ListText::create('標語')
    ->content($obj->slogan)
    ->width(150);

  ListText::create('新增時間')
    ->content($obj->createAt)
    ->width(150);

  ListText::create('更新時間')
    ->content($obj->updateAt)
    ->width(150);

  ListCtrl::create()
    ->addEdit('AdminMeEdit', $obj);
});

echo $list->pages();
