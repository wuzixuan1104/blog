<!DOCTYPE html>
<html lang="tw">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />

    <title>首頁 - Hsuan's Blog</title>

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
        <a href="index.html" class="icon-home3 active">網站首頁</a>
        <a href="dev.html" class="icon-tools" data-cnt="<?php echo $devCnt; ?>">開發心得</a>
        <a href="mood.html" class="icon-file-text2" data-cnt="<?php echo $lifeCnt; ?>">生活點滴</a>
        <a href="accomplish.html" class="icon-medal">成就紀錄</a>
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
          <a href="index.html" class="icon-home3 active">網站首頁</a>
          <a href="dev.html" class="icon-tools" data-cnt="<?php echo $devCnt; ?>">開發心得</a>
          <a href="mood.html" class="icon-file-text2" data-cnt="<?php echo $lifeCnt; ?>">生活點滴</a>
          <a href="accomplish.html" class="icon-medal">成就紀錄</a>
        </div>
      </div>
    </div>
    <label id="cover" for="chb-mobmenu"></label>

    <main id="main">
      <h1>吳姿萱</h1>
      <header>
        <figure class="bg"><img src="<?php echo $me->cover->url(); ?>"></figure>
        <span class="bottom">我不厲害，我只是個小小菜鳥工程師__</span>
      </header>

      <artical class="m">
        <span class="title">關於Hsuan</span>
        <div class="about"><?php echo $me->content;?></div>
        <span class="title">更新記錄</span>
        <div class="calendar">
          <div><a href="#" data-cnt="2"></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a href="#" data-cnt="10"></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>
          <div><a></a><a></a><a></a><a></a><a></a><a></a><a></a></div>

        </div>

        <span class="title">熱門文章</span>
        <div class="hot">
          <a href="#">
            <figure class="bg"><img src="<?php echo $me->cover->url(); ?>"></figure>
            <b data-tip="前端" class="">瀏覽器 Console 上畫 QR 瀏覽器 Console 上畫 QR</b>
            <span>來用瀏覽器除錯器畫一個屬於個人的彩蛋吧！使用瀏覽</span>
          </a>
          <a href="#">
            <figure class="bg"><img src="<?php echo $me->cover->url(); ?>"></figure>
            <b data-tip="前端" class="">瀏覽器 Console 上畫 QR</b>
            <span>來用瀏覽器除錯器畫一個屬於個人的彩蛋吧！使用瀏覽</span>
          </a>
          <a href="#">
            <figure class="bg"><img src="<?php echo $me->cover->url(); ?>"></figure>
            <b data-tip="前端" class="">瀏覽器 Console 上畫 QR</b>
            <span>來用瀏覽器除錯器畫一個屬於個人的彩蛋吧！使用瀏覽</span>
          </a>
          <a href="#">
            <figure class="bg"><img src="<?php echo $me->cover->url(); ?>"></figure>
            <b data-tip="前端" class="">瀏覽器 Console 上畫 QR</b>
            <span>來用瀏覽器除錯器畫一個屬於個人的彩蛋吧！使用瀏覽</span>
          </a>
        </div>
      </artical>
    </main>
  </body>
</html>
