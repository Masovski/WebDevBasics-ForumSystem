    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><a href="/questions/view/<?php echo $this->question['id'];?>">
                    <?php echo htmlspecialchars($this->question['title']);?></a>
            </h3>
        </div>
        <div class="panel-body">
            <?php var_dump($this->question); ?>
            <p class="lead">
                by <a href="/"><?php echo $this->question['owner_id']; ?></a>
                | <?php echo $this->question['category_id']; ?>
            </p>
            <p><span class="glyphicon glyphicon-eye-open"></span> <strong><?php echo $this->question['visits']; ?></strong></p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('d/m/y', strtotime($this->question['created_at'])); ?></p>
            <hr>

            <p><?php echo htmlspecialchars($this->question['content']); ?></p>
            <?php foreach ($this->tags as $tag) : ?>
                <a href="/search/tags/<?php echo $tag['name']; ?>">
                    <span class="label label-info"><?php echo htmlspecialchars($tag['name']); ?></span>
                </a>
            <?php endforeach; ?>

        </div>
    </div>