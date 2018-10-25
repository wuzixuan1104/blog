<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;
use AdminFormSelect as FormSelect;
use AdminFormSwitcher as FormSwitcher;
use AdminFormTextarea as FormTextarea;

echo $form->back();

echo $form->form(function($obj) {

  FormSwitcher::create('開關', 'enable')
    ->on(\M\Article::ENABLE_YES)
    ->off(\M\Article::ENABLE_NO)
    ->val($obj->enable);

  FormSelect::create('類型', 'type')
    ->items(\M\Article::TYPE)
    ->need()
    ->val($obj->type);

  FormInput::create('標題', 'title')
    ->need()
    ->val($obj->title);
  
  FormTextarea::create('標籤', 'tags')
    ->placeholder('格式：#tag')
    ->val(implode('', array_map(function($tag) { return '#' . $tag->tag->name . '  '; }, $obj->tags)));

  FormTextarea::create('參考資料', 'references')
    ->placeholder('格式：DEMO - https://www.blog.tw (換行)')
    ->val(implode("\r\n", array_map(function($ref) { return $ref->name . ' - ' . $ref->url; }, $obj->refs)));

  FormTextarea::create('敘述', 'desc')
    ->placeholder('請輸入簡短敘述')
    ->val($obj->desc);

  FormTextarea::create('內容', 'content')
    ->type('ckeditor')
    ->val($obj->content);

});