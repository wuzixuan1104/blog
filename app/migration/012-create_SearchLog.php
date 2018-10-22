<?php defined('MAPLE') || exit('此檔案不允許讀取！');

return [
  'up' => "CREATE TABLE `SearchLog` (
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `keyword`    varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '關鍵字',
    `updateAt`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間',
    `createAt`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

  'down' => "DROP TABLE IF EXISTS `SearchLog`;",

  'at' => "2018-10-22 14:15:36"
];
