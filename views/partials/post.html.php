<div class="main-post">
    <div class="post-aside">
        <div class="post-user-img">
            <img src="assets/uploads/{ UserImg }" alt="">
        </div>
    </div>
    <div class="post-main">
        <div class="post-header">
            <div class="post-header-main">
                <div class="post-info">
                    <div class="post-username-full">{ Userfull }</div>
                    <div class="post-username">{ Username }</div>
                    <div class="post-date">{ Postdate }</div>
                </div>
                <div class="post-name">
                    <span>{ Postname }</span>
                </div>
            </div>
            <?php if($ViewUserIdStr == $ViewPostUserIdStr) {require 'postmenu.html.php'; }?>
        </div>
        <div class="post-text">
            <span>{ Posttext }</span>
        </div>
        <div class="post-footer"></div>
    </div>
</div>