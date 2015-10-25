
/**************************************************************************
 * jquery.themepunch.punchbox.js - jQuery Plugin for Punchbox Slider
 * @version: 1.0 (18.10.2013)
 * @requires jQuery v1.7 or later (tested on 1.9)
 * @author ThemePunch
**************************************************************************/


(function(e,t,n,r){function i(e,t){var r=t.container;var i=r.find(t.items);var s=new Object;s.maxitem=i.length;i.slice(0,s.maxitem).each(function(e){var t=n(this);if(t.hasClass("pb-selected"))s.current=e});return s}function s(e,t,s){o();clearTimeout(t.timer);if(t.timeranim!=r)t.timeranim.pause();if(t.ajax!=r&&t.ajax!=null)t.ajax.abort();e.addClass("pb-selected");try{var f=i(e,t);var l=n("#pb-wrapper");var c=e.attr("href")||e.data("ref")||t.href||(isString(element)?element:null);var h=t.metaInfo;if(e.data("metas")!=r)h.showMeta=!e.data("metas");if(h.showMeta){var v=e.data("title")||e.data("caption")||e.data("punchbox-title")||t.title||"";var m=e.data("meta")||e.data("punch-meta")||"";var y=h.orderMarkup.replace("%n",f.current+1);y=y.replace("%m",f.maxitem);var b=h.metaMarkup.replace("%title%",v);b=b.replace("%metadata%",m);b=b.replace("%ordermarkup%",y)}var w=e.data("type")||e.data("punchbox-type");if(!w){if(d(c))w="image";else if(c.charAt(0)==="#")w="inline"}var E=e.data("width")||e.data("punchbox-width")||1200;var S=e.data("height")||e.data("punchbox-height")||768;var x=l.find(".pb-contentwrapper");x.find(".pb-content").addClass("pb-oldcontent").removeClass("pb-content");x.append('<div class="pb-content" style="z-index:15"><div class="pb-closezone" style="width:100%;height:100%;position:absolute;top:0px;left:0px;z-index:0;cursor:pointer"></div></div>');var T=x.find(".pb-content");if(w=="iframe"){T.append('<div class="pb-media"><div class="pb-mediacontent"><iframe src="'+c+'"></iframe></div></div>');var N=l.find(".pb-content .pb-media");var C=N.find("iframe");N.data("w",E);N.data("h",S);C.one("load",function(){if(h.showMeta)N.append(b);D(500,t,s)})}else if(w=="image"){var k=new Image;k.onload=function(){E=e.data("width")||e.data("punchbox-width")||k.width||1200;S=e.data("height")||e.data("punchbox-height")||k.height||768;T.append(k);T.find("img").wrap('<div class="pb-media"><div class="pb-mediacontent"></div></div>');var n=l.find(".pb-content .pb-media");n.data("w",E);n.data("h",S);if(h.showMeta)n.append(b);D(200,t,s)};k.src=c}else if(w=="inline"){var L=n(c).html();T.append('<div class="pb-media"><div class="pb-inline-wrapper scrollable pb-mediacontent"><div class="pb-inline">'+L+"</div></div></div>");var N=l.find(".pb-content .pb-media");N.css({width:E+"px",height:S+"px"});N.data("w",E);N.data("h",S);if(h.showMeta)N.append(b);D(200,t,s)}else if(w==="ajax"){n.ajaxSetup({cache:t.ajaxCache});var A=c.split(/\s+/,2);var O=A.shift();var M=A.shift();T.append('<div class="pb-media"><div class="pb-inline-wrapper scrollable pb-mediacontent"><div class="pb-inline"></div></div></div>');var _=T.find(".pb-inline");t.ajax=n.ajax({url:O,error:function(e,n){if(n!=="abort"){_.append("ERROR BY LOADING CONTENT...");var r=l.find(".pb-content .pb-media");r.css({width:E+"px",height:S+"px"});r.data("w",E);r.data("h",S);if(h.showMeta)r.append(b);g(t);setTimeout(function(){a(t,s);p(t)},200);u()}t.ajax=null},success:function(e,r){_.append(n(e).find(M));var i=l.find(".pb-content .pb-media");i.css({width:E+"px",height:S+"px"});i.data("w",E);i.data("h",S);if(h.showMeta)i.append(b);D(200,t,s)}})}function D(e,t,n){var r=t.container;g(t);setTimeout(function(){a(t,n);p(t)},200);u();t.ajax=null}}catch(P){}}function o(){if(n("#pb-preloader").length==0)n("body").append('<div id="pb-preloader"></div>')}function u(){n("#pb-preloader").each(function(){n(this).remove()})}function a(e,t){var i=e.container;var s=n("#pb-wrapper").find(".pb-insidewrapper");var o=s.find(".pb-oldcontent");var u=s.find(".pb-content");var a=e.callbacks;if(a.ready!=r){a.ready(u,o)}i.trigger("ready");u.addClass("pb-onanim");if(a.beforeAnim!=r){a.beforeAnim(u,o)}i.trigger("beforeanim");if(t==1){TweenLite.to(o.find(".pb-media"),.6,{scale:1,transformOrigin:"center top",opacity:0,z:-300,y:0,transformPerspective:3e3,rotationX:90,ease:Power3.easeOut});TweenLite.fromTo(u.find(".pb-media"),.6,{scale:1,transformOrigin:"center bottom",opacity:0,z:-300,y:0,transformPerspective:3e3,rotationX:-90},{scale:1,rotationX:0,y:0,z:0,display:"block",opacity:1,ease:Power3.easeOut,delay:.1,boxShadow:"0px 0px 25px 0px rgba(0,0,0,0.5)"})}else{TweenLite.to(o.find(".pb-media"),.6,{scale:1,transformOrigin:"center bottom",opacity:0,z:-300,y:0,transformPerspective:3e3,rotationX:-90,ease:Power3.easeOut});TweenLite.fromTo(u.find(".pb-media"),.6,{scale:1,transformOrigin:"center top",opacity:0,z:-300,y:0,transformPerspective:3e3,rotationX:90},{scale:1,rotationX:0,y:0,z:0,display:"block",opacity:1,ease:Power3.easeOut,delay:.1,boxShadow:"0px 0px 25px 0px rgba(0,0,0,0.5)"})}if(e.timernaim!=r)setTimeout(function(){e.timeranim.seek(0)},200);setTimeout(function(){u.removeClass("pb-onanim");o.remove();if(a.afterAnim!=r){a.afterAnim(u)}i.trigger("afteranim");if((e.navigation.autoplay=="enabled"||e.navigation.autoplay=="enable")&&e.navigation.autoplaydelay>0){e.timer=setTimeout(function(){c(i)},e.navigation.autoplaydelay);if(e.timeranim)e.timeranim.restart()}},750)}function f(e){var t=n("#pb-wrapper").find(".pb-insidewrapper");TweenLite.to(n("#pb-wrapper"),.6,{opacity:0});TweenLite.to(n("#pb-underlay"),.6,{opacity:0});TweenLite.to(t,.6,{scale:.8,transformOrigin:"center top",opacity:0,z:-1190,y:300,transformPerspective:3e3,rotationX:-90,ease:Power3.easeOut});n(".pb-selected").removeClass("pb-selected");setTimeout(function(){clearTimeout(e.timer);n("#pb-underlay").remove();n("#pb-wrapper").remove();u()},700)}function l(e,t){var r=t.data("opt");var i=n("#pb-wrapper");var s=i.find(".pb-insidewrapper");var o=r.navigation;var u=o.templates;if(e){i.append('<a id="pb-prev" class="pb-'+o.position+'">'+u.leftbutton+"</a>");i.append('<a id="pb-next" class="pb-'+o.position+'">'+u.rightbutton+"</a>");if(o.autoplay==="enable"||o.autoplay==="enabled"){i.append('<a id="pb-play" class="pb-'+o.position+'">'+u.playbutton+"</a>");i.addClass("pb-playeracitve");i.append('<div id="pb-timer"></div>')}}r.timeranim=TweenLite.to(n("#pb-timer"),o.autoplaydelay/1e3,{width:"100%",ease:Linear.easeNone});r.timeranim.pause().seek(0);i.append('<a id="pb-close" class="pb-'+o.position+'">'+u.closebutton+"</a>");n("#pb-close").on("click",function(){f(r)});n("body").on("click",".pb-closezone",function(){f(r)});n("#pb-next").on("click",function(){c(t)});n("#pb-prev").on("click",function(){h(t)});n("#pb-play").on("click",function(){var e=n(this);if(i.hasClass("pb-playeracitve")){clearTimeout(r.timer);i.removeClass("pb-playeracitve");r.navigation.autoplay="disable";r.timeranim.pause();t.trigger("pause")}else{i.addClass("pb-playeracitve");r.navigation.autoplay="enable";r.timeranim.resume();resttime=(r.navigation.autoplaydelay/1e3-r.timeranim.time())*1e3;r.timer=setTimeout(function(){c(t)},resttime);t.trigger("resume")}})}function c(e){var t=e.data("opt");var i=e.find(t.items);var o;var u;var a;var f;i.slice(0,i.length).each(function(e){var t=n(this);if(e==0)o=t;if(t.hasClass("pb-selected")){t.removeClass("pb-selected");a=e}if(a+1==e){u=t;f=e}});if(u==r)u=o;s(u,t,1,f,i.length)}function h(e){var t=e.data("opt");var i=e.find(t.items);var o;var u;var a;var f;i.slice(0,i.length).each(function(e){var t=n(this);if(e==i.length-1)o=t;if(t.hasClass("pb-selected")){t.removeClass("pb-selected");a=e}});i.slice(0,i.length).each(function(e){var t=n(this);if(a-1==e)u=t;f=e});if(u==r)u=o;s(u,t,-1,f,i.length)}function p(e){var t=n(".pb-content .pb-media");var r=n(".pb-oldcontent .pb-media");var i=e.navigation;if(i.container=="insidemedia"){n("#pb-prev").appendTo(t);n("#pb-next").appendTo(t);n("#pb-close").appendTo(t);n("#pb-play").appendTo(t);n("#pb-timer").appendTo(t);n("#pb-prev").clone(true,true).appendTo(r);n("#pb-next").clone(true,true).appendTo(r);n("#pb-close").clone(true,true).appendTo(r);n("#pb-play").clone(true,true).appendTo(r);n("#pb-timer").clone(true,true).appendTo(r)}}function d(e){return e.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)}function v(e){return e.match(/\.(swf)((\?|#).*)?$/i)}function m(t){var r=t.data("opt");var i=n("body");i.append('<div id="pb-underlay"></div>');i.append('<div id="pb-wrapper"></div>');var s=n("#pb-wrapper");s.append('<div class="pb-insidewrapper"><div class="pb-contentwrapper"><div class="pb-content"></div></div><div class="pb-closezone" style="width:100%;height:100%;position:absolute;top:0px;left:0px;z-index:0;cursor:pointer"></div></div>');if(t.find(r.items).length>1)l(true,t);else l(false,t);n(e).resize(function(){g(r)})}function g(t){var i=n("#pb-wrapper").find(".pb-insidewrapper");var s=i.find(".pb-content .pb-media");var o=s.find(".pb-mediacontent");var u=i.find(".pb-content");var a=i.find(".pb-contentwrapper");var f=s.data("w");var l=s.data("h");if(f!=r&&l!=r){var c=n(e).width();var h=n(e).height();var p=c/f;var d=h/l;o.width(f);o.height(l);if(o.width()>c){o.width(c);o.height(l*p)}if(o.height()>h){o.height(h);o.width(f*d)}var v=h-s.height();if(v<0){d=(h+v)/l;var m=f*d;if(h+v>200&&f*d>200){o.height(h+v);o.width(f*d)}}s.width(o.width());s.height(o.height());u.css({top:h/2-s.height()/2+"px"});u.css({left:c/2-s.width()/2+"px"})}}n.fn.extend({punchBox:function(e){n.fn.punchBox.defaults={items:".punchbox",itemType:"image",navigation:{container:"insidemedia",position:"dettached",autoplay:"disable",autoplaydelay:2e3,templates:{leftbutton:'<div class="pb-leftbutton"><i class="icon-left-open"></i></div>',rightbutton:'<div class="pb-rightbutton"><i class="icon-right-open"></i></div>',closebutton:'<div class="pb-closebutton"><i class="icon-cancel"></i></div>',playbutton:'<div class="pb-playbutton"><i class="icon-play pb-onpause"></i><i class="icon-pause pb-onplay"></i></div>'},keys:{next:{13:"left",34:"up",39:"left",40:"up"},prev:{8:"right",33:"down",37:"right",38:"down"},close:[27],play:[32],toggle:[70]}},ajaxCahce:true,metaInfo:{showMeta:true,orderMarkup:"%n / %m",metaMarkup:'<div class="pb-metawrapper"><div class="pb-title">%title%</div><div class="pb-metadata">%metadata%</div><div class="pb-order">%ordermarkup%</div></div>'}};var e=n.extend(true,{},n.fn.punchBox.defaults,e);return this.each(function(){var t=e;if(t.navigation.autoplay=="enabled")t.navigation.autoplay="enable";if(t.navigation.autoplay=="disabled")t.navigation.autoplay="disable";var i=n(this);i.data("opt",t);t.container=i;i.find(t.items).each(function(){var e=n(this);if(e.data("prepared")==r){e.click(function(){m(i);s(e,t);return false});e.data("prepared",1)}})})},open:function(e){return this.each(function(){var t=n(this);var r=t.data("opt");r=n.extend(true,{},r,e);t.data("opt",r);var i=t.find(r.items).first();m(t);s(i,r)})},close:function(e){return this.each(function(){var e=n(this);var t=e.data("opt");f(t)})},update:function(e){return this.each(function(){var t=n(this);var r=t.data("opt");r=n.extend(true,{},r,e);t.data("opt",r)})}})})(window,document,jQuery)