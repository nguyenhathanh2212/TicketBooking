        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
        @include('admin.template.rightbar')
        <div class="control-sidebar-bg"></div>
    </div>
{{ Html::script(asset('vendor/jquery/dist/jquery.min.js')) }}
{{ Html::script(asset('vendor/jquery-ui-dist/jquery-ui.min.js')) }}
{{ Html::script(asset('vendor/bootstrap/dist/js/bootstrap.min.js')) }}
{{ Html::script(asset('vendor/moment/min/moment.min.js')) }}
{{ Html::script(asset('vendor/datetimepicker/build/js/bootstrap-datetimepicker.min.js')) }}
{{ Html::script(asset('admin/js/adminlte.min.js')) }}
</body>
</html>
