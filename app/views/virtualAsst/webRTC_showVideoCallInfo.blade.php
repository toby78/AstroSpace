<script>
$(function(){
   
   $("#asst_webRTC_createnewroom").popover({
      trigger:"hover focus",
      content: "Create a new video call room",
      placement: "auto right",
   });
   
   $("#asst_webRTC_approve1").popover({
      trigger:"hover focus",
      content: "Approve video call request from Friend1 and go there",
      placement: "auto right",
   });

   $("#asst_webRTC_approve2").popover({
      trigger:"hover focus click",
		title: "CLICK HERE!",
      content: "Approve video call request from Friend2 and go there",
      placement: "auto right",
   });

	$("#asst_space_videocallinfo").click(function(){
   	setTimeout( function(){$("#asst_webRTC_approve2").popover("show")}, 300);
	});

});

</script>



<div class="tab-pane" id="showVideoCallInfo">
	<div style="margin:20px">
	<div id="activeRoom">
			<h3> You do not have active video chat room. </h3>
			<button class="btn btn-info" id="asst_webRTC_createnewroom">Create new room</button>
	</div>
	<h3> Invitation to video chat: </h3>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<td>Host</td>
				<td>Approve</td>
			</tr>
		</thead>
		<tbody>
		<?php
			$videoCallRequests = array("1"=>"Friend1", "2"=>"Friend2");
		?>
		@foreach($videoCallRequests as $key => $value)
			<tr>
				<td>{{{ $value }}}</td>
				<td>
					<button class="btn btn-info" id="{{{ 'asst_webRTC_approve'.$key}}}">Approve</button>
				</td>	
			</tr>
		@endforeach
		</tbody>
	</table>


	</div>
</div>

