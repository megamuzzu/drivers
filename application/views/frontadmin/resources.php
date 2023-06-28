<style>
ul.resource-ul li {
	    padding: 10px;
	    background: white;
	    margin-bottom: 5px;
	    box-shadow: 3px 8px 5px 2px #dadada;
	    cursor: pointer;
	}
	ul.resource-ul li.active
	{
		font-weight: 700;
    	font-style: italic;
    	color:#c53838;
	}
	.bg-theme
	{
		background: #3c8dbc !important; 
		cursor: context-menu !important;
	}
	.video-contant
	{
		background: white;
	    padding: 9px;
	    margin-top: 5px;
	    width: 91%;
	}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file" aria-hidden="true"></i> Resources
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
    	<div class="row"> 
	    	<div class="col-sm-8" id="video_con" > 
				<video width="91%" height="490" controls>
					  <source id="src_mp4" src="<?php echo base_url();?>uploads/videos/<?php echo $videos_list[0]->video_file; ?>" type="video/mp4">
					  <source src="<?php echo base_url();?>uploads/videos/<?php echo $videos_list[0]->video_file; ?>" type="video/ogg">
					  Your browser does not support the video tag.
				</video>
				<div class="video-contant">
					<p><b><?php echo $videos_list[0]->video_title; ?></b></p>
					<p><?php echo $videos_list[0]->video_description; ?></p>
				</div>
			</div>
			<div class="col-sm-4">
				<ul class="list-unstyled resource-ul" >
					<li class="bg-theme" >Select Video</li>
					<?php foreach ($videos_list as $k=>$v) {?>
					<li class="btn-video-list <?php echo ($k == 0)?'active':''; ?>" data-file="<?php echo $v->video_file;?>" data-title="<?php echo $v->video_title;?>" data-desc="<?php echo $v->video_description;?>" > <?php echo $v->video_title;?></li>
					<?php }?>
				</ul> 
				
			</div>				

		</div>
    </section>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$(".btn-video-list").click(function(){

			var file = $(this).attr('data-file');
			var title = $(this).attr('data-title');
			var descripton = $(this).attr('data-desc');
			
			
			$("#video_con").html('<video width="91%" height="490" controls><source src="<?php echo base_url();?>uploads/videos/'+file+'" type="video/mp4"><source src="<?php echo base_url();?>uploads/videos/'+file+'" type="video/ogg">Your browser does not support the video tag.</video><div class="video-contant"><p><b>'+title+'</b></p><p>'+descripton+'</p></div>');
			$(".btn-video-list").removeClass('active');
			$(this).addClass('active');
			
		});
	});

</script>