<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    @php
        $paypal = $tickets->where('payment_method', config('setting.ticket.payment_method.paypal'))
            ->where('status', config('setting.ticket.status.active'));
        $direct = $tickets->where('payment_method', config('setting.ticket.payment_method.direct'))
            ->where('status', config('setting.ticket.status.active'));
        $paypalCount = $paypal->count();
        $totalPrePay = $paypal->sum('total_price');
        $directCount = $direct->count();
        $totalNotPayYet = $direct->sum('total_price');
        // dd($paypalCount, $totalPrePay, $directCount, $totalNotPayYet);
    @endphp
    <table class="table table-hover table-record"
        style="
            border: 1px solid #ddd;
            width: 30%;
            float: right;
            margin: 10px;
        ">
        <tbody>
            <tr>
                <th></th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
            <tr>
                <td>Đã thanh toán: </td>
                <td>{{ $paypalCount }}</td>
                <td>{{ number_format($totalPrePay, 2) }}đ</td>
            </tr>
            <tr>
                <td>Chưa thanh toán</td>
                <td>{{ $directCount }}</td>
                <td>{{ number_format($totalNotPayYet, 2) }}đ</td>
            </tr>
        </tbody>
    </table>
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
