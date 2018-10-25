<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;

echo $form->back();

echo $form->form(function($parent) {
  FormInput::create('標題', 'name')
    ->need();

  FormInput::create('連結', 'url')
    ->need();
    
});