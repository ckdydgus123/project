<div class="modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>로그인</h3>
    </div>
    <form class="form-horizontal" action="<?= site_url('/auth/authentication?returnURL='.rawurlencode($returnURL))?>" method="post">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label" for="inputEmail">email</label>

                <div class="controls">
                    <input type="text" id="email" name="email" placeholder="email">

                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Password</label>

                <div class="controls">
                    <input type="password" id="password" name="password" placeholder="password">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="로그인">
        </div>
    </form>
</div>