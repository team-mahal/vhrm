<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
{{-- <li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li> --}}
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-group"></i> Authentication</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon fa fa-user"></i> <span>Users</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon fa fa-group"></i> <span>Roles</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon fa fa-key"></i> <span>Permissions</span></a></li>
	</ul>
</li>
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-group"></i> Setups</a>
	<ul class="nav-dropdown-items">
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('client') }}'><i class='nav-icon fa fa-question'></i> Clients</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('project') }}'><i class='nav-icon fa fa-question'></i> Projects</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('issue') }}'><i class='nav-icon fa fa-question'></i> Issues</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('task') }}'><i class='nav-icon fa fa-question'></i> Tasks</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('department') }}'><i class='nav-icon fa fa-question'></i> Departments</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('designation') }}'><i class='nav-icon fa fa-question'></i> Designations</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('notice') }}'><i class='nav-icon fa fa-question'></i> Notices</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('weekend') }}'><i class='nav-icon fa fa-question'></i> Weekends</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('holiday') }}'><i class='nav-icon fa fa-question'></i> Holidays</a></li>
	</ul>
</li>
