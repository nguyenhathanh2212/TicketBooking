<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <table class="table-result table" border="1">
        <thead class="thead-default">
            <tr>
                <th>No.</th>
                <th>@lang('ticket.name')</th>
                <th>@lang('ticket.phone')</th>
                <th>@lang('ticket.email')</th>
                <th>@lang('ticket.payment_method')</th>
                <th>@lang('ticket.date_away')</th>
                <th>@lang('ticket.quantity')</th>
                <th>@lang('ticket.total_price')</th>
                <th>@lang('main.status')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->phone }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>
                        {{ $ticket->payment_method_str }}
                    </td>
                    <td>
                        {{ $ticket->date }}
                    </td>
                    <td>
                        {{ $ticket->quantity }}
                    </td>
                    <td>
                        {{ $ticket->price_format }}đ
                    </td>
                    <td>
                        {{ $ticket->status_str }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
