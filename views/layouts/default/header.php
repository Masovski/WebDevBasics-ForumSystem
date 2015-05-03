<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo htmlspecialchars($this->title) . ' <-> ' . SITE_TITLE ?></title>
    <!-- Load jQuery -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

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
            </ul>
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