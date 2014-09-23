<?php

if(isset($_GET['code'])){
	$code = $_GET['code'];

	$ch = curl_init();

	$url = 'https://foursquare.com/oauth2/access_token?client_id=033MKCPSDFMK3UWLNLX215BWJJXLNQQMVCC2BLNZHN5F4IJL&client_secret=RHVXD2HYJR2QNERA0PKPI3L1XJVL1MLKTKDTPT5304XI1ZM5&grant_type=authorization_code&redirect_uri=http://stark-cliffs-9895.herokuapp.com/checkins.php&code=' . $code;
								//echo $url;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec($ch);
	curl_close($ch);
	$arr = json_decode($contents,true);
	echo $arr['access_token'];

	if(!empty($arr['access_token'])){

		$ch = curl_init();

	$url = 'https://api.foursquare.com/v2/users/self/checkins?oauth_token=' . $arr['access_token'] . '&v=20140922';
								//echo $url;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec($ch);
	curl_close($ch);
	print_r($contents);
	$checkins = json_decode($contents,true);
	print_r($checkins);
	?> 
	<script type="text/javascript">
	var access_token = <?php echo $arr['access_token']; ?>;
	</script>
	<?php
	}


}

?>
<html>
<head>
	
</head>
<body>
		<section id="my-timeline"></section>
</body>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="timeline/js/storyjs-embed.js"></script>
	

<script type="text/javascript">

var access_token = 'GNFQ1AHXDM2KWNTTQRN55QERKXA0VLOMRMKP2YTHQ3QFQJCK';
console.log("https://api.foursquare.com/v2/users/self/checkins?oauth_token=" + access_token + "&v=20140922");
var url = "https://api.foursquare.com/v2/users/self/checkins?oauth_token=" + access_token + "&v=20140922&limit=540";

var timeline = {
	"timeline": {
		"headline":"My Checkins",
		"type":"default",
		"text":"This is a collection of my checkins",
		"date": []
	}
};

var populateTimeline = (function() {
	function foursquare() {
		return $.Deferred(function() {
			var deferred = this;
			$.getJSON(url, function(data){
				var checkins = data.response.checkins.count;
				var n_checkins = data.response.checkins.items.length;
				console.log(n_checkins);
				for (var i = 0; i < n_checkins ; i++) {
						date = new Date(data.response.checkins.items[i].createdAt*1000),
						month = date.getMonth() + 1;			
					var checkin = {
						headline: data.response.checkins.items[i].venue.name,
						text: data.response.checkins.items[i].shout,
						asset: {
							media: '', //'https://twitter.com/' + data[i].user.screen_name + '/status/' + data[i].id_str,
							credit: '',
							caption: ''
						},
						startDate: date.getFullYear() + ',' + month + ',' + date.getDate(),
						endDate: this.startDate
					};
					timeline.timeline.date.push(checkin);
				}
				deferred.resolve();
			});
		});
	}
	return {
		foursquare: foursquare
		//flickr: flickr,
		//flickrCallback: flickrCallback,
		//youtube: youtube,
		//vimeo: vimeo
	};
})();
	
$.when(
	populateTimeline.foursquare()
	//populateTimeline.flickr(),
	//populateTimeline.youtube(),
	//populateTimeline.vimeo()
).then(function() {
	createStoryJS({
		width: window.innerWidth,
		height: window.innerHeight,
		source: timeline,
		embed_id: 'my-timeline'
	});
});


</script>
</html>