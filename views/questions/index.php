<div class="row">
    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">
        <!-- Blog Search Well -->
        <div class="well">
            <form method="get" action="http://masovski.com/TeamDARBY/search/index" autocomplete="off">
                <h4>Blog Search</h4>
                <div class="input-group">
                    <input name="searchphrase" type="text" class="form-control" value="">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
                </div>
                <br>
                <h4>Search by:</h4>
                <label>
                    Tag
                    <input type="radio" name="search_by" value="tag" checked="checked">
                </label>
                <label>
                    Content
                    <input type="radio" name="search_by" value="content">
                </label>
            </form>
        </div>

        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Posts archive</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">

                        <li><a href="http://masovski.com/TeamDARBY/posts/archive/2014/8">August 2014</a> <span class="badge">4</span></li>

                        <li><a href="http://masovski.com/TeamDARBY/posts/archive/2014/7">July 2014</a> <span class="badge">2</span></li>
                    </ul>
                </div>
                <!-- /.col-lg-6 -->

            </div>
            <!-- /.row -->
        </div>

        <div class="well">
            <h4>Tags cloud</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=skill&amp;search_by=tag">
                                skill                </a> <span class="badge">2</span></li>
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=programming&amp;search_by=tag">
                                programming                </a> <span class="badge">2</span></li>
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=veselin&amp;search_by=tag">
                                veselin                </a> <span class="badge">1</span></li>
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=special treatment&amp;search_by=tag">
                                special treatment                </a> <span class="badge">1</span></li>
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=marinov&amp;search_by=tag">
                                marinov                </a> <span class="badge">1</span></li>
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=technology&amp;search_by=tag">
                                technology                </a> <span class="badge">1</span></li>
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=language&amp;search_by=tag">
                                language                </a> <span class="badge">1</span></li>
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=IDE&amp;search_by=tag">
                                IDE                </a> <span class="badge">1</span></li>
                        <li><a href="http://masovski.com/TeamDARBY/search/index?searchphrase=specialists&amp;search_by=tag">
                                specialists                </a> <span class="badge">1</span></li>
                    </ul>
                </div>
                <!-- /.col-lg-6 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- Side Widget Well -->
        <div class="well">
            <h4>Support us</h4>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="93YL6Q3653M3G">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
    </div>

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Posts                <!--<small>Secondary Text</small>-->
        </h1>
        <?php foreach ($this->questions as $question) : ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="/questions/view/<?php echo $question['id']; ?>">
                        <?php echo $question['title']; ?></a>
                </h3>
            </div>
            <div class="panel-body">
                <p class="lead">
                    by <a href="/"><?php echo $question['owner_id'] ?></a>
                </p>
                <p><span class="glyphicon glyphicon-eye-open"></span> <strong><?php echo $question['visits']; ?></strong></p>
                <span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('d/m/y', strtotime($question['created_at'])); ?>
            </div>
        </div>
        <hr>
        <?php endforeach; ?>

        <!-- Pager -->
        <ul class="pager">
            &nbsp;<strong>1</strong>&nbsp;<a href="http://masovski.com/TeamDARBY/posts/page/2">2</a><li class="next"><a href="http://masovski.com/TeamDARBY/posts/page/2">Older →</a></li>        </ul>

    </div>

</div>