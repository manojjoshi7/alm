<div class="right_col" role="main">
<br />
<h2><?php echo $nameofimage;?></h2>
    <?php
$image=str_replace('.','_thumb.',$images_name);
?>
<div class="zoom-wrapper">

<div class="zoom-left" style="display:block !important;">
<img style="border:1px solid #e8e8e6;" id="zoom_03" src="<?php echo base_url('assets/design/designupload/admin/small/'.$image.'');?>" 
data-zoom-image="<?php echo base_url('assets/design/designupload/admin/large/'.$images_name.'');?>"
width="411"  />

<div id="gallery_01" style="width="500px">
<a  href="#" class="elevatezoom-gallery" data-update="" data-image="<?php echo base_url('assets/design/designupload/admin/small/'.$image.'');?>" 
data-zoom-image="<?php echo base_url('assets/design/designupload/admin/large/'.$images_name.'');?>">
<img src="<?php echo base_url('assets/design/designupload/admin/small/'.$image.'');?>" width="100"  /></a>
<?php
foreach($design_images as $row):
$image=str_replace('.','_thumb.',$row->img_name);
?>
<a  href="#" class="elevatezoom-gallery"
     data-image="<?php echo base_url('assets/design/designupload/admin/small/'.$image.'');?>"
 data-zoom-image="<?php echo base_url('assets/design/designupload/admin/large/'.$row->img_name.'');?>"><img src="<?php echo base_url('assets/design/designupload/admin/small/'.$image.'');?>" width="100"  /></a>


<?php
endforeach;
?>

</div>

</div>

</div>
<h2>Discreption</h2>
<p>
<?php
echo $design_info;
?>
</p>
<h2>Price</h2>
<p>
<?php
echo "$".$price;
?>
</p>
</div>




<script src="<?php echo base_url('assets/js/elevatezoom/jquery.elevateZoom-3.0.8.min.js');?>"></script>


 <script>
 $("#zoom_03").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active'}); 
  $("#zoom_03").bind("click", function(e) { var ez = $('#zoom_03').data('elevateZoom');	 
  $.fancybox(ez.getGalleryList()); return false; }); 
</script>