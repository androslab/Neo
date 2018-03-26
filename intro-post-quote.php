<?php $t =& peTheme(); ?>
<?php if (is_single()): ?>
<div class="row-fluid post-image">
	<div class="span12">
		<div class="testimonial"><div class="speech"></div>
			<blockquote>
				<p><?php echo $t->content->meta()->quote->text; ?></p>
				
			</blockquote>
			<?php if ($sign = $t->content->meta()->quote->sign): ?>
			<p>
				<cite><?php echo $sign; ?></cite>
			</p>
			<?php endif; ?>
		</div>	
	</div>
</div>
<?php else: ?>
<div class="row-fluid post-image">
	<div class="span2">
		<span class="postTypeIcon">
			<i class="quote"></i>
		</span>
	</div>
	<div class="span10">
		<div class="testimonial"><div class="speech"></div>
			<blockquote>
				<p><?php echo $t->content->meta()->quote->text; ?></p>
				
			</blockquote>
			<?php if ($sign = $t->content->meta()->quote->sign): ?>
			<p>
				<cite><?php echo $sign; ?></cite>
			</p>
			<?php endif; ?>
		</div>	
	</div>
</div>
<?php endif; ?>

