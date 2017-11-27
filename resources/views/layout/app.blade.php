<html>

<head>

    <title>ADL - Project Management Tools</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>

    {{-- Global css --}}

    <link href="{{asset('css/global/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/global/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/global/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/global/uniform.default.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/global/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css">


    {{-- Pages css --}}

    <link href="{{asset('css/pages/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/pages/plugins.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/pages/layout.css')}}" rel="stylesheet" type="text/css"/>

    <link id="style_color" href="{{asset('css/pages/themes/grey.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/pages/custom.css')}}" rel="stylesheet" type="text/css"/>


    @include('includes.header')

</head>

<body class="page-header-fixed page-quick-sidebar-over-content">

@include('includes.headbar')

<div class="clearfix">

</div>

<div class="page-container">

    @include('includes.sidebar')

    @yield('content')

</div>

{{-- JQUERY CORE --}}

<script src="{{asset('js/jquery.min.js')}}"></script>

<script src="{{asset('js/jquery-migrate.min.js')}}"></script>


{{-- Global JS --}}

<script src="{{asset('js/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{asset('js/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}"></script>

<script src="{{asset('js/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{asset('js/jquery.blockui.min.js')}}"></script>

<script src="{{asset('js/jquery.cokie.min.js')}}"></script>

<script src="{{asset('js/uniform/jquery.uniform.min.js')}}"></script>

<script src="{{asset('js/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>


@include('includes.footer')

<script src="{{asset('js/metronic.js')}}"></script>

<script src="{{asset('js/layout.js')}}"></script>

<script src="{{asset('js/quick-sidebar.js')}}"></script>

<script src="{{asset('js/demo.js')}}"></script>


<script>

    jQuery(document).ready(function () {

        // initiate layout and plugins

        Metronic.init(); // init metronic core components

        Layout.init(); // init current layout

        QuickSidebar.init(); // init quick sidebar

        Demo.init(); // init demo features

    });


</script>


@yield('addjs')

</body>

</html>