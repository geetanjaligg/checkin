<?php
?>
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

	$.getJSON('timeline.json', function(data) {
		createStoryJS({
			type:       'timeline',
			width: window.innerWidth,
			height: 500,
			source:     data,
			embed_id:   'my-timeline'
		});
	});
</script>
</html>