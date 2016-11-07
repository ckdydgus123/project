<h2>여기는 게시판 목록 페이지(board/index)입니다.</h2>
<p>이 페이지는 http://127.0.0.1/board 또는 http://127.0.0.1/board/index 로 접근할 수 있습니다.</p>
<ul class="board-list">
    <?php foreach($board_list as $row){?>
        <li>
            <a href="<?php echo URL; ?>board/view/<?php echo $row->idx;?>">
                <?php echo $row->title;?> / <?php echo $row->writer;?> / <?php echo $row->wdate;?></a>&nbsp;

            [<a href="<?php echo URL; ?>board/edit/<?php echo $row->idx;?>">edit</a>]&nbsp;

            [<a href="javascript:confirmDelete('<?php echo URL; ?>board/del/<?php echo $row->idx;?>')">delete</a>]
        </li>
    <?php } //end foreach?>
</ul>
<div class="panel box-v7">
    <div class="panel-body">
        <div class="col-md-12 padding-0 box-v7-header">
            <div class="col-md-12 padding-0">
                <div class="col-md-10 padding-0">
                    <img src="asset/img/avatar.jpg" class="box-v7-avatar pull-left" />
                    <h4>Akihiko Avaron</h4>
                    <p>Today 21:10 Am - 14.07.1997</p>
                </div>
                <div class="col-md-2 padding-0">
                    <div class="btn-group right-option-v1">
                        <i class="icon-options-vertical icons box-v7-menu" data-toggle="dropdown"></i>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 padding-0 box-v7-body">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <div class="col-md-12 top-20">
                <button class="btn">
                    <i class="icon-like icons"></i> 2819
                </button>
                <button class="btn">
                    <i class="icon-bubble icons"></i> 2
                </button>
                <button class="btn">
                    <i class="icon-loop icons"></i> 7071
                </button>
            </div>
        </div>
        <div class="col-md-12 padding-0 box-v7-comment">

            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img src="asset/img/avatar2.png" class="media-object box-v7-avatar"/>
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Fulan</h4>
                    <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <a href="">
                        <i class="icon-like icons"></i> 2819
                    </a>
                    <a href=""> | Comment</a>
                </div>
            </div>

            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img src="asset/img/avatar3.png" class="media-object box-v7-avatar"/>
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Fulanah</h4>
                    <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <a href="">
                        <i class="icon-like icons"></i> 2819
                    </a>
                    <a href=""> | Comment</a>
                </div>
            </div>

            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img src="asset/img/avatar.jpg" class="media-object box-v7-avatar"/>
                    </a>
                </div>
                <div class="media-body">
                    <textarea class="box-v7-commenttextbox" placeholder="write comments..."></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<button onclick="location.href='/board/write'">글쓰기</button>
<script>
    function confirmDelete(url){
        if( confirm('are you sure?')){
            location.href = url;
        }
    }
</script>