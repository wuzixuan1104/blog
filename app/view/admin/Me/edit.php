<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;
use AdminFormImage as FormImage;
use AdminFormTextarea as FormTextarea;
use AdminFormCheckbox as FormCheckbox;

echo $form->back();

echo $form->form(function($obj) {

  FormInput::create('名稱', 'name')
    ->need()
    ->focus()
    ->val($obj->name);

  FormInput::create('標題', 'title')
    ->need()
    ->val($obj->title);

  FormInput::create('GitHub', 'github')
    ->need()
    ->val($obj->github);

  FormInput::create('標語', 'slogan')
    ->need()
    ->val($obj->slogan);

  FormTextarea::create('內容', 'content')
    ->need()
    ->val($obj->content);

  FormImage::create('頭像', 'avatar')
    ->need()
    ->accept('image/*')
    ->val($obj->avatar);

  FormImage::create('封面', 'cover')
    ->need()
    ->accept('image/*')
    ->val($obj->cover);

});