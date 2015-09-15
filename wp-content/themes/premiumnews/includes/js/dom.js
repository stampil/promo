$( document ).ready(function() {
    console.log('ready');
    //GESTION DES SHARE SOCIALMEDIA
    jQuery('#nav-right').on('click', '.apico-facebook[title][url]', function(){
        window.open('https://www.facebook.com/sharer/sharer.php?u='+$(this).attr('url')+'&title='+encodeURIComponent($(this).attr('title')), 'Popup', 'scrollbars=1,resizable=1,height=420,width=550');
        return false;
    });
    
    jQuery('#nav-right').on('click', '.apico-twitter[title][url]', function(){
        window.open('https://twitter.com/intent/tweet?via=JeuxEnPromotion&text='+encodeURIComponent($(this).attr('title'))+'&url='+$(this).attr('url')+'&hashtags=&original_referer='+$(this).attr('url'), 'Popup', 'scrollbars=1,resizable=1,height=420,width=550'); 
        return false;
    });
    
    jQuery('#nav-right').on('click', '.apico-google-plus[title][url]', function(){
        window.open('https://plus.google.com/share?url='+$(this).attr('url'), 'Popup', 'scrollbars=1,resizable=1,height=420,width=550'); 
        return false;
    });
    
    jQuery('#nav-right').on('click', '.apico-linkedin[title][url]', function(){
        window.open('http://www.linkedin.com/shareArticle?mini=true&url='+$(this).attr('url')+'&title='+encodeURIComponent($(this).attr('title'))+'&summary=&source='+$(this).attr('url'), 'Popup', 'scrollbars=1,resizable=1,height=420,width=550'); 
        return false;
    });
    
    jQuery('#nav-right').on('click', '.apico-stumbleupon[title][url]', function(){
        window.open('http://www.stumbleupon.com/submit?url='+$(this).attr('url'), 'Popup', 'scrollbars=1,resizable=1,height=420,width=550'); 
        return false;
    });
    
    jQuery('#nav-right').on('click', '.ma[title][url]', function(){
        window.location.href='mailto:?subject='+$(this).attr('title').replace(/\+ */g,' ')+'&body='+decodeURI($(this).attr('url'));
        return false;
    });
    
});