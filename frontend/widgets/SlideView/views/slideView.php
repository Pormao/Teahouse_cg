<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;
use yii\helpers\Url;
use common\helpers\postApis;

/* @var $this \yii\web\View */
/* @var $user \common\models\LoginForm */
/* @var $title string */
$this->registerJs('
			(function($){
				$.fn.ckSlide = function(opts){
					opts = $.extend({}, $.fn.ckSlide.opts, opts);
					this.each(function(){
						var slidewrap = $(this).find(\'.ck-slide-wrapper\');
						var slide = slidewrap.find(\'li\');
						var count = slide.length;
						var that = this;
						var index = 0;
						var time = null;
						$(this).data(\'opts\', opts);
						// next
						$(this).find(\'.ck-next\').on(\'click\', function(){
							if(opts[\'isAnimate\'] == true){
								return;
							}
							
							var old = index;
							if(index >= count - 1){
								index = 0;
							}else{
								index++;
							}
							change.call(that, index, old);
						});
						// prev
						$(this).find(\'.ck-prev\').on(\'click\', function(){
							if(opts[\'isAnimate\'] == true){
								return;
							}
							
							var old = index;
							if(index <= 0){
								index = count - 1;
							}else{                                      
								index--;
							}
							change.call(that, index, old);
						});
						$(this).find(\'.ck-slidebox li\').each(function(cindex){
							$(this).on(\'click.slidebox\', function(){
								change.call(that, cindex, index);
								index = cindex;
							});
						});
						
						// focus clean auto play
						$(this).on(\'mouseover\', function(){
							if(opts.autoPlay){
								clearInterval(time);
							}
							$(this).find(\'.ctrl-slide\').css({opacity:0.6});
						});
						//  leave
						$(this).on(\'mouseleave\', function(){
							if(opts.autoPlay){
								startAtuoPlay();
							}
							$(this).find(\'.ctrl-slide\').css({opacity:0.15});
						});
						startAtuoPlay();
						// auto play
						function startAtuoPlay(){
							if(opts.autoPlay){
								time  = setInterval(function(){
									var old = index;
									if(index >= count - 1){
										index = 0;
									}else{
										index++;
									}
									change.call(that, index, old);
								}, 2000);
							}
						}
						// 修正box
						var box = $(this).find(\'.ck-slidebox\');
						box.css({
							\'margin-left\':-(box.width() / 2)
						})
						// dir
						switch(opts.dir){
							case "x":
								opts[\'width\'] = $(this).width();
								slidewrap.css({
									\'width\':count * opts[\'width\']
								});
								slide.css({
									\'float\':\'left\',
									\'position\':\'relative\'
								});
								slidewrap.wrap(\'<div class="ck-slide-dir"></div>\');
								slide.show();
								break;
						}
					});
				};
				function change(show, hide){
					var opts = $(this).data(\'opts\');
					if(opts.dir == \'x\'){
						var x = show * opts[\'width\'];
						$(this).find(\'.ck-slide-wrapper\').stop().animate({\'margin-left\':-x}, function(){opts[\'isAnimate\'] = false;});
						opts[\'isAnimate\'] = true
					}else{
						$(this).find(\'.ck-slide-wrapper li\').eq(hide).stop().animate({opacity:0});
						$(this).find(\'.ck-slide-wrapper li\').eq(show).show().css({opacity:0}).stop().animate({opacity:1});
					}
				   
					$(this).find(\'.ck-slidebox li\').removeClass(\'current\');
					$(this).find(\'.ck-slidebox li\').eq(show).addClass(\'current\');
				}
				$.fn.ckSlide.opts = {
					autoPlay: false,
					dir: null,
					isAnimate: false
				};
			})(jQuery);
			
			
			$(\'.ck-slide\').ckSlide();
', View::POS_END);

$this->registerCss('
		.ck-slide ul.ck-slide-wrapper img { width:100%; height: 100%; border: 0;}
		.ck-slide ul { width:100%; margin: 0; padding: 0; list-style-type: none;}
		.ck-slide { position: relative; overflow: hidden;}
		.ck-slide ul.ck-slide-wrapper { position: absolute; top: 0; left: 0; z-index: 1; margin: 0; padding: 0;}
		.ck-slide ul.ck-slide-wrapper li { width:100%; height: 100%; position: absolute;}
		.ck-slide ul.ck-slide-wrapper li a { width:100%; height: 100%;}
		.ck-slide .ck-prev, .ck-slide .ck-next { position: absolute; top: 50%; z-index: 2; width: 35px; height: 70px; margin-top: -35px; border-radius: 3px; opacity: .15; background: red; text-indent: -9999px; background-repeat: no-repeat; transition: opacity .2s linear 0s;}
		.ck-slide .ck-prev { left: 5px; background: url(../images/arrow-left.png) #000 50% no-repeat;}
		.ck-slide .ck-next { right: 5px; background: url(../images/arrow-right.png) #000 50% no-repeat;}
		.ck-slidebox { position: absolute; right: 5%; bottom: 12px; z-index: 30;}
		.ck-slidebox ul {
		}
		.ck-slidebox ul li { float: left; height: 12px; margin: 4px 2px 0px 10px;}
.ck-slidebox ul li em {
	display: block;
    width: 8px;
    height: 8px;
    border-radius: 100%;
    border: 2px solid rgb(255, 255, 255);
    background-color: #fff;
    text-indent: -9999px;
    cursor: pointer;
	}
		.ck-slidebox ul li.current em { background-color: #fe6500;}
		.ck-slidebox ul li em:hover { background-color: #fe6500;}
		.slide-title { 
	width: 95%;
    height: 22px;
    z-index: 999;
    color: #FFF;
    font-size: 15px;
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    position: relative;
    top: -50%;
    left: 10px;
		}
		
		
.ck-slide {
	margin: 4px;
    width: 400px;
    height: 193px;
    float: left;
    border-radius: 4px;
    overflow: hidden;
	}
		.ck-slide ul.ck-slide-wrapper { height: 320px;}
');
?>

<div class="ck-slide">
			<ul class="ck-slide-wrapper">
			<?php foreach ($certThreadList as $model): ?>
				<li <?php @$n++;if($n!==1){echo 'style="display:none;"';} ?>>
					<a href="<?= Html::encode(Url::to(['/forum/m/p','t' => Yii::$app->params['postHeaderId']+$model['Id']],true)) ?>">
					<div style="height: 100%;">
					<img src="<?=@postApis::getpic($model['post_content'])[0] ?>" alt="">
					<div class="slide-title"><?=Html::encode($model['post_title']) ?></div>
					</div>
					</a>
				</li>
			<?php endforeach ?>
				
			</ul>
			<a href="javascript:" class="ctrl-slide ck-prev">上一张</a> <a href="javascript:" class="ctrl-slide ck-next">下一张</a>
			<div class="ck-slidebox">
				<div class="slideWrap">
					<ul class="dot-wrap">
			<?php foreach ($certThreadList as $model): ?>
				 <?php @$n1++;if($n1==1){$class='class="current"';}else{$class='';} echo '<li '.@$class.'><em>'.$n1.'</em></li>'; ?>
			<?php endforeach ?>
					
					</ul>
				</div>
			</div>
		</div>