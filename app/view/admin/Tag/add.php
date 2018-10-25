<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;
use AdminFormSelect as FormSelect;

echo $form->back();

echo $form->form(function() {
  FormInput::create('名稱', 'name')
    ->need();

  FormSelect::create('顏色', 'color')
    ->items(\M\Tag::COLOR);
});