@extends('layouts.index')


@section('content')


<div class="container">
	
	<div class="left bg"></div>
	<div class="right bg"></div>
	
	<div class="title-bar">
		<div class="logo">
			<a href="http://www.exhibitpartners.com" target="_blank"><img src="{!! asset('img/ep_logo.jpg') !!}" alt="EP_Logo" ></a>
		</div>
	</div>
	<div class="content two">
		<h1>{{ $message }}</h1>
	</div>
</div>



@stop