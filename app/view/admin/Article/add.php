<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;
use AdminFormSelect as FormSelect;
use AdminFormSwitcher as FormSwitcher;
use AdminFormTextarea as FormTextarea;

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

  FormTextarea::create('敘述', 'desc')
    ->placeholder('請輸入簡短敘述');

  FormTextarea::create('內容', 'content')
    ->type('ckeditor');
});