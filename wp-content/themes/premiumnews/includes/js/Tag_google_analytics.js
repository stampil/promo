var tagAnalyticsCNIL={};tagAnalyticsCNIL.CookieConsent=function(){function e(){var e=33696e6,n=new Date;n.setTime(n.getTime()+e);var t="; expires="+n.toGMTString();return t}function n(){if(""!=w)return w;var e=document.location.hostname;return 0===e.indexOf("www.")&&(e=e.substring(4)),e}function t(){var e=n(),t="domain=."+e;return t}function o(){var e=document.getElementsByTagName("body")[0],n=document.createElement("div");n.setAttribute("id","cookie-banner"),n.setAttribute("width","70%"),n.innerHTML='<button class="close" name="cancel" onclick="tagAnalyticsCNIL.CookieConsent.consent_close()" ></button>		<div id="cookie-banner-message" align="center">		En continuant à naviguer sur ce site, vous nous autorisez à déposer un cookie à des fins de 		mesure d\'audience. 		<a href="javascript:tagAnalyticsCNIL.CookieConsent.showInform()"> En savoir plus ou s\'opposer</a>.</div>',e.insertBefore(n,e.firstChild),document.getElementsByTagName("body")[0].className+=" cookiebanner",l()}function i(e){return document.cookie.length>0&&(begin=document.cookie.indexOf(e+"="),-1!=begin)?(begin+=e.length+1,end=document.cookie.indexOf(";",begin),-1==end&&(end=document.cookie.length),unescape(document.cookie.substring(begin,end))):null}function a(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var n=navigator.userAgent,t=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=t.exec(n)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){var n=navigator.userAgent,t=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})");null!=t.exec(n)&&(e=parseFloat(RegExp.$1))}return e}function r(){var e=confirm("La signal DoNotTrack de votre navigateur est activé, confirmez vous activer la fonction DoNotTrack?");return e}function c(){if(navigator.doNotTrack&&("yes"==navigator.doNotTrack||"1"==navigator.doNotTrack)||navigator.msDoNotTrack&&"1"==navigator.msDoNotTrack){var e=-1!=a();return e?r():!0}}function s(){return!navigator.doNotTrack||"no"!=navigator.doNotTrack&&0!=navigator.doNotTrack?void 0:!0}function d(e){var n=";path=/",o="Thu, 01-Jan-1970 00:00:01 GMT";document.cookie=e+"="+n+" ; "+t()+";expires="+o}function u(){for(var e=["__utma","__utmb","__utmc","__utmz","_ga","_gat"],n=0;n<e.length;n++)d(e[n])}function l(){var e=document.getElementsByTagName("body")[0],n=document.createElement("div");n.setAttribute("id","inform-and-ask"),n.style.width=window.innerWidth+"px",n.style.height=window.innerHeight+"px",n.style.display="none",n.style.position="fixed",n.style.zIndex="100000",n.innerHTML='<div style="width: 320px; background-color: white; repeat scroll 0% 0% white; border: 1px solid #cccccc; padding :10px 10px;text-align:center; position: fixed; top:40px; left:50%; margin-top:0px; margin-left:-150px; z-index:100000; opacity:1" id="inform-and-consent">		<div><span><b>Les cookies Google Analytics</b></span></div><br><div>Ce site utilise  des cookies de Google Analytics,		ces cookies nous aident à identifier le contenu qui vous interesse le plus ainsi qu\'à repérer certains 		dysfonctionnements. Vos données de navigations sur ce site sont envoyées à Google Inc</div><div style="padding :10px 10px;text-align:center;"><button style="margin-right:50px;text-decoration:underline;" 		name="S\'opposer" onclick="tagAnalyticsCNIL.CookieConsent.gaOptout();tagAnalyticsCNIL.CookieConsent.hideInform();" id="optout-button" >S\'opposer</button><button style="text-decoration:underline;" name="cancel" onclick="tagAnalyticsCNIL.CookieConsent.hideInform()" >Accepter</button></div></div>',e.insertBefore(n,e.firstChild)}function g(e){return"cookie-banner"==e.target.parentNode.id||e.target.parentNode.parentNode&&"cookie-banner"==e.target.parentNode.parentNode.id||"optout-button"==e.target.id}function p(n){g(n)||clickprocessed||(n.preventDefault(),document.cookie="hasConsent=true; "+e()+" ; "+t()+" ; path=/",f(),clickprocessed=!0,window.setTimeout(function(){n.target.click()},1e3))}function m(){!function(e,n,t,o,i,a,r){e.GoogleAnalyticsObject=i,e[i]=e[i]||function(){(e[i].q=e[i].q||[]).push(arguments)},e[i].l=1*new Date,a=n.createElement(t),r=n.getElementsByTagName(t)[0],a.async=1,a.src=o,r.parentNode.insertBefore(a,r)}(window,document,"script","//www.google-analytics.com/analytics.js","__gaTracker"),__gaTracker("create",v,{storage:"none",clientId:"0"}),__gaTracker("send","event","page","load",{nonInteraction:1})}function f(){y||(y=!0,function(e,n,t,o,i,a,r){e.GoogleAnalyticsObject=i,e[i]=e[i]||function(){(e[i].q=e[i].q||[]).push(arguments)},e[i].l=1*new Date,a=n.createElement(t),r=n.getElementsByTagName(t)[0],a.async=1,a.src=o,r.parentNode.insertBefore(a,r)}(window,document,"script","//www.google-analytics.com/analytics.js","ga"),ga("create",v,"auto"),ga("send","pageview"))}var v="UA-15555401-2",k="ga-disable-"+v,y=!1,w="";return{gaOptout:function(){document.cookie=k+"=true;"+e()+" ; "+t()+" ; path=/",document.cookie="hasConsent=false;"+e()+" ; "+t()+" ; path=/";var n=document.getElementById("cookie-banner");clickprocessed=!0,null!=n&&(n.innerHTML='<div style="background-color:#fff;text-align:center;padding:5px;font-size:12px;border-bottom:1px solid #eeeeee;" id="cookie-message"> Vous vous êtes opposé 			au dépôt de cookies de mesures d\'audience dans votre navigateur </div>'),window[k]=!0,u()},showInform:function(){var e=document.getElementById("inform-and-ask");e.style.display=""},hideInform:function(){var e=document.getElementById("inform-and-ask");e.style.display="none";var e=document.getElementById("cookie-banner");e.style.display="none"},consent_close:function(){document.cookie="hasConsent=true; "+e()+" ; "+t()+" ; path=/",f(),this.hideInform()},start:function(){var e=i("hasConsent");clickprocessed=!1,e?document.cookie.indexOf("hasConsent=false")>-1?window[k]=!0:f():c()?tagAnalyticsCNIL.CookieConsent.gaOptout():s()?p():(window.addEventListener?(window.addEventListener("load",o,!1),document.addEventListener("click",p,!1)):(window.attachEvent("onload",o),document.attachEvent("onclick",p)),m())}}}(),tagAnalyticsCNIL.CookieConsent.start();