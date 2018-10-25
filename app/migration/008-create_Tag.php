<?php defined('MAPLE') || exit('此檔案不允許讀取！');

return [
  'up' => "CREATE TABLE `Tag` (
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `name`       varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '標題',
    `color`      enum('pink', 'green', 'blue', 'orange', 'other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other' COMMENT '顏色',
    `updateAt`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間',
    `createAt`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
    PRIMARY KEY (`id`),
    KEY `type_index` (`type`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

  'down' => "DROP TABLE IF EXISTS `Tag`;",

  'at' => "2018-10-22 14:15:08"
];
