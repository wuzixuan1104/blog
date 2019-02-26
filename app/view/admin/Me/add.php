<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;
use AdminFormSelect as FormSelect;
use AdminFormTextarea as FormTextarea;
use AdminFormImage as FormImage;

echo $form->back();

echo $form->form(function() {

  FormInput::create('名稱', 'name')
    ->need()
    ->focus();

  FormInput::create('標題', 'title')
    ->need();

  FormInput::create('GitHub', 'github')
    ->need();

  FormInput::create('標語', 'slogan')
    ->need();

  FormTextarea::create('內容', 'content')
    ->need();

  FormImage::create('頭像', 'avatar')
    ->need()
    ->accept('image/*');

  FormImage::create('封面', 'cover')
    ->need()
    ->accept('image/*');

});