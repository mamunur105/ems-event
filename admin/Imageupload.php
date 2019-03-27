<?php
/*
image Upload widget 
*/
namespace Admin;
class Imageupload extends \WP_Widget {

	function __construct() {
		// Instantiate the parent objectAdvertisement
		parent::__construct( 'image-upload', 'Image Upload' ,array(
				'description'=> "Image Upload"
			));
	}

	function widget( $args, $instance ) {
		// Widget output
		echo $args["before_widget"];
		  $image = (!empty($instance['image'])) ? $instance['image'] : '' ;
			 ?>

				<div class="biggapon-style biggapon-style-one">
					<img class="img-link" src="<?php echo $image  ; ?>" width="100%">
	            </div>

			<?php
		echo $args["after_widget"] ;
	}

	function form( $instance ) {	
	  $image = (!empty($instance['image'])) ? $instance['image'] : '' ;
	  ?>
	  <p class="image-show-area">
				<button class="button clear_image right" >clear Image</button>
				<button class="button author_info_image" >Upload Image</button>
				<input type="hidden" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image ; ?>" class="widefat image_link" id="<?php echo $this->get_field_id('image')?>" >
				<span class="image-show"><img class="img-link" style="margin-top:10px;" src="<?php echo $image  ; ?>" width="100%"></span>	
			</p>
	 
	 <?php
	 }
}







