<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;
use AdminFormSelect as FormSelect;

echo $form->back();

echo $form->form(function($obj) {
  FormInput::create('名稱', 'name')
    ->need()
    ->val($obj->name);

  FormSelect::create('顏色', 'color')
    ->items(\M\Tag::COLOR)
    ->val($obj->color);
});