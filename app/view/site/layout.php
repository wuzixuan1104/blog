<!DOCTYPE html>
<html lang="tw">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />

    <title><?php echo isset($title) ? $title : ''; ?></title>

    <?php echo $asset->renderCSS();?>
    <?php echo $asset->renderJS();?>
    
  </head>
  <body lang="zh-tw">
    <header id="header"></header>
    <input id="chb-menu" type="checkbox">
    <div id="menu">
      <label id="back" for="chb-menu" class="icon-r"></label>
      <header>
        <label for="chb-menu" class="icon-l"><?php echo $me->title;?></label>
        <div><img src="<?php echo $me->avatar->url();?>"</div>
      </header>
      <a href="<?php echo $me->github; ?>" class="icon-gi yellow-btn">GitHub</a>

      <div class="links">
        <a href="<?php echo Url::base(); ?>" class="icon-home3 active">網站首頁</a>
        <a href="<?php echo Url::base() . 'devs'; ?>" class="icon-tools" data-cnt="<?php echo $devCnt; ?>">開發心得</a>
        <a href="<?php echo Url::base() . 'lives'; ?>" class="icon-file-text2" data-cnt="<?php echo $lifeCnt; ?>">生活點滴</a>
        <a href="<?php echo Url::base() . 'accomplish'; ?>" class="icon-medal">成就紀錄</a>
      </div>
    </div>
    
    <input id="chb-mobmenu" type="checkbox">
    <div id="mobMenu">
      <div class="block">
        <label class="l icon-list" for="chb-mobmenu"></label>
        <span>
          <svg height="60px" width="100px" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M0 0 L 15 0 A 35 35 0 0 0 50 35 A 35 35 0 0 0 85 0 L 100 0 L 100 60 L 0 60" fill="#384854"/></svg>
          <a href="<?php echo $me->github; ?>" class="icon-gi"></a>
        </span>
        <label class="r"></label>
      </div>
      <div class="pop">
        <label class="avatar"><img src="<?php echo $me->avatar->url();?>"></label>
        <div class="svg">
          <label class="l"></label>
          <svg class="btn" height="50px" width="100px" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M0 0 L 25 0 A 25 25 0 0 0 50 25 A 25 25 0 0 0 75 0 L 100 0 L 100 50 L 0 50" fill="#35444e"/></svg>
          <label class="r"></label>
        </div>
        <div class="links">
          <a href="<?php echo Url::base(); ?>" class="icon-home3 active">網站首頁</a>
          <a href="<?php echo Url::base() . 'devs'; ?>" class="icon-tools" data-cnt="<?php echo $devCnt; ?>">開發心得</a>
          <a href="<?php echo Url::base() . 'lives'; ?>" class="icon-file-text2" data-cnt="<?php echo $lifeCnt; ?>">生活點滴</a>
          <a href="<?php echo Url::base() . 'accomplish'; ?>" class="icon-medal">成就紀錄</a>
        </div>
      </div>
    </div>
    <label id="cover" for="chb-mobmenu"></label>

    <main id="main">
      <?php echo isset($content) ? $content : ''; ?>
    </main>

  </body>
</html>
