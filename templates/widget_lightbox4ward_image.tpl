<div class="image_container">
<?php echo $this->embed_pre; ?><a href="<?php echo $this->href; ?>" class="hyperlink_img" title="<?php echo $this->title; ?>"<?php if ($this->rel): ?> rel="<?php echo $this->rel; ?>"<?php endif; ?><?php echo $this->target; ?>><img src="<?php echo $this->src; ?>"<?php echo $this->imgSize; ?> alt="<?php echo $this->alt; ?>" title="<?php echo $this->title; ?>" /><span class="loupe"></span></a><?php echo $this->embed_post; ?>
<?php if ($this->caption): ?>
<div class="caption"><?php echo $this->caption; ?></div>
<?php endif; ?>
</div>
<?php echo $this->js;?>