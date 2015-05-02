    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><a href="/questions/view/<?php echo $this->question['id'];?>">
                    <?php echo htmlspecialchars($this->question['title']);?></a>
            </h3>
        </div>
        <div class="panel-body">
            <p class="lead">
                by <a href="/"><?php echo htmlspecialchars($this->question['owner_username']); ?></a>
                | <?php echo htmlspecialchars($this->question['category_name']); ?>
            </p>
            <p><span class="glyphicon glyphicon-eye-open"></span> <strong><?php echo $this->question['visits']; ?></strong></p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('d-M-Y \a\t H:m:s', strtotime($this->question['created_at'])); ?></p>
            <hr>

            <p><?php echo htmlspecialchars($this->question['content']); ?></p>
            <?php foreach ($this->tags as $tag) : ?>
                <a href="/search/tags/<?php echo $tag['name']; ?>">
                    <span class="label label-info"><?php echo htmlspecialchars($tag['name']); ?></span>
                </a>
            <?php endforeach; ?>

        </div>
    </div>