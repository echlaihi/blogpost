<div class="list-group">
  <a href="{{ route('dashboard') }}" class="list-group-item active main-color-bg">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
  </a>
  <a href="{{ route('dashboard.posts') }}" class="list-group-item">
    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Publications: <span class="badge">{{ $num_posts }}</span>
  </a>
  <a href="{{ route('dashboard.users') }}" class="list-group-item">
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Utilisateur: <span class="badge">{{ $num_users }}</span>
  </a>

  <a href="{{ route('notifications.list') }}" class="list-group-item">
    <span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notifications: <span class="badge">{{ $num_notifications }}</span>
  </a>
</div>