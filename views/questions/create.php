<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $this->title; ?></h3>
    </div>
<div class="panel-body">
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter question's title here..." value="">
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-sm-2 control-label">Question</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" name="content" placeholder="Enter question's content here..."></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="category" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10">
                <select name=categoryId id="category" class="form-control">
                    <?php foreach ($this->categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="tags" class="col-sm-2 control-label">Tags</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags, seperated by whatever you want..." value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2"><?php var_dump($_SESSION['formToken']); var_dump($_POST['formToken']);?>
                <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken']; ?>" />
                <input id="submit" name="submit" type="submit" value="Add Question" class="btn btn-primary btn-block">
            </div>
        </div>
    </form>
</div>