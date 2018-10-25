<?php defined('MAPLE') || exit('此檔案不允許讀取！');

Router::dir('admin', 'Admin', function() {

  // 登入
  Router::get('logout')->controller('Auth@logout');
  Router::get('login')->controller('Auth@login');
  Router::post('login')->controller('Auth@signin');

  // 後台主頁
  Router::get()->controller('Main@index');
  Router::post('theme')->controller('Main@theme');

  // Admin
  Router::get('admins')->controller('Admin@index');
  Router::get('admins/add')->controller('Admin@add');
  Router::post('admins')->controller('Admin@create');
  Router::get('admins/(id:num)/edit')->controller('Admin@edit');
  Router::put('admins/(id:num)')->controller('Admin@update');
  Router::get('admins/(id:num)')->controller('Admin@show');
  Router::del('admins/(id:num)')->controller('Admin@delete');
  
  // Backup
  Router::get('backups')->controller('Backup@index');
  Router::get('backups/(id:num)')->controller('Backup@show');
  Router::post('backups/(id:num)/read')->controller('Backup@read');

  // Crontab
  Router::get('crontabs')->controller('Crontab@index');
  Router::get('crontabs/(id:num)')->controller('Crontab@show');
  Router::post('crontabs/(id:num)/read')->controller('Crontab@read');

  Router::get('articles')->controller('Article@index');
  Router::get('articles/add')->controller('Article@add');
  Router::post('articles/create')->controller('Article@create');
  Router::get('articles/(id:num)/edit')->controller('Article@edit');
  Router::put('articles/(id:num)')->controller('Article@update');
  Router::get('articles/(id:num)')->controller('Article@show');
  Router::del('articles/(id:num)')->controller('Article@delete');
  Router::post('articles/(id:num)/enable')->controller('Article@enable');

  Router::get('article/(articleId:num)/tags')->controller('ArticleTag@index');
  Router::get('article/(articleId:num)/tags/add')->controller('ArticleTag@add');
  Router::post('articles/(articleId:num)/tags/create')->controller('ArticleTag@create');
  Router::del('articles/(articleId:num)/tags/(id:num)')->controller('ArticleTag@delete');

  Router::get('article/(articleId:num)/refs')->controller('ArticleRef@index');
  Router::get('article/(articleId:num)/refs/add')->controller('ArticleRef@add');
  Router::post('articles/(articleId:num)/refs/create')->controller('ArticleRef@create');
  Router::get('articles/(articleId:num)/refs/(id:num)/edit')->controller('ArticleRef@edit');
  Router::put('articles/(articleId:num)/refs/(id:num)')->controller('ArticleRef@update');
  Router::del('articles/(articleId:num)/refs/(id:num)')->controller('ArticleRef@delete');

  Router::get('tags')->controller('Tag@index');
  Router::get('tags/add')->controller('Tag@add');
  Router::post('tags/create')->controller('Tag@create');
  Router::get('tags/(id:num)/edit')->controller('Tag@edit');
  Router::put('tags/(id:num)')->controller('Tag@update');
  Router::get('tags/(id:num)')->controller('Tag@show');
  Router::del('tags/(id:num)')->controller('Tag@delete');

  Router::post('ckeditor/image/upload')->controller('CkeditorImg@upload');
  Router::get('ckeditor/image/browse')->controller('CkeditorImg@browse');
});