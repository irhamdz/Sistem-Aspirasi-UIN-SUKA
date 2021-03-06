				$(function stack () { 
				// Stack initialize
				var openspeed = 300;
				var closespeed = 300;
				$('.stack>img').toggle(function(){
					var vertical = 0;
					var horizontal = 0;
					var $el=$(this);
					$el.next().children().each(function(){
						$(this).animate({top: '-' + vertical + 'px', left: horizontal + 'px'}, openspeed);
						vertical = vertical + 30;
						horizontal = (horizontal+.75)*2;
					});
					$el.next().animate({top: '-20px', left: '10px'}, openspeed).addClass('openStack')
					   .find('li a>img').animate({width: '50px', marginLeft: '9px'}, openspeed);
					$el.animate({paddingTop: '0'});
				}, function(){
					//reverse above
					var $el=$(this);
					$el.next().removeClass('openStack').children('li').animate({top: '55px', left: '-10px'}, closespeed);
					$el.next().find('li a>img').animate({width: '15px', marginLeft: '0'}, closespeed);
					$el.animate({paddingTop: '35'});
				});
	
				// Stacks additional animation
				$('.stack li a').hover(function(){
					$("img",this).animate({width: '25px'}, 100);
				$("span",this).animate({marginRight: '30px'});
				},function(){
			$("img",this).animate({width: '25px'}, 100);
			$("span",this).animate({marginRight: '0'});
				});
			});