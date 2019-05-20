@include('admin.template.header')
@include('admin.template.sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @yield('header')
    </section>
    <!-- Main content -->
    <section class="content">
        @yield('main_content')
    </section>
    <!-- /.content -->
</div>
@include('admin.template.footer')
