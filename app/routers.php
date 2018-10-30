<?php defined('MAPLE') || exit('此檔案不允許讀取！');

Router::get('')->controller('Main@index');

Router::get('lives')->controller('Life@index');
Router::get('live/(id:num)')->controller('Life@detail');

Router::get('devs')->controller('Dev@index');
Router::get('dev/(id:num)')->controller('Dev@detail');

Router::get('accomplish')->controller('Accomplish@index');

Router::file('cli.php')   || gg('載入 Router「cli.php」失敗！');
Router::file('admin.php') || gg('載入 Router「admin.php」失敗！');
Router::file('api.php')   || gg('載入 Router「api.php」失敗！');
