/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, OAF2E
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */
 
$(function () {
  currentUrl = $(location).attr('href').split('/').pop().split('?')[0];
  offset = $(location).attr('href').split('offset=').pop();

  $('#page').find('a').each(function(){
    if($(this).attr('href').split('offset=').pop() == offset)
      $(this).parent().addClass('active').siblings().removeClass('active');
  });

  $('#menu').find('a').each(function() {
    if($(this).attr('href').split('/').pop() == currentUrl)
      $(this).addClass('active').siblings().removeClass('active');
  });

  if (typeof $.fn.imgLiquid !== 'undefined') {
    $('figure.bg, div.bg').imgLiquid();
  }
});