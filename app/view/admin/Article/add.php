<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;
use AdminFormSelect as FormSelect;
use AdminFormSwitcher as FormSwitcher;
use AdminFormTextarea as FormTextarea;
use AdminFormImage as FormImage;

echo $form->back();

echo $form->form(function() {
  FormSwitcher::create('開關', 'enable')
    ->on(\M\Article::ENABLE_YES)
    ->off(\M\Article::ENABLE_NO)
    ->val(\M\Article::ENABLE_YES);

  FormSelect::create('類型', 'type')
    ->items(\M\Article::TYPE);

  FormInput::create('標題', 'title')
    ->need()
    ->focus();

  FormTextarea::create('標籤', 'tags')
    ->placeholder('格式：#tag');

  FormTextarea::create('參考資料', 'references')
    ->placeholder('格式：DEMO - https://www.blog.tw (換行)');

  FormImage::create('封面', 'cover')
    ->accept('image/*');

  FormTextarea::create('敘述', 'desc')
    ->need()
    ->placeholder('請輸入簡短敘述');

  FormTextarea::create('內容', 'content')
    ->need()
    ->type('ckeditor');

});