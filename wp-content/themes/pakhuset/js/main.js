
var $ = jQuery ;
$window = $(window);

$( document ).ready(function() {
    //mobile menu
    $('.js-toggle-menu').click(function(e){
        e.preventDefault();
        $('.mobile-dropdown').slideToggle();
        $(this).toggleClass('open');
    });
    if ($('.post-success-nr').length > 0){
        var getUrl = window.location;
        var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
        var finalDestination = baseUrl + "/grupper-oversigt/";
        setInterval(function(){
            window.location.replace(finalDestination);
        },2000);
    }
    /*
    $('.bottom').addClass('original').clone().insertAfter('.bottom').addClass('cloned').css('position','fixed').removeClass('original').hide();
   
    //menu
    $window.scroll(function() {
    scroll = $window.scrollTop();
    scrollIndex = $('.main-nav').height();
        if (scroll >= scrollIndex) {
            parentElement = $('.original').parent().parent();
            coordsOrgElement = parentElement.offset();
            rightOrgElement = coordsOrgElement.left;  
            widthParentElement = parentElement.css('width');
            $('.cloned').css('right',rightOrgElement+'px').css('width', widthParentElement).show();
            $('.original').css('visibility','hidden');
          } else {
            $('.cloned').hide();
            $('.original').css('visibility','visible');
          }
    });
*/
    //slider
    if ($('.slider').length > 0) {
        $('.slider').each(function() {
            var $this = $(this);
            var $group = $this.find('.slide_group');
            var $slides = $this.find('.slide');
            var bulletArray = [];
            var currentIndex = 0;
            var timeout;
        
            function move(newIndex) {
            var animateLeft, slideLeft;
            advance();
            
            if ($group.is(':animated') || currentIndex === newIndex) {
                return;
            }
            
            bulletArray[currentIndex].removeClass('active');
            bulletArray[newIndex].addClass('active');
            function frameAni(){
                var $offset = $('.active').offset();
                $('.frame').animate({'left': ($offset.left - 3)}, 200);
                $('.frame').height($heightActive);
                $('.frame').width($widthActive);
            }
            frameAni();
            if (newIndex > currentIndex) {
                slideLeft = '100%';
                animateLeft = '-100%';
                frameAni();
            } else {
                slideLeft = '-100%';
                animateLeft = '100%';
                frameAni();
            }
            
            $slides.eq(newIndex).css({
                display: 'block',
                left: slideLeft
            });
            $group.animate({
                left: animateLeft
            }, function() {
                $slides.eq(currentIndex).css({
                display: 'none'
                });
                $slides.eq(newIndex).css({
                left: 0
                });
                $group.css({
                left: 0
                });
                currentIndex = newIndex;
            });
            }
            
            function advance() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                if (currentIndex < ($slides.length - 1)) {
                move(currentIndex + 1);
                } else {
                move(0);
                }
            }, 8000);
            }
            
            $.each($slides, function(index) {
            var $button = $('<a class="slide_btn"><p>' + (index + 1) + '</p></a>');

            if (index === currentIndex) {
                $button.addClass('active');
            }
            $button.on('click', function() {
                move(index);
            }).appendTo('.slide_buttons');
            bulletArray.push($button);
            });
            advance();
        });
        var $heightActive = $('.active').outerHeight();
        var $widthActive = $('.active').outerWidth();
        var $offset = $('.active').offset();
        function updateFrame(){ 
            $('.frame').css({'left': ($offset.left - 3)});
            $('.frame').height($heightActive);
            $('.frame').width($widthActive);

        }
        

        updateFrame();
        $( window ).on('resize',function() {
            var $offset = $('.active').offset();
            $('.frame').css({'left': ($offset.left - 3)});
            $('.frame').height($heightActive);
            $('.frame').width($widthActive);
        });
    }

    if ($('.members').length > 0) {
        //sort members by category
        function addMemberinfo(result){
            var img = "";
            function checkimg(){
                if(result[0].img == false){
                    img = "";
                }else{
                    img = result[0].img;
                }
            }
 
            checkimg();
            
            var area = result[0].area;
            var address = result[0].address;
            var home = result[0].home;
            var mail = result[0].mail;
            var name = result[0].name;
            var phone = result[0].phone;
            var zip = result[0].zip;
            var facebook = result[0].face;
            var text = result[0].text;

            $.fn.extend({
                checkdata : function(x) {
                    if(x==false ){
                        $(this).addClass('hidden'); 
                    }else{
                        $(this).removeClass('hidden');                  
                    }
                }
            });

            $('.member-pic').css("background-image", "url('"+img+"')");
            $('.member-name').text(name);
            var newArea = area.toString().replace(/,/g, " / ");
            $('.member-area').text(newArea).checkdata(newArea);
            $('.member-address').text(address).checkdata(address);
            $('.member-zip').text(zip).checkdata(zip);
            $('.member-text').html(text).checkdata(text);
            $('.member-web').attr("href", home).text(home).parent().checkdata(home);
            $('.member-mail').attr("href", 'mailto: ' + mail).text(mail).parent().checkdata(mail);
            $('.member-phone').attr("href", 'tel: ' + phone).text(phone).parent().checkdata(phone);
            $('.member-face').attr("href", facebook).parent().checkdata(facebook);
        }

        //find first memeber from list
        function featuredMember(){
            var firstLI = " ";
            $('.member-list li').each(function () {
                if ($(this).css('display') != 'none') {
                    firstLI = $(this);
                    return false;
                }
            });
            $('.active-member').removeClass('active-member');
            firstLI.addClass('active-member');
            
            var firstID = firstLI.find('a').attr('rel');
            var chosenOne = $.grep(jqueryarray, function(e){ return e.ID == firstID; });
            addMemberinfo(chosenOne);
        }
        
        featuredMember();

        //help style the list
        function findEvenLi(){
            $('.member-list li:visible').each(function(i){
                if((i+1) % 2 == 0){
                    $(this).addClass('greyLi');
                }else{
                    $(this).removeClass('greyLi');
                }
            });
        }
        
        findEvenLi();
        //sort memebers
        $('.member-sort').on('change', function(){
            var currentCat = $(this).parents().find('.member-sort').val();
            var medlemmer = $(this).parent().find('.post-link');
            
            function wordInString(s, word){
                return new RegExp( '\\b' + word + '\\b', 'i').test(s);
            }

            if (currentCat == 'Alle'){
                medlemmer.parent().show();
            }else{
                $.each(medlemmer, function(){
                    medlemscat = $(this).attr('data-cat');
                    var stringSearch = wordInString(medlemscat, currentCat);

                    if(stringSearch == true){
                        $(this).parent().show();
                    }else{
                        $(this).parent().hide();
                    }
                });
            }
        
            featuredMember();
            findEvenLi();
        });

        //get memberdetails
        $('.member-list li').click(function (){
            var id = $(this).find('a').attr('rel');
            var info = $.grep(jqueryarray, function(e){ return e.ID == id; });
            $('.active-member').removeClass('active-member');
            $(this).addClass('active-member');

            addMemberinfo(info);
        });
    }
	if ($('.udstillinger-page').length > 0){
	    $('.row-wrapper-left').each(function(){
	        if($(this).find('.col-full-4').length == 0){
	            $(this).find('.no-post').show();
	        }else{
	            $(this).find('.no-post').hide();
	        }
	    });
    }
	if ($('#primaryPostForm').length > 0){
        jQuery('#primaryPostForm').validate();
    }
});