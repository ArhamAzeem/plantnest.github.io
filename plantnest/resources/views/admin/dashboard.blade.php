@extends('admin.layout.adminapp')

@section('app_content')
@includeIf('admin.layout.sidebar')

       <!-- Content Wrapper -->
       <div id="content-wrapper" class="d-flex flex-column">

           <!-- Main Content -->
           <div id="content">

               <!-- Topbar -->
               @includeIf('admin.layout.topbar')
               <!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Main Content -->
@yield('main_content')

</div>
<!-- /.container-fluid -->

           </div>
           <!-- End of Main Content -->

@endsection
