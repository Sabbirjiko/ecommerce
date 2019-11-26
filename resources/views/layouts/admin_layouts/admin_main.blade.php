<!DOCTYPE html>
<html lang="en">
<head>
<title>Matrix Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
@include('layouts.admin_layouts.admin_css')
</head>
<body>

@include('layouts.admin_layouts.admin_header')
<!--sidebar-menu-->
@include('layouts.admin_layouts.admin_leftnav')
<!--sidebar-menu-->

<!--main-container-part-->
@yield('content')
<!--end-main-container-part-->

<!--Footer-part-->

@include('layouts.admin_layouts.admin_footer')

<!--end-Footer-part-->
@include('layouts.admin_layouts.admin_js')

</body>
</html>
