<?php unset($_SESSION['post']['start_post_id']); ?>
<?php require('partials/head.html.php') ?>

<!-- Main -->
<div class="main">
    <div class="main-header">
        <span>Home</span>
    </div>
    <div class="main-newpost">
        <div class="newpost-aside">
            <div class="newpost-user-img">
                <img src="assets/default.png" alt="">
            </div>
        </div>
        <div class="newpost-main">
            <form class="form-newpost" action="handlers/handle_newpost.php" method="post">
                <div class="newpost-header">
                    <input type="text" name="" id="postname" placeholder="Post title" autocomplete="off" required>
                </div>
                <div class="newpost-text">
                    <textarea name="" id="posttext" cols="30" rows="4" placeholder="Post text" autocomplete="off"
                        required></textarea>
                </div>
                <div class="newpost-footer">
                    <button>Publish</button>
                </div>
            </form>
        </div>
    </div>
    <!-- iterate -->
    <div class="main-list"></div>
    <ul class="post-menu" id="post-menu">
        <li class="post-menu-del" id="">Delete</li>
    </ul>
    <div class="main-post-footer"></div>
</div>

<?php require('partials/footer.html.php') ?>