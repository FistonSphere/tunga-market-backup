@php
    $gs = \App\Models\GeneralSetting::first();
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: #fff;
            text-align: center;
            padding: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            background: #f9fafb;
            padding: 20px;
        }

        .stat {
            text-align: center;
        }

        .stat h3 {
            margin: 0;
            font-size: 22px;
            color: #2563eb;
        }

        .stat p {
            font-size: 13px;
            color: #666;
        }

        .content {
            padding: 30px;
        }

        .growth {
            text-align: center;
            padding: 10px;
            background:
                {{ $report['growth'] >= 0 ? '#ecfdf5' : '#fef2f2' }}
            ;
            color:
                {{ $report['growth'] >= 0 ? '#16a34a' : '#dc2626' }}
            ;
            border-radius: 12px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
            color: #2563eb;
        }

        .footer {
            background: #f8fafc;
            text-align: center;
            font-size: 13px;
            color: #888;
            padding: 15px;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ $title }}</h1>
            <p>{{ $report['start'] }} → {{ $report['end'] }}</p>
        </div>

        <div class="stats">
            <div class="stat">
                <h3>{{ $report['total'] }}</h3>
                <p>Total Notifications</p>
            </div>
            <div class="stat">
                <h3>{{ $report['byType']->count() }}</h3>
                <p>Notification Types</p>
            </div>
            <div class="stat">
                <h3>{{ $report['growth'] }}%</h3>
                <p>Growth Rate</p>
            </div>
        </div>

        <div class="content">
            <div class="growth">
                {{ $report['growth'] >= 0 ? '📈 Growth detected — great job!' : '📉 Decline — review user activity!' }}
            </div>

            <h3>📊 Breakdown by Type</h3>
            <table>
                <tr>
                    <th>Type</th>
                    <th>Count</th>
                </tr>
                @foreach($report['byType'] as $type => $count)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $type)) }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="footer">
            {{$gs->site_name}} Analytics — Automated Report<br>
            © {{ date('Y') }} {{$gs->site_name}}. All rights reserved.
        </div>
    </div>
</body>

</html>