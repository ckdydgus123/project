<div class="span10">
	<article>
		<h1><?=$topic->title?></h1>
		<div>
			<!--글 작성 일자 자동 게시-->
			<div><?= kdate($topic->created)?></div>
			<!--본문 자동 링크 기능-->
			<?= auto_link($topic->description)?>
		</div>
	</article>
	<div>
		<a href="/index.php/topic/add" class="btn">추가</a>
	</div>
</div>