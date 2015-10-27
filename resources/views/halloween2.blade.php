@extends('layouts.index')


@section('content')

<script>
	var id = '{{ $id }}';
	$.post('/action',{action:'more info',id:id})
</script>

<div class="container">
	
	<div class="left bg two"></div>
	<div class="right bg two"></div>
	
	<div class="title-bar">
		<div class="logo">
			<a href="http://www.exhibitpartners.com" target="_blank"><img src="{!! asset('img/ep_logo.jpg') !!}" alt="EP_Logo" ></a>
		</div>
	</div>
	<div class="content two">
		<div class="message">
				
			<h1>Don’t Get Caught Empty-Handed</h1>
			<hr>
			<p>
				We see it all the time, the scramble for quality content: The design is a knock-out, the messaging is on point, expectations are high... and you’re stuck with a few PowerPoint slides for your 10ft video wall.
			</p>
			<p>
				Don’t sacrifice your story to an overstretched marketing team or a last-minute agency rush.
			</p>
			<p>
				We tell your story through space, now let us bring it to life with motion graphics, interactive &amp; web-based content.
			</p>
			<div class="buttons">
				<a href="mailto:jeff@exhibitpartners.com" >
				<button class="btn work-with-us">Work With Us</button>
				</a>
				
				<a href="https://www.youtube.com/channel/UC3m0m9RsklRWIGxu2Mb3ntw" target="_blank">
				<button class="btn see-more">See More</button>
				</a>
				
				<a href="http://www.exhibitpartners.com" target="_blank">
				<button class="btn website">Website</button>
				</a>

				<a href="{!! URL::route('video') !!}" >
				<button class="btn watch-again">Watch Again</button>
				</a>
								
			</div>
			
		</div>
	</div>
</div>

@stop