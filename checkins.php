<?php

?>
<html>
<head>
	
</head>
<body>

	<div id="fb-root"></div>

	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1428419320733926&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<div style="padding: 4px;margin: 4px;float: right;">
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://bit.ly/1B3932N" data-text="Foursquare check-in timeline" data-via="geetanjaligg">Tweet</a>

		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

		<div class="fb-like" data-href="http://bit.ly/1B3932N" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>

	</div>

	<section id="my-timeline" style="height:500px;"></section>

	<footer style="text-align: center;position: fixed;bottom: 0px;height: 30px;width: 100%;"><a href="http://twitter.com/geetanjaligg/" target="_blank">@geetanjaligg </a></footer>
</body>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="timeline/js/storyjs-embed.js"></script>
<script src="js/purl.js"></script>
<script type="text/javascript">

var at = $.url();
var access_token = at.fparam('access_token');
if(typeof access_token == 'undefined'){
	window.location = 'connect.php';
}
console.log("https://api.foursquare.com/v2/users/self/checkins?oauth_token=" + access_token + "&v=20140922");
var url = "https://api.foursquare.com/v2/users/self/checkins?oauth_token=" + access_token + "&v=20140922&limit=540";
var timeline = {
	"timeline": {
		"headline":"My Checkins",
		"type":"default",
		"text":" Foursquare check-in timeline ",
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
					var media = '';
					if(data.response.checkins.items[i].photos.count>0){
						media = data.response.checkins.items[i].photos.items[0].prefix + '300x300' + data.response.checkins.items[i].photos.items[0].suffix;
					}
					var shout = '<shout>';
					if(data.response.checkins.items[i].shout){
						shout = data.response.checkins.items[i].shout;
					}			
					var checkin = {
						headline: data.response.checkins.items[i].venue.name,
						text: shout,
						asset: {
							media: media,
							credit: '',
							caption: ''
						},
						startDate: date.getFullYear() + ',' + month + ',' + date.getDate(),
						endDate: this.startDate
					};
					timeline.timeline.date.push(checkin);
				}
				console.log("updated" + JSON.stringify(timeline));
				deferred.resolve();
			});
		});
	}
	return {
		foursquare: foursquare
	};
})();

console.log(JSON.stringify(timeline));

$.when(
	populateTimeline.foursquare()
	).then(function() {
		createStoryJS({
			width: window.innerWidth,
			height: 500,
			source: timeline,
			embed_id: 'my-timeline'
		});
	});

</script>
</html>