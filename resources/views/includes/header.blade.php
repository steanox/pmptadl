@if (isset($css))
	@foreach ($css as $css)
		<link rel="stylesheet" type="text/css" href="{{asset($css)}}"/>
	@endforeach
@endif
