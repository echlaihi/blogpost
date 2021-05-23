<nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
          aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="#">AdminStrap</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.html">Dashboard</a></li>
          <li><a href="{{ route('dashboard.posts') }}">Publications</a></li>
          <li><a href="{{ route('dashboard.users') }}">Utilisateurs</a></li>
          <li><a href="">Notifications</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.html">Welcome, Nahom</a></li>
          <li><a href="login.html">Logout</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>