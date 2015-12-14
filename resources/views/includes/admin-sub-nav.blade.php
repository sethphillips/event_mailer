<ul class="list-inline sub-nav">
	
	<li>
		<a href="{!! URL::route('admin.campaigns.show',$campaign->id) !!}"><i class="fa fa-dashboard"></i> Dashboard</a>
	</li>

	<li>
		<a href="{!! URL::route('admin.emails.new',$campaign->id) !!}"><i class="fa fa-envelope"></i> Create Emails</a>
	</li>

	<li>
		<a href="{!! URL::route('admin.email.new',$campaign->id) !!}"><i class="fa fa-envelope"></i> Single Email</a>
	</li>
</ul>