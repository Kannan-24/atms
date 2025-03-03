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
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header h3 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #555;
        }
        .date {
            text-align: right;
            font-size: 14px;
            margin-bottom: 10px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
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
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h1>College Name Here</h1>
        <h3>Bus Attendance Report</h3>
        <h3>Bus Number: {{ $bus->number }}</h3>
        <h3>Route: {{ $bus->route->route_name ?? 'N/A' }}</h3>
    </div>

    <div class="date">
        Date: {{ now()->format('d-m-Y') }}
    </div>

    <!-- TABLE -->
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

    <!-- FOOTER -->
    <div class="footer">
        <p>Generated on {{ now()->format('d-m-Y h:i A') }}</p>
        <p>Automated Transport Management System (ATMS)</p>
    </div>

</body>
</html>
