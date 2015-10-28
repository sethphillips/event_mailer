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
				We see it all the time; Your marketing team is​ over-stretched and ​has to scramble for content - any content.
			</p>
			<p>
				Don't settle when the stakes are high - call us!
			</p>
			<p></p>
			<p>
				Let us bring your space to life with motion graphics, interactive and web-based content.
			</p>
			<div class="buttons">
				<a href="mailto:jeff@exhibitpartners.com" >
				<button class="btn work-with-us">Contact Us</button>
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