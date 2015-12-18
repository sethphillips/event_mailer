<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Happy Holidays!</title>
	<script src="{!! asset('dist/vitality_xmas.js') !!}"></script>
	<style>
		body{
			background-image: url('/img/vitality/holiday_bg.jpg');
			background-position: top center;
			background-repeat:no-repeat;
		}
		.video-container{
			margin-top:200px;
		}
		video{
			width: 784px;
			display: block;
			margin:auto;
			left:25%;
			top:200px;
			border:25px solid white;
		}
		#snowflake-wrapper{
			z-index: -1;
		  position:absolute;
			width:100%;
			height: 100%;
			top:0;
			left:0;
		  background:transparent;
		  overflow:hidden;
		}


		/*Snowflakes*/
		.snowflake{
			position: absolute;
			opacity: 1;
			width:20px;
			height: 20px;
			background:  url(http://www.toymakerlabs.com/snowflakes/snowflake-sprite.png);
		  background-size:300%;
		  -webkit-transform: translate3d(0,0,0);
		  -moz-transform: translate3d(0,0,0);
		  -ms-transform: translate3d(0,0,0);
		  -o-transform: translate3d(0,0,0);
		  transform: translate3d(0,0,0);
		}

		.s0{background-position: 0}
		.s1{background-position:  -100%}
		.s2{background-position: -200%}
	</style>
</head>
<body>
	<div id="snowflake-wrapper"></div>
	<div class="video-container">
		<video id="video" src="{!! asset('videos/holiday_video.mp4') !!}" id="Video" poster="{!! asset('videos/holiday_frame.jpg') !!}" controls ></video>
	</div>
</body>
	<script>
		var video = document.getElementById('video');
		video.addEventListener('click',play);
		function play(){
			video.play();
		}

		var Snow = (function(){
			var w = $(window).width(),
			  h = $(window).height(),
			  startPos = {x:0,y:50},
			  numFlakes = 50;

			//attach the snowflakes
			for (var i=0;i<numFlakes;i++){	
			var flake = $("<div />").attr("class", "snowflake "+"s"+(i%3));
			flake.css({top:startPos.y,left:Math.random()*w,opacity:0});
			// flake.css({transform:"translate3d("+startPos.y+"px,"+Math.random()*w+"px,0)",opacity:0});
			$("#snowflake-wrapper").append(flake);
			}

			function animate(){
			var snowflakes = $(".snowflake");

			for (var i=0;i<snowflakes.length;i++){
			   var point0 = {left:Math.random()*w+20,top:startPos.y},
			      point1 = {left:Math.random()*w-200,top:Math.random()*h-20},
			      point2 = {left:Math.random()*w,top:h+100};


			  TweenMax.to(snowflakes[i], 10, {
			    delay:0.8*i,bezier:{
			      curviness:1.2, values:[point0,point1,point2], autoRotate:true},
			      opacity:0.8,repeat:-1,ease:Power1.easeOut
			  });
			}
			}

			$(window).resize(function(){
			w = $(window).width();
			h = $(window).height();
			})

			animate();

		})();
	</script>
</html>