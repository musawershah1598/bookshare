<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
    <style>
        body {
            margin: 0;
        }

        .header {
            background: #283267;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-weight: normal;
        }

        .body {
            text-align: center;
            margin-top: 30vh;
        }

        .body h2 {
            margin-bottom: 0;
        }

        .body a {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            color: #283267;
            box-shadow: none;
        }

        .body a:hover {
            background: #283267;
            color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reading Nookes</h1>
    </div>
    <div class="body">
        <h2>Welcome Mr {{$user->name}}</h2>
        <p>Click on below button to verify your email</p>
        <a href="{{route('api.email.verify')}}?token={{$user->id}}">Click Here</a>
    </div>
</body>

</html>