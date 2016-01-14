<ul class="list-inline sub-nav">
	
	<li>
		<a href="{!! URL::route('admin.campaigns.show',$campaign->id) !!}"><i class="fa fa-dashboard"></i> Dashboard</a>
	</li>

	<li>
		<a href="{!! URL::route('admin.campaign.contacts.new',$campaign->id) !!}"><i class="fa fa-group"></i> Add Contacts</a>
	</li>

	<li>
		<a href="{!! URL::route('admin.campaign.contact.new',$campaign->id) !!}"><i class="fa fa-user"></i> Add a Contact</a>
	</li>
</ul>