@if (isset($js))
	@foreach ($js as $js)
		<script  src="{{asset($js)}}"></script>
	@endforeach
@endif
