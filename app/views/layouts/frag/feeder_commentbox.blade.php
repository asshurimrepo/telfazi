<div class="">
	<div class="bg-info info-head" >
		<i class="fa fa-facebook-square"></i>  Write your Comment
	</div>
	<div class="info-space facebook-area" style="background: #fff; margin-bottom: 20px;">
		<div class="fb-comments"
		data-href="{{ URL::to('watch/'.$video->id) }}"
		data-width="100%"
		data-numposts="5" data-colorscheme="light">
		</div>
	</div>
</div>
<style type="text/css">

@media only screen and (max-width: 767px) {
.fb-comments {
    width: 100% !important;
   }
.fb-comments iframe[style] {
   width: 100% !important;
  }
.fb-comments  { background-color: #fff; !important; }
.fb-like-box {
   width: 100% !important;
  }
.fb-like-box iframe[style] {
   width: 100% !important;
  }
.fb-comments span {
   width: 100% !important;
  }
.fb-comments iframe span[style] {
   width: 100% !important;
  }
.fb-like-box span {
   width: 100% !important;
  }
.fb-like-box iframe span[style] {
   width: 100% !important;
  }
}
</style>