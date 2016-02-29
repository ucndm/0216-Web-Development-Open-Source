<!DOCTYPE html>
<html>
	<head>
		<title>Links</title>
		<meta charset="utf-8"/>

		<script type="text/javascript">
			var requesthandler = function(e){
				var xhr = e.target;
				if(xhr.readyState == 4){
					var content = JSON.parse(xhr.response);
					console.log(content.alert);
				}
			};

			var createLink = function(e){
				e.preventDefault();
				var form = e.target;

				var fd = new FormData(form);

				var xhr = new XMLHttpRequest();
				xhr.addEventListener('readystatechange', requesthandler, false);
				xhr.open('POST', 'links/');
				xhr.setRequestHeader('Cache-Control', 'no-cache');
				xhr.setRequestHeader('Pragma', 'no-cache');
				xhr.send(fd);

				form.reset();
			};


			window.addEventListener('load', function(){
				document.forms.postlink.addEventListener('submit', createLink, false);
			}, false);
		</script>
	</head>
	<body>
		<h1>Links</h1>
		<ul>
		</ul>
		<h2>New link</h2>
		<form name="postlink" method="post" action="links/">
			<label>URL <input type="url" name="url"/></label>
			<label>Title <input type="text" name="title"/></label>
			<input type="submit"/>
		</form>
	</body>
</html>