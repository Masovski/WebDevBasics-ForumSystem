<div class="row">
    <!-- Forum Sidebar Column -->
    <div class="col-md-4">
        <!-- Forum Search Well -->
        <div class="well">
            <!-- It's usually better to use GET method here -->
            <form method="POST" action="/search/" autocomplete="off">
                <h4>Forum Search</h4>
                <div class="input-group">
                    <input name="searchPhrase" type="text" class="form-control" value="">
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
                    <input type="radio" name="searchBy" value="tag" checked="checked">
                </label>
                <label>
                    Question
                    <input type="radio" name="searchBy" value="questionTitle">
                </label>
                <label>
                    Answer
                    <input type="radio" name="searchBy" value="answerContent">
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
            </div>
        </div>
    </div>

    <!-- Forum Questions Column -->
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
            &nbsp;<strong>1</strong>&nbsp;<a href="#">2</a><li class="next"><a href="#">Older →</a></li>        </ul>

    </div>

</div>