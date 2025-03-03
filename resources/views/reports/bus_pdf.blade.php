<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report - Bus {{ $bus->number }}</title>
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
        <h2>Attendance Report - Bus {{ $bus->number }}</h2>
    </div>

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
            @foreach ($bus->students as $student)
                @php
                    $busAttendance = $student->busAttendance ? $student->busAttendance->first() : null;
                    $status = $busAttendance ? $busAttendance->status : 'N/A';
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->user->name ?? 'N/A' }}</td>
                    <td>{{ $busAttendance ? $busAttendance->check_in : 'N/A' }}</td>
                    <td class="{{ $status === 'Present' ? 'status-present' : 'status-absent' }}">
                        {{ $status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
