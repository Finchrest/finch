$(document).ready((function(){"use strict";!function(i){i.fn.showLightbox=function(){var e=window.innerHeight||i(window).height(),t=window.innerWidth||i(window).width();return i('<div id="ms-overlay"></div>').css({opacity:"0.9"}).appendTo("body"),i('<div id="ms-lightbox"></div>').hide().appendTo("body"),i("<img>").attr("src",i(this).attr("src")).css({"max-height":.75*e,"max-width":.75*t}).load((function(){i("#ms-lightbox").css({top:(e-i("#ms-lightbox").height())/2,left:(t-i("#ms-lightbox").width())/2}).fadeIn()})).appendTo("#ms-lightbox"),i('<div id="ms-title-wrap"></div>').appendTo("#ms-lightbox"),i('<p id="ms-title"></p>').appendTo("#ms-title-wrap"),document.getElementById("ms-title").innerHTML=i(this).attr("title"),i("#ms-overlay, #ms-lightbox").click((function(){i("#ms-overlay, #ms-lightbox").remove()})),i(document).keyup((function(e){27==e.which&&i("#ms-overlay, #ms-lightbox").remove()})),this},i.fn.showSlider=function(e){var t,n,s=i.extend({height:300,fadeTime:500,intervalTime:5e3,tray:!0},e),d=i(this).children().length,o=i('<ul id="tray"></ul>'),h='<li class="dot selected"><a href="#">0</a></li>',l=i(this).children(),r=l.children(),a=s.intervalTime,c=s.fadeTime,m=s.height;if(i(this).css({height:m+"px"}),r.css({height:m+"px"}),s.tray){for(var p=1;p<d;p++)h+='<li class="dot deselected"><a href="#">'+p+"</a></li>";o.append(h),o.insertAfter(i(this)),(t=i("#tray").children()).click((function(e){e.preventDefault();var t=i(this).text();clearInterval(n),g(l.eq(t)),setTimeout((function(){v()}),c)}))}function g(e){var n,o,h,r=i(".visible");e||(n=r.index()===d-1?0:r.index()+1,e=l.eq(n)),r.index()!==e.index()&&(e.css({zIndex:"2"}),s.tray&&(o=t.eq(r.index()),h=t.eq(e.index()),o.removeClass("selected").addClass("deselected"),h.removeClass("deselected").addClass("selected")),r.fadeTo(c,0,(function(){r.removeClass("visible").css({zIndex:"1",opacity:"1"}),e.addClass("visible").css({zIndex:"3"})})))}function v(){n=setInterval((function(){g()}),a)}return l.css({zIndex:"1",opacity:"1"}),l.eq(0).addClass("visible").css({zIndex:"3",position:"relative"}),v(),this},i.fn.showGallery=function(e){i("#ms-gallery").children().addClass("ms-gallery-item");var t=i.extend({imgCounter:!0,width:165,height:95},e),n=t.width,s=t.height,d=i(this).children(),o=d.children(),h=d.size();function l(e,n){i("#ms-lightbox, #ms-overlay").remove(),e.showLightbox(),function(e){i(window).height(),i("#ms-lightbox").height(),i(window).width(),i("#ms-lightbox").width();var n,s,o=i("#ms-lightbox").height()/2;0!==e&&(n=i(d).eq(e-1).children(),i('<div id="arrow-left"></div>').appendTo("#ms-lightbox").css({left:"-80px",top:o}).click((function(){l(n,e-1)})),i('<div id="arrow-left-icon"></div>').appendTo("#arrow-left"));e+1!==h&&(s=i(d).eq(e+1).children(),i('<div id="arrow-right"></div>').appendTo("#ms-lightbox").css({right:"-80px",top:o}).click((function(){l(s,e+1)})),i('<div id="arrow-right-icon"></div>').appendTo("#arrow-right"));t.imgCounter&&function(e){i('<div id="counter"></div>').appendTo("#ms-lightbox"),i("<span></span>").appendTo("#counter").text(e+1+"/"+h)}(e)}(n)}return o.css({width:n+"px",height:s+"px"}),o.click((function(){var e=i(this).parent().index();alert(e),l(i(this),e)})),this}}(jQuery),$(".ms-lightbox").click((function(){$(this).showLightbox()}))}));