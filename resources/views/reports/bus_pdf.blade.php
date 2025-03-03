<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report - Bus {{ $bus->bus_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #333;
            font-size: 22px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-present {
            background-color: #d4edda;
            color: #155724;
            font-weight: bold;
            text-align: center;
        }

        .status-absent {
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
            text-align: center;
        }

        .no-data {
            text-align: center;
            color: red;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Attendance Report - Bus {{ $bus->bus_number }}</h2>
    </div>

    @if ($attendances->isEmpty())
        <p class="no-data">No attendance records available for this bus.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Check-in Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attendance->student->user->name ?? 'N/A' }}</td>
                        <td>{{ $attendance->check_in ?? 'N/A' }}</td>
                        <td class="{{ $attendance->status === 'Present' ? 'status-present' : 'status-absent' }}">
                            {{ $attendance->status ?? 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>

</html>
