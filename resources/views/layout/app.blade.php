<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<title></title>
</head>
<body>
	<header>
      <div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
	        <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="navbar-brand" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="navbar-brand" href="/posts">Posts</a>
              </li>
            </ul>
	      </div>
	    </nav>
	</header>
	<div class="content">
		<div class="container">
			@yield('content')
		</div>
	</div>
</body>
</html>