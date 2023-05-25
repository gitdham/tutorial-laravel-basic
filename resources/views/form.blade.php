<html>

<head>Say Hello</head>

<body>
  <form action="/form" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <label for="name">
      <input type="text" name="name">
    </label>
    <input type="submit" value="Say Hello">
  </form>
</body>

</html>
