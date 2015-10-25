@extends('layouts.index')


@section('content')

<script>
	var id = '{{ $id }}';
	$.post('/action',{action:'website visit',id:id})
</script>

<div class="container">
	
	<div class="left bg"></div>
	<div class="right bg"></div>
	
	<div class="title-bar">
		<div class="logo">
			<a href="http://www.exhibitpartners.com" target="_blank"><img src="{!! asset('img/ep_logo.jpg') !!}" alt="EP_Logo" ></a>
		</div>
	</div>
	<div class="content">
		<div class="video-container">
			<video src="{!! asset('videos/halloween.mp4') !!}" id="Video" poster="{!! asset('img/halloween/placeholder.jpg') !!}" controls autoplay ></video>
		</div>
		<div class="video-extras">
			<div class="copyright">&copy; Copyright 2015 Exhibit Partners</div>
			<div class="social"><share-button></share-button></div>
		</div>

		
		<div class="buttons">
			
			
			<a href="moreinfo" >
				<button class="btn skip-video">Love it! Tell me more!</button>
			</a>
							
		</div>
	</div>
</div>

<script>
	var video = document.getElementById('Video');

	video.addEventListener('ended',videoEnded);

	function videoEnded()
	{
		window.location.href = '{{ URL::route('moreinfo') }}'
	}
</script>

@stop