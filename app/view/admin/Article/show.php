<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminShowText as ShowText;
use AdminShowTextarea as ShowTextarea;
use AdminShowCkeditor as ShowCkeditor;
use AdminShowItems as ShowItems;
use AdminShowImage as ShowImage;

echo $show->back();

echo $show->panel(function($obj, &$title) {

  ShowText::create('ID')
    ->content($obj->id);

  ShowText::create('開關')
    ->content(\M\Article::ENABLE[$obj->enable]);

  ShowText::create('標題')
    ->content($obj->title);

  ShowText::create('類型')
    ->content(\M\Article::TYPE[$obj->type]);
  
  ShowItems::create('標籤')
    ->content(array_map(function($v) { return $v->tag->name; }, $obj->tags));

  ShowImage::create('封面')
    ->content($obj->cover);

  ShowTextarea::create('敘述')
    ->content($obj->desc);
    
  ShowCkeditor::create('內容')
    ->content($obj->content);
    
  ShowText::create('新增時間')
    ->content($obj->createAt);

  ShowText::create('更新時間')
    ->content($obj->updateAt);
});

echo $show->panel(function($obj, &$title) {
  $title = '參考資料';

  foreach ($obj->refs as $ref)
    ShowText::create($ref->name)->content($ref->url);
});

echo $show->panel(function($obj, &$title) {
  $title = '數據資料';

  ShowText::create('瀏覽數')
    ->content(number_format($obj->cntPv) . ' 次');
    
  ShowText::create('搜尋數')
    ->content(number_format($obj->cntSearch) . ' 次');
});