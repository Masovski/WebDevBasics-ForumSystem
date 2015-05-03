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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Categories</h4>
            </div>
            <div class="row">
                <div class="col-lg-12 panel-body">
                    <div class="list-group">
                        <?php foreach ($this->categories as $category): ?>
                        <a href="/questions/categories/<?php echo $category['id']; ?>" class="list-group-item">
                            <?php echo htmlspecialchars($category['name']); ?>
                            <span class="badge"><?php echo $category['questions_count']; ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.col-lg-6 -->

            </div>
            <!-- /.row -->
        </div>
    </div>

    <!-- Blog Entries Column -->
    <div class="col-md-8">
        <h1 class="page-header">
            <?php echo $this->title; ?>
            <a href="/questions/create"><button class="btn btn-primary btn-lg">Create New</button></a>
        </h1>
        <?php foreach ($this->questions as $question) : ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="/questions/view/<?php echo $question['id']; ?>">
                        <?php echo htmlspecialchars($question['title']); ?></a>
                </h3>
            </div>
            <div class="panel-body">
                <p class="lead">
                    by <a href="/"><?php echo htmlspecialchars($question['owner_username']); ?></a>
                    | <?php echo htmlspecialchars($question['category_name']); ?>
                </p>
                <p><span class="glyphicon glyphicon-eye-open"></span> <strong><?php echo $question['visits']; ?></strong></p>
                <span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('d/M/Y', strtotime($question['created_at'])); ?>
            </div>
        </div>
        <hr>
        <?php endforeach; ?>

        <!-- Pager -->
        <ul class="pager">
            &nbsp;<strong>1</strong>&nbsp;<a href="#">2</a><li class="next"><a href="http://masovski.com/TeamDARBY/posts/page/2">Older →</a></li>        </ul>

    </div>

</div>