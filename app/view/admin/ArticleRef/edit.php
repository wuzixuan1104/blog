<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;

echo $form->back();

echo $form->form(function($obj) {
  FormInput::create('標題', 'name')
    ->need()
    ->val($obj->name);

  FormInput::create('連結', 'url')
    ->need()
    ->val($obj->url);
    
});