<?php defined('MAPLE') || exit('此檔案不允許讀取！');

return [
  'up' => "CREATE TABLE `Article` (
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `type`       enum('dev', 'life') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dev' COMMENT '類型',
    `desc`       varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '簡短敘述',
    `title`      varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '標題',
    `content`    text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '內容',
    `cntPv`      int(11) unsigned NOT NULL DEFAULT 0 COMMENT '瀏覽數',
    `cntSearch`  int(11) unsigned NOT NULL DEFAULT 0 COMMENT '搜尋數',
    `enable`     enum('no', 'yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT '上架',
    `updateAt`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間',
    `createAt`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
    PRIMARY KEY (`id`),
    KEY `type_index` (`type`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

  'down' => "DROP TABLE IF EXISTS `Article`;",

  'at' => "2018-10-22 14:15:36"
];
