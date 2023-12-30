<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Email Notification</title>
</head>

<body>
    <div class="card">
        <div class="card-header text-center">
            Feedback Email Notification
        </div>
        <div class="card-body">
            {{-- <h5 class="card-title">Special title treatment</h5> --}}
            <p class="card-text text-center"><b>{{ $data['UserName'] }}</b> is commented on your this Feedback
                (feedback title: <b>{{ $data['Feedback'] }}</b>) and the comment is
                <b>{!! $data['comment'] !!}</b>
            </p>
            Thanks,<br>
            {{ config('app.name') }}<br>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
