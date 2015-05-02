<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $this->title; ?></h3>
        </div>
    <div class="panel-body">
        <form class="col-md-8 col-md-offset-2" method="POST">
            <div class="form-group">
                <input type="text" class="form-control input-lg" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-lg" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block">Login</button>
                <span class="pull-right"><a href="/account/register">New Registration</a></span>
            </div>
        </form>
    </div>
</div>