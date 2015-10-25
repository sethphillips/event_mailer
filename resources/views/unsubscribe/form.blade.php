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
		@if( isset($message) )
			<h1>{{ $message }}</h1>
		@endif
		<form action="{{ URL::route('unsubscribe.submit') }}" method="post" class='form buttons'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="email" name="email" class="form-control" placeholder="enter your email">
			<input type="submit" value="Unsubscribe" class="btn">
		</form>
	</div>
</div>



@stop