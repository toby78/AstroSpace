<script>
$(function(){
	
   $("#asst_space_blog").popover({
      trigger:"hover focus click",
      content: "See, edit, or create your blog",
      placement: "auto top",
   });
   
   $("#asst_space_profile").popover({
      trigger:"hover focus click",
      content: "See or edit your profile",
      placement: "auto top",
   });

   $("#asst_space_showfriend").popover({
      trigger:"hover focus click",
      content: "List of your friends and friend requests",
      placement: "auto top",
   });

   $("#asst_space_videocallinfo").popover({
      trigger:"click",
		title: "CLICK HERE!",
      content: "Information on video call",
      placement: "top",
   });

   //setTimeout( function(){$("#asst_space_videocallinfo").popover("show")}, 500);

});

</script>

	<div class="row">
		<div class="col-sm-2">
			<img src="..." alt="..." style="width:100%; height: 200px" class="img-thumbnail"/>
		</div>
		<div class="col-sm-10">
			<ul id="myTab" class="nav nav-tabs">
			  <li class="active" ><a href="#blog" data-toggle="tab" id="asst_space_blog">Blog</a></li>
			  <li><a href="#profile" data-toggle="tab" id="asst_space_profile">Profile</a></li>
			  <li><a href="#showFriend" data-toggle="tab" id="asst_space_showfriend">ShowFriend</a></li>
			  <li><a href="#showVideoCallInfo" data-toggle="tab" id="asst_space_videocallinfo">Video Call Info </a></li>
			</ul>

			<!-- Tab panes -->
			<div id="myTabContent" class="tab-content">
			  <div class="tab-pane active" id="blog">
			  	<div style="margin:20px">
				  		<div class="row">
				  			{{ HTML::link("#", "Create new post", array('class'=>'btn btn-primary')) }}
				  		</div>

						<!-- For blog post -->
			  			<div class="row">
			  				<h3>{{ HTML::link("#", "Title") }}</h3>			
			  				<p>Blog content</p>									
			  				<p style="font-size:small">Mood: mood</p>		
			  				<small> comment(s)</small>							
				  			<hr/>														
			  			</div>

				  	</div>
			  </div>
			  <div class="tab-pane" id="profile">
			  	<div class="col-sm-5" style="margin:20px">
						<table class="table table-hover table-condensed">
							<tbody>
							  <tr>
									<td>Username</td>
									<td>Name</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>email@email.com</td>
								</tr>
								<tr>
									<td>AIM</td>
									<td>aim</td>
								</tr>
								<tr>
									<td>MSN</td>
									<td>msn</td>
								</tr>
								<tr>
									<td>IRC</td>
									<td>irc </td>
								</tr>
								<tr>
									<td>ICQ</td>
									<td>icq</td>
								</tr>
							</tbody>
						</table> 
				  		{{ HTML::link("#", 'Edit', array('class' => 'btn btn-warning')) }}
					</div>
			  </div> <!-- for tab-pane profile -->

				<?php echo View::make('virtualAsst.friends_showFriend'); ?>
				<?php echo View::make('virtualAsst.webRTC_showVideoCallInfo'); ?>


			</div>
		</div>
	</div>


