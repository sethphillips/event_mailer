<ul class="list-inline sub-nav">
	
	<li>
		<a href="{!! URL::route('admin.touches.show',$touch->id) !!}"><i class="fa fa-dashboard"></i> Dashboard</a>
	</li>

	<li>
		<a href="{!! URL::route('admin.emails.new',$touch->id) !!}"><i class="fa fa-envelope"></i> Test Emails</a>
	</li>

	<li>
		<a href="{!! URL::route('admin.email.new',$touch->id) !!}"><i class="fa fa-envelope"></i> Single Test Email</a>
	</li>
</ul>