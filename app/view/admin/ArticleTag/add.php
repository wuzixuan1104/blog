<?php defined('MAPLE') || exit('此檔案不允許讀取！');

use AdminFormInput as FormInput;
use AdminFormSelect as FormSelect;
use AdminFormSwitcher as FormSwitcher;
use AdminFormTextarea as FormTextarea;

echo $form->back();

echo $form->form(function($parent) {
  FormSelect::create('設為主要', 'main')
    ->items(\M\ArticleTag::MAIN)
    ->val(\M\ArticleTag::MAIN_NO);

  FormSelect::create('標籤', 'tag')
    ->items( array_map(function($tag) { return ['value' => $tag->id, 'text' => $tag->name]; }, \M\Tag::all()) );
});