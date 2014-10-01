<script>
	
$(".myTags").tagit({
    availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
});

$('.video-form').submit(function(e){
	e.preventDefault();

	var formID = String(this.id).split('_');
    formID = formID[1];
   
    var postData = $('.'+this.id+'#video_title').serialize();

	var vidID =$('#id_'+formID).val();
    var title =$('#title_'+formID).val();
    var description =$('#description_'+formID).val();
	var tags = JSON.stringify( $("#myTag_" + formID ).tagit("assignedTags") );
	var category = JSON.stringify( $("#category_" + formID ).val() );

	$.ajax({
	    type: 'post',
	    url: '{{ URL::to("editVideo") }}',
	    data : { 
	    	videoID: vidID,
			videoTitle: title,
			videoDesc: description,
			tags: tags,
			category: category
		} })
	.done(function( data ){
		
	    
	    var response = $.parseJSON(data);

	    if( response.published ){
	        $('#response_' + formID ).html('Video Published!');
	        $('#published_' + formID ).remove();
	    }
	});
});


</script>

{{-- <form action="{{ URL::to('editVideo') }}" method="post" class="video-form" id="{{ 'form_'.$counter }}">
	<input type="hidden" id="{{ 'id_'.$counter }}" name="video_id" value="{{ $videoData->videoID }}}"/>

	<label for="video-title">Video Title</label><br>
	<input type="text" id="{{ 'title_'.$counter }}" name="video_title" value="{{ $videoData->title }}"/><br>

	<label for="video-description">Video Description</label> <br>
	<input type="text" id="{{ 'description_'.$counter }}" name="video_description" /><br> 

	<label>Tags </label><br>
	<ul class="myTags" id="{{ 'myTag_'.$counter }}"><li>Tag1</li><li>Tag2</li></ul>

	<label>Category</label><br>
	{{ Form::select('category', $categories, null, array('id' => 'category_' . $counter)) }}

	<label>Thumbnail</label><br>
	<img src="{{ $thumb }}"><br>

	<span id="{{ 'response_'.$counter }}"></span>
	<input type="submit" name="submit" class="formBtn" id="{{ 'published_'.$counter }}" value="Publish" />
</form> --}}



