/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, OAF2E
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */
 
$(function () {
  currentUrl = $(location).attr('href').split('/').pop();

  $('#menu').find('a').each(function() {
    if($(this).attr('href') == currentUrl)
      $(this).addClass('active').siblings().removeClass('active');
  });

  if (typeof $.fn.imgLiquid !== 'undefined') {
    $('figure.bg').imgLiquid();
  }
});