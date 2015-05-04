<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $this->title; ?></h3>
        </div>
    <div class="panel-body">
    <form role="form" method="POST">
        <div class="col-md-8 col-md-offset-2">
            <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
            <div class="form-group">
                <label for="InputUsername">Username</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="username" id="InputUsername" placeholder="Enter Username" required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="InputPassword">Enter Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="InputPassword" placeholder="Enter Password" required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail">Enter Email</label>
                <div class="input-group">
                    <input type="email" class="form-control" name="email" id="InputEmail" placeholder="Enter Email" required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                </div>
            </div>
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken']; ?>" />
            <input type="submit" name="submit" id="submit" value="Register" class="btn btn-info btn-block">
        </div>
    </form>
    </div>
</div>