<?php include 'common.php' ?>
<?php include 'header.php' ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="/save.php" method="post" class="form-horizontal post">
				<div class="form-group">
					<textarea name="content"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" value="저장하기">
				</div>
			</form>
		</div>
	</div>
<?php
$stmt = $db->query('SELECT * FROM posts ORDER BY post_id DESC');
$posts = $stmt->fetchAll();
foreach($posts as $post) {
?>
	<div class="row content">
		<p><?php echo $post['content'] ?></p>
	</div>
<?php } ?>
</div>

<script>
$('form.post').submit(function(event){
	event.preventDefault();
	var content = this.elements.content.value;
	$.ajax({
		async: true,
		url : '/save.php',
		method : 'post',
		data : {content:content},
		success : function(data) {
			var $firstContent = $('.row.content:first');
			var $content = $firstContent.clone();

			$content.find('p').text(content);
			$content.insertBefore($firstContent);
		},
		error : function() {
			console.log('error');
		}
	});
});
</script>

<?php include 'footer.php' ?>