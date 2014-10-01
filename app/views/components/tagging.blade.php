<script type="text/javascript">
    $(document).ready(function() {
    	
        $(".tagging").tagit({
        	fieldName: "tags[]",
        	tagLimit : 10,
        	autocomplete: ({
 
				source: function(request, response){
					$.ajax({
						url : "{{ url('tags') }}",
			    		type: "GET",
			    		dataType: 'json',
			    		data: { request: 'tags', query:request.term },
			    		success: function (data){
			    			var dataOut = [];
			    			for (var i = data.tags.length - 1; i >= 0; i--) {
			    		
			    				dataOut.push( data.tags[i] );
			    			};
			    		

			    			return response(dataOut);
			    		}
					});
				},
		    })
        });
    });
</script>
<ul class="tagging">

</ul>