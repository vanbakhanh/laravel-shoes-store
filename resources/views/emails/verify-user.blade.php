<!DOCTYPE html>
<html>
<head>
  <title>Verify User</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
  <div class="row justify-content-center my-4">
    <div class="col-md-8 mt-4">
      <p>Hi {{ $user->name }},</p>
      <p>Thanks for registering for an account on Nike! Before we get started, we just need to confirm that this is you. Click below to verify your email address:</p>
      <a class="btn btn-primary mb-4" href="{{ route('verify', $user->token) }}" target="_blank">Verify Email</a>
      <p>Good luck! Hope it works.</p>
      <p>Van Ba Khanh.</p>
    </div>
  </div>
</body>
</html>