@extends(backpack_view('blank'))
@php
    $widgets['before_content'][] = [
	    'type'        => 'progress',
	    'wrapperClass' => 'col-sm-6 col-md-4',
	    'class'       => 'card text-white bg-primary mb-2',
	    'value'       => '11.456',
	    'description' => 'Registered users.',
	    'progress'    => 57, // integer
	    'hint'        => '8544 more until next milestone.',
	];

	$widgets['before_content'][] = [
	    'type'        => 'progress',
	    'wrapperClass' => 'col-sm-6 col-md-4',
	    'class'       => 'card text-white bg-success mb-2',
	    'value'       => '11.456',
	    'description' => 'Registered users.',
	    'progress'    => 57, // integer
	    'hint'        => '8544 more until next milestone.',
	];

	$widgets['before_content'][] = [
	    'type'        => 'progress',
	    'class'       => 'card text-white bg-warning mb-2',
	    'value'       => '11.456',
	    'description' => 'Registered users.',
	    'progress'    => 57, // integer
	    'hint'        => '8544 more until next milestone.',
	];

	$widgets['before_content'][] = [
	    'type'        => 'progress',
	    'class'       => 'card text-white bg-secondary mb-2',
	    'value'       => '11.456',
	    'description' => 'Registered users.',
	    'progress'    => 57, // integer
	    'hint'        => '8544 more until next milestone.',
	];
@endphp
@section('content')
@endsection