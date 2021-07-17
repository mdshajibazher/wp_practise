;(function($){
    $(document).ready(function(){

       $("body").on('click','#notice-ninja .notice-dismiss',function(){
           setCookie("nn-close",1,60);
       })
       
        
    });
})(jQuery);


function setCookie(cookieName,cookieValue,expireInSeconds){
    var expire = new Date();
    expire.setTime(expire.getTime()+1000*expireInSeconds);
    document.cookie = cookieName + "="+ escape(cookieValue)+";expires="+expire.toGMTString()+"; path=/";
}