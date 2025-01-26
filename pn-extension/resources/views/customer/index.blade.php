<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPay Number Generator</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .output {
            margin-top: 20px;
            padding: 10px;
            border: 1px dashed #007BFF;
            border-radius: 4px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>EasyPay Number Generator</h2>
        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="customerId">Customer ID:</label>
                <input type="number" id="customerId" name="customerId" placeholder="Enter Customer ID" required>
            </div>
            <button type="submit">Generate EasyPay Number</button>
        </form>

        @if(session('easyPayNumber'))
            <div class="output">
                <p>Generated EasyPay Number: 
                    <span id="easypay-number">
                        {{ session('easyPayNumber') }}
                    </span>
                </p>
            </div>
        @elseif(session('error'))
            <div class="output">
                <p style="color: red;">Error: {{ session('error') }}</p>
            </div>
        @else
            <div class="output">
                <p>Generated EasyPay Number: 
                    <span id="easypay-number">[Will display here after generation]</span>
                </p>
            </div>
        @endif
    </div>
</body>
</html>
