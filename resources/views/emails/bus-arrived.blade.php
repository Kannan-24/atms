<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Arrival Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            font-size: 24px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
        }
        .info-box {
            background: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">🚌 Bus Arrival Notification</div>
        <div class="content">
            <p>Dear Parent,</p>
            <p>The bus has arrived at the designated stop.</p>
            <div class="info-box">
                <p><strong>Student Name:</strong> {{ $student_name }}</p>
                <p><strong>Bus Number:</strong> {{ $bus_number }}</p>
                <p><strong>Driver Name:</strong> {{ $bus_driver }}</p>
                <p><strong>Driver Contact:</strong> {{ $bus_driver_phone }}</p>
            </div>
            <p>Please ensure timely pickup. For any queries, contact the driver.</p>
        </div>
        <div class="footer">&copy; {{ date('Y') }} ATMS | All rights reserved.</div>
    </div>
</body>
</html>
