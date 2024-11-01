(function($){

	var k = function(o){
		console.log(o);
	};

	//pass (#ffffff, 0.3), return rgba(255,255,255,0.3)
	var h2b = function(hex, a) {
	    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	    if(result){
	    	r = parseInt(result[1], 16);
	    	g = parseInt(result[2], 16);
	    	b = parseInt(result[3], 16);
	    	return "rgba("+ r +","+ g +"," + b +","+ a +")";
	    }
	};

	$(function(){

		var yass = function($el, index){

			// globle variables
			var s = this;
			var sc = s.config = {}; 
			s.id = 'yass'+index;

			s.$el = $el;
			s.index = index;
			

			s.timer = function(){

				var time = sc.auto_slide_time*0.9,  

					rate = 10,

					pace = 2*rate/time, 

					a1, 
					a2,
					s1,
					s2,
					t,
					pi = Math.PI;

				var self = this;

				s1 = 0;
				s2 = pace;

				self.draw = function(){
					s.ctx.beginPath();
					s.ctx.arc(17,17,8, a1*pi, a2*pi);
					s.ctx.stroke();

					a1 += pace;
					a2 += pace;
					if(a1 > 2){
						clearInterval(t);				
						self.reset();
					}
				};

				self.start = function(){
					self.reset();
					t = setInterval(self.draw, rate);
				};

				self.continue = function(){
					t = setInterval(self.draw, rate);
				};

				self.stop = function(){
					clearInterval(t);
				};

				self.reset = function(){
					a1 = s1;
					a2 = s2;
					s.ctx.clearRect(0, 0, s.canvas.width, s.canvas.height);
					clearInterval(t);
				};

				self.init = function(){
					s.$container.append('<div class="timer '+(sc.auto_slide === 'true' ? '' : 'hide')+'"><div class="pause"></div></div>');
					s.$timer = s.$container.find('.timer');
					s.$caption = $(s.$container.find('.rsGCaption'));

					s.sliderInstance = s.$container.data('royalSlider');


					//bind event
					s.sliderInstance.ev.on('rsBeforeAnimStart', function() {
					    s.$caption.removeClass('transform').hide();
					});

					s.sliderInstance.ev.on('rsAfterSlideChange', function() {
					

						if(s.$caption.text() !== ''){
							s.$caption.fadeIn(function(){
								s.$caption.addClass('transform');
							});
						}
						
						self.start();
					});

					s.$timer.bind({

						click: function(){
							var thisT;

							if($(this).hasClass('stopAuto')){

								$(this).removeClass('stopAuto');

								s.sliderInstance.startAutoPlay();

								if(sc.auto_slide === 'false'){
									self.start();

								}else{

									self.continue();
								}
								
							}else{

								$(this).addClass('stopAuto');

								s.sliderInstance.stopAutoPlay();
								clearInterval(thisT);
								self.stop();
							}
						}
					});

					//add spinner
					s.canvas = document.createElement('canvas');
					s.$canvas= $(s.canvas);

					if(s.canvas.getContext && s.canvas.getContext('2d')){
						s.$canvas.attr('class', 'spinner');
						s.canvas.width = 34;
						s.canvas.height = 34;
						s.ctx = s.canvas.getContext('2d');
						s.ctx.strokeStyle = 'rgba(255,255,255,1)';
						s.ctx.lineCap = 'butt';
						s.ctx.lineWidth = 18;

						s.$timer.append(s.canvas);
					}

					if(sc.auto_slide === 'true'){
						self.start();
					}

				};

				self.init();
			};

			s.addStyle = function(el, obj){
				return $('#'+s.id + ' ' +el).css(obj)
			}


			s.sliderFix = function(){
				var ifRoyal = setInterval(function(){

					if(s.$container.find('.rsImg').length !== 0){

						clearInterval(ifRoyal);

						s.$container.find('.rsArrowRight div').text('>');
						s.$container.find('.rsArrowLeft div').text('<');
						s.$container.find('.rsGCaption').addClass('transform');
						if($(s.$container.find('.rsGCaption')).text() == ''){
							$(s.$container.find('.rsGCaption')).hide();
						}

						var imgArray = s.$container.find('.rsTab');
						var imgNum = imgArray.length;

						if(imgNum > 8 && sc.nav_style === 'pager'){
							s.$container.find('.rsNav').wrap('<div id="navOverflow" />');
							var navContainer = $(s.$container.find('#navOverflow'));
							navContainer.append('<div class="navOverLeft navOvernav" data-dir="left"><<</div><div class="navOverRight navOvernav" data-dir="right">>></div>');
							var nav = navContainer.find('.navOvernav');
							var navInner = $(s.$container.find('.rsTabs'));
							var leftLimt = imgNum-8;
							var rightLimt = 0;
							var currentNav = 0;
							var navScroll = function(dir){

								var cssAnimate = function(){
									navInner.animate({
										'margin-left': currentNav * 31
									});
								};

								switch(dir){
									case 'left':
										
										if(currentNav !== 0){
											currentNav++;
											cssAnimate();
										}
										break;

									case 'right':
										if(currentNav > -leftLimt){
											currentNav--;
											cssAnimate();
										}
									 	break;

									default:
										return false;
										break;
								}
							};

							$(nav).bind('click', function(){	
								navScroll($(this).data('dir'));
							})
						}
						for(var i = 1; i <= imgNum; i++){
							var k = i-1;
							if(i < 10){
								i = "0" + i;
							}
							$(imgArray[k]).text(i);
						}

						s.timer();
						s.render();
					}
				}, 200);
			};

			s.build = function(){

				s.$el.wrap('<div class="royalSlider" style="width:'+sc.width+'; height:'+sc.height+'; background-color:'+sc.bgColor+'" id="'+s.id+'" />');
				s.$container = s.$el.parent('.royalSlider');
				s.$container.empty().append(s.imgTpl);
				s.$container.royalSlider(s.sliderOpts);
				s.sliderFix();
			};

			s.render = function(){
				s.addStyle('.rsOverflow', {'border' : sc.borderSize+' solid '+sc.borderColor});
				s.addStyle('.rsArrow', {'color': h2b(sc.arrowColor, sc.arrow_alpha)});
				s.addStyle('.rsArrowRight', {'text-align':'right'});
				// s.addStyle('.rsArrow:hover', {'color': h2b(sc.arrowColor, 1)});
				s.addStyle('.rsNav', {'text-align': 'center'});
				s.addStyle('.rsTab', {'text-align': 'center'});

				if(sc.scalling === 'false'){
					s.addStyle('.rsImg', {'width': 'auto'});
					s.addStyle('.rsImg', {'max-width': 'none'});
				}else{
					s.addStyle('.rsSlide img', {'max-width': '100%'});
				}

				if(sc.show_desc === 'false'){
					// s.addStyle('.rsGCaption', {'display' : 'none'});
				}else{
					s.addStyle('.rsGCaption', {'background' : h2b(sc.desc_bg, sc.desc_alpha), 'color' : sc.desc_text_color, 'font-size' : sc.desc_text_size});
				}

				var style = '<style>'+
								'#'+s.id+' .rsNav.rsBullets .rsNavSelected{background: '+h2b(sc.nav_highlight_bg, sc.nav_alpha)+'}'+
								'#'+s.id+' .rsNav.rsBullets div{background: '+h2b(sc.nav_bg, sc.nav_alpha)+'; border-color: '+h2b(sc.nav_fg, sc.nav_alpha)+'}'+
								'#'+s.id+' .rsTab{background: '+h2b(sc.nav_bg, sc.nav_alpha)+'; border-color: '+h2b(sc.nav_fg, sc.nav_alpha)+'}'+
								'#'+s.id+' .navOvernav{background: '+h2b(sc.nav_bg, 1)+'; color:#ffffff; border-color: '+h2b(sc.nav_fg, sc.nav_alpha)+'}'+
								'#'+s.id+' .rsTab.rsNavSelected{background: '+h2b(sc.nav_highlight_bg, sc.nav_alpha)+'; color: '+sc.nav_highlight_text_color+'}'+
								// '#'+s.id+' .rsTab:hover{background: '+h2b(sc.nav_bg_hover, sc.nav_alpha)+'; color: '+sc.nav_fg_hover+'}'+
								'#'+s.id+' .rsGCaption{text-align: '+sc.desc_pos+'}'+
								'#'+s.id+' .royalSlider .rsNav{text-align: center}'+
							'</style>';
				$('head').append(style);

			};

			s.parseXml = function(xml){

				s.$settings = $($(xml).find('settings'));
				s.$slider = s.$settings.find('slider');
				s.$desc = s.$settings.find('description');
				s.$navbar = s.$settings.find('navbar');

				s.config = {
					'width'                    : s.$slider.attr('width') + 'px',
					'height'                   : s.$slider.attr('height') + 'px',
					'bgColor'                  : '#' + s.$slider.attr('bgColor'),

					'transition_speed'         : Number(s.$settings.find('transition_speed').text()),
					'scalling'                 : s.$slider.attr('scalling'),

					'borderSize'               : s.$settings.find('border').attr('size') + 'px',
					'borderColor'              : '#' + s.$settings.find('border').text(),

					'arrowColor'               : '#' + s.$settings.find('arrow').text(),
					'arrow_alpha'              : s.$settings.find('arrow_alpha').text(),

					'auto_slide'               : s.$settings.find('auto_slide').attr('on'),
					'auto_slide_time'          : Number(s.$settings.find('auto_slide').text())*1000,

					'show_desc'                : s.$desc.attr('on'),
					'desc_bg'                  : '#' + s.$desc.find('background').text(),
					'desc_alpha'               : s.$desc.find('alpha').text(),
					'desc_text_color'          : '#' + s.$desc.find('text').text(),
					'desc_text_size'           : s.$desc.find('size').text() + 'px',

					// 'nav_style'                : s.$navbar.attr('style'),
					'nav_style'                : 'compact',
					'nav_bg'                   : '#' + s.$navbar.find('background').text(),
					'nav_fg'                   : '#' + s.$navbar.find('foreground').text(),
					'nav_highlight_bg'         : '#' + s.$navbar.find('highlight').text(),
					'nav_highlight_text_color' : '#' + s.$navbar.find('highlight_text').text(),
					'nav_bg_hover'             : '#' + s.$navbar.find('bg_mouseover').text(),
					'nav_fg_hover'             : '#' + s.$navbar.find('fg_mouseover').text(),
					'nav_alpha'                : s.$navbar.find('alpha').text(),

					'desc_pos'                 : s.$slider.attr('desc_pos'),
					'target'                   : s.$slider.attr('target')
				};

				sc = s.config;
				
				s.sliderOpts = {
					keyboardNavEnabled : false,
					imageScaleMode     : sc.scalling === 'true' ? 'fill' : 'none',
					imageAlignCenter   : 'false',
					controlNavigation  : sc.nav_style === 'pager' ? 'tabs' : 'bullets',
					arrowsNavAutoHide  : false,
					transitionSpeed    : sc.transition_speed,
					globalCaption      : sc.show_desc === 'true' ? true : false ,
					autoPlay           : {
						enabled: sc.auto_slide === 'true' ? true : false,
						delay: sc.auto_slide_time,
						pauseOnHover : false,
						stopAtAction : false
					},
					thumbs             : {
						transitionSpeed: 0
					}
				};

				//loop pictures
				s.npic = $(xml).find('picture');
				s.imgTpl = '';

				for(var i = 0; i < s.npic.length; i++){
					var $img = $(s.npic[i]);
					s.imgTpl += '<a target="'+sc.target+'" href="'+$img.find('link').text()+'" ><img class="rsImg" src="' + $img.attr('src') + '" alt="' + $img.find('description').text() + '"></a>';
				}

				if(sc && s.imgTpl){
					s.build();
				}

			};

			// initialize function
			s.init = function(){
				
				s.xmlPathb = s.$el.attr('flashvars');
				s.xmlPath = s.xmlPathb.replace('dataFile=', '');

				$.ajax({
				  type: "GET",
				  url: s.xmlPath,
				  dataType: "xml",
				  success: s.parseXml
				});
			};

			s.init();

		};

		$('body').find('embed').each(function(index){
			new yass($(this), index);
		});
	});
})(jQuery);