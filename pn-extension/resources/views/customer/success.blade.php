<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPay Number Generated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .output {
            margin-top: 20px;
            padding: 10px;
            border: 1px dashed #007BFF;
            border-radius: 4px;
            font-size: 18px;
            color: #333;
        }
        .output p {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>EasyPay Number Successfully Generated</h2>
        <div class="output">
            <p>Your EasyPay Number:</p>
            <p>{{ $easyPayNumber }}</p>
        </div>
        <a href="{{ route('customer.view') }}">Generate Another</a>
    </div>
</body>
</html>
