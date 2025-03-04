<x-pdf-portrait>
    @push('styles')
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                padding: 0;
            }

            /* Table Styling */
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
                background-color: #007bff;
                color: white;
                text-align: center;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            /* Status Colors */
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

        </style>
    @endpush

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
                    <td>{{ $busAttendance ? \Carbon\Carbon::parse($busAttendance->check_in)->format('h:i A') : 'N/A' }}
                    </td>

                    <td class="{{ $status === 'Present' ? 'status-present' : 'status-absent' }}">
                        {{ $status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-pdf-portrait>
