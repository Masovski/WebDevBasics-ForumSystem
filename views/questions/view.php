<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><a href="/questions/view/<?php echo $this->question['id']; ?>">
                <?php echo htmlspecialchars($this->question['title']); ?></a>
        </h3>
    </div>
    <div class="panel-body">
        <p class="lead">
            by <a href="/"><?php echo htmlspecialchars($this->question['owner_username']); ?></a>
            | <?php echo htmlspecialchars($this->question['category_name']); ?>
        </p>

        <p><span class="glyphicon glyphicon-eye-open"></span> <strong><?php echo $this->question['visits']; ?></strong>
        </p>

        <p><span class="glyphicon glyphicon-time"></span> Posted
            on <?php echo date('d-M-Y \a\t H:m:s', strtotime($this->question['created_at'])); ?></p>
        <hr>

        <p><?php echo htmlspecialchars($this->question['content']); ?></p>
        <?php foreach ($this->tags as $tag) : ?>
            <a href="/search/tags/<?php echo $tag['name']; ?>">
                <span class="label label-info"><?php echo htmlspecialchars($tag['name']); ?></span>
            </a>
        <?php endforeach; ?>


    </div>
</div>
<!-- 'Post comment' form-->
<div class="well">
    <h4>Leave a Comment:</h4>

    <form role="form" method="post" action="/questions/answer/<?php echo $this->question['id']; ?>">
        <div class="form-group">
            <input type="text" name="anonymousName" class="form-control" placeholder="Full name"
                   style="display: inline; max-width: 250px" required="required">
            <input type="text" name="anonymousEmail" class="form-control" placeholder="Email"
                   style="display: inline; max-width: 250px">
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="3" name="answerContent" required="required"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add comment</button>
    </form>
</div>

<hr>

<!-- Posted comments -->
<?php foreach ($this->answers as $answer): ?>
    <div class="row">
        <div class="col-md-2 col-sm-2 hidden-xs">
            <figure class="thumbnail">
                <img class="img-responsive" src="/content/images/default_avatar.png">
                <figcaption class="text-center"></figcaption>
            </figure>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-default arrow left">
                <div class="panel-body">
                    <header class="text-left">
                        <div class="comment-user"><i class="fa fa-user"></i>
                            <?php if (isset($answer['anonymous_name'])): ?>
    User: <strong><?php echo htmlspecialchars($answer['anonymous_name']); ?></strong></div>
<?php else: ?>
                            User: <strong><?php echo htmlspecialchars($answer['username']); ?></strong></div>
                            <?php endif ?>
                        <time class="comment-date" datetime="<?php echo $answer['created_at']; ?>"><i class="fa fa-clock-o"></i>
                            <span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('d-M-Y \a\t H:m:s', strtotime($answer['created_at'])); ?></time>
                    </header>
                    <hr>
                    <div class="comment-post">
                        <p>
                            <?php echo htmlspecialchars($answer['text']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php endforeach; ?>
