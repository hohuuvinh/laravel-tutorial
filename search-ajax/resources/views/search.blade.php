<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script
	src="https://code.jquery.com/jquery-3.5.1.js"
	integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
	crossorigin="anonymous"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<div class="container pt-5">
		<div class="row m-0">
			<div class="col-4 p-0">
				<label class="font-weight-bold">Search Input</label>
				<input id="inputSearch" type="" class="form-control" name="">
			</div>
		</div>
		<div id="searchResult" class="row m-0 mt-4" style="display: none;">
			
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#inputSearch').on('keyup',function(){
		$inputSearch = $(this).val();
		if($inputSearch ==''){
			$('#searchResult').html('');
			$('#searchResult').hide();
		}else{
			$.ajax({
				method:"post",
				url:'search',
				data:JSON.stringify({
					inputSearch:$inputSearch
				}),
				headers:{
					'Accept':'application/json',
					'Content-Type':'application/json'
				},
				success: function(data){
					var searchResultAjax='';
					data = JSON.parse(data);
					console.log(data);
					$('#searchResult').show();
					for(let i=0;i<data.length;i++){
						searchResultAjax +=`<div class="col-3 p-1">
						<div class="p-3 bg-primary">
						<p class="font-weight-bold text-white float-left">Name:</p>
						<p class="font-weight-bold text-white float-right">`+data[i].name+`</p>
						<div style="clear: both;"></div>
						<p class="font-weight-bold text-white float-left">Content:</p>
						<p class="font-weight-bold text-white float-right">`+data[i].content+`</p>
						<div style="clear: both;"></div>
						</div>
						</div>`
					}
					$('#searchResult').html(searchResultAjax);
				}
			})
		}
	})
</script>