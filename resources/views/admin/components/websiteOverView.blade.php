<div class="panel panel-default">

    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Website Overview</h3>
    </div>
    <div class="panel-body">
      <div class="col-md-3">
        <div class="well dash-box">
          <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $num_users }}</h2>
          <h4>Les utilisateurs</h4>
        </div>
      </div>
      <div class="col-md-3 dash-box">
        <div class="well">
          <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{ $num_posts }}</h2>
          <h4>Les publications</h4>
        </div>
      </div>
      <div class="col-md-3 dash-box">
        <div class="well">
          <h2><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> {{ $num_notifications }}</h2>
          <h4>Les notifications</h4>
        </div>
      </div>

    </div>
  </div>