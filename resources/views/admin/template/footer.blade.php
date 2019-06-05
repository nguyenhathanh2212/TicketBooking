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
    {{ Html::script(asset('vendor/select2/dist/js/select2.full.min.js')) }}
    {{ Html::script(asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')) }}
    {{ Html::script(asset('vendor/jquery-validation/dist/jquery.validate.min.js')) }}
    {{ Html::script(asset('vendor/icheck/icheck.min.js')) }}
    {{ Html::script(asset('vendor/moment/min/moment.min.js')) }}
    {{ Html::script(asset('vendor/sweetalert/dist/sweetalert.min.js')) }}
    {{ Html::script(asset('messages.js')) }}
    {{ Html::script(asset('vendor/datetimepicker/build/js/bootstrap-datetimepicker.min.js')) }}
    {{ Html::script(asset('admin/js/adminlte.min.js')) }}
    {{ Html::script(asset('admin/js/main.js')) }}
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script type="text/javascript">
        var notificationsWrapper   = $('.notifications-menu');
        var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('.number-notify');
        var notificationsCount     = parseInt(notificationsCountElem.text());
        var notifications          = notificationsWrapper.find('ul.dropdown-menu ul.menu');
    
    
        // Enable pusher logging - don't include this in production
        //  Pusher.logToConsole = true;
    
        var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
            cluster: 'ap1',
            encrypted: true
        });
    
        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('Notify');
    
        // Bind a function to a Event (the full Laravel class)
        channel.bind('send-message', function(data) {
            var existingNotifications = notifications.html();
            var newNotificationHtml = `
                <li class="unread">
                    <a href="/admin-page/ticket/${data['ticket_id']}">
                        <i class="fa fa-ticket text-aqua"></i> <strong class="notification-title">${data.title}</strong>
                        ${data.content}<br>
                        <small>${data.created_at}</small>
                    </a>
                </li>
            `;
            notifications.html(newNotificationHtml + existingNotifications);
    
            notificationsCount += 1;
            notificationsCountElem.text(notificationsCount);
            notificationsWrapper.show();
        });
    </script>
    @stack('script')
</body>
</html>
