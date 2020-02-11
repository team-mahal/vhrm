@extends(backpack_view('layouts.top_left'))
@section('content')
	@php
		 $widgets['after_content'][] = [
		  'type' => 'div',
		  'class' => 'row',
		  'content' => [ // widgets 
		      [
			    'type'        => 'progress',
			    'wrapperClass' => 'col-sm-6 col-md-3',
			    'class'       => 'card text-white bg-primary mb-2',
			    'value'       => '11.456',
			    'description' => 'Total Sale',
			    'progress'    => 57, // integer
			    'hint'        => '8544 more until next milestone.',
			],
		      [
			    'type'        => 'progress',
			    'wrapperClass' => 'col-sm-6 col-md-3',
			    'class'       => 'card text-white bg-success mb-2',
			    'value'       => '11.456',
			    'description' => 'Registered users.',
			    'progress'    => 57, // integer
			    'hint'        => '8544 more until next milestone.',
			],
		    [
			    'type'        => 'progress',
			    'class'       => 'card text-white bg-warning mb-2',
			    'value'       => '11.456',
			    'wrapperClass' => 'col-sm-6 col-md-3',
			    'description' => 'Registered users.',
			    'progress'    => 57, // integer
			    'hint'        => '8544 more until next milestone.',
			],
			[
			    'type'        => 'progress',
			    'wrapperClass' => 'col-sm-6 col-md-3',
			    'class'       => 'card text-white bg-secondary mb-2',
			    'value'       => '11.456',
			    'description' => 'Registered users.',
			    'progress'    => 57, // integer
			    'hint'        => '8544 more until next milestone.',
			]
		  ]
		];
	@endphp
@endsection