window.addEventListener('DOMContentLoaded', function(event) {
	console.log('DOM fully loaded and parsed');
	websdkready();
});

function websdkready() {

	ZoomMtg.preLoadWasm();
  	ZoomMtg.prepareJssdk();

	// click join meeting button
	document
		.getElementById("join_meeting")
		.addEventListener("click", function (e) {
			e.preventDefault();

			const meetConfig = {
				signatureEndpoint: 'get-zoom-signature.php',
				userName: document.getElementById('userName').value,
				userEmail: document.getElementById('userEmail').value,
				role: document.getElementById('meetingRole').value // 1 for host; 0 for attendee
			};

			fetch( meetConfig.signatureEndpoint, {
				method: 'POST',
				body: JSON.stringify({ meetingData: meetConfig })
			})		 
			.then(response => response.json())
			.then(data => {
                //console.log(data.meetingData);
                if (!data.meetingData.userName) {
                	alert("Username is empty");
                	return false;
                }
				ZoomMtg.init({
					leaveUrl: data.meetingData.leaveUrl,
					isSupportAV: true,
					success: function (res) {
						ZoomMtg.join({
								signature: data.meetingData.signature,
								meetingNumber: data.meetingData.meetingNumber,
								userName: data.meetingData.userName,
								apiKey: data.meetingData.apiKey,
								userEmail: data.meetingData.userEmail,
								passWord: data.meetingData.meetingPwd,
								success: function(res){
									console.log('join meeting success');
									document.getElementById('nav-tool').style.display = 'none';
								},
								error: function(res) {
									console.log(res);
								}
						})
					}
				})
				
			})	

		});

}
