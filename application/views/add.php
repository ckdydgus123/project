
<script src="/static/lib/ckeditor/ckeditor.js"></script>
<form action="/index.php/topic/add" method="post" class="span10">

    <!--사용자가 데이터를 입력하고 전송하면 유효성을 체크하고 유효하지 않은 데이터가 들어오면
    다시 그 내용을 입력 할 수 있도록 돌려 보내주는 기능을 하는 구문-->
    <?php echo validation_errors(); ?>

    <input type="text" name="title" placeholder="제목" class="span12" />
    <textarea name="description" id="editor1" class="ckeditor" placeholder="본문" rows="15" ></textarea>
    <input class="btn" type="submit" />
</form>

<!--<script>
    CKEDITOR.replace('description');
</script>-->