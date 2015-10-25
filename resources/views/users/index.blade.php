@extends('layouts/admin')




@section('title')
Users
@stop

@section('action')
	{!! link_to('admin/users/create','New User',array('class'=>'btn btn-success'))!!}
@stop

@section('content')

	<table class="table tablehover table-striped">
	<tr>
		<th>User Name</th>
		<th>User Email</th>
		<th></th>
		<th></th>
	</tr>
	@if($users->count())
		@foreach ($users as $key => $user) 

			<tr>
				<td>{{ $user->name }}</td>
				<td>{{$user->email}}</td>
				<td>
					{!! link_to_route('admin.users.edit','edit',$user->id,array('class'=>'btn btn-primary'))!!}
				</td>
				<td>
					{!! Form::open( array( 'route'=>array('admin.users.destroy',$user->id),'method'=>'delete','onsubmit'=>'return deleteSubmit();' ) ) !!}
					
					{!! Form::submit('delete',array('class'=>'btn btn-danger'))!!}

					{!! Form::close()!!}
				</td>
			</tr>


		@endforeach

	@else

		<tr class="danger">
			<td colspan="4" >No Users Found!!</td>
		</tr>
		
	@endif

	</table>


@stop
