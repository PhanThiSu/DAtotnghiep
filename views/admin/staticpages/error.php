<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<div class="error-page admin-error-page clearfix">
	<h2 class="headline text-yellow"> 404</h2>
	<div class="error-content">
		<h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
	  	<p>We could not find the page you were looking for. Meanwhile, you may <a href="<?php echo RootURL ?>admin/dashboard">return to dashboard</a>.</p>
	  	
	</div>
<!-- /.error-content -->
</div>
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
