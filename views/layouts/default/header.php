<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo htmlspecialchars($this->title) . ' <-> ' . SITE_TITLE ?></title>
    <!-- Load jQuery -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

    <!-- Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    -->
    <!-- Optional theme -->
    <link rel="stylesheet" href="/content/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">ForumSystem</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/questions">Questions</a></li>
                <li><a href="/account/users">Users</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <?php if (!$this->isLoggedIn): ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/account/register">Register</a></li>
                <li><a href="/account/login">Login</a></li>
            </ul>
            <?php else: ?>
            <ul class="nav navbar-nav navbar-right">
                <p class="navbar-text">Logged in as <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
                <li><a href="/account/logout">Logout</a></li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">
    <?php include("messages.php") ?>