<?php
/**
 * Whykiki Kontakte Nodul
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<div class="row">
    <div class="col-md-12">
       <h2 class="testimonialHeadline schatten"><?php echo $moduleHeadline; ?></h2>
    </div>
</div>
<div class="row testimonialRow">
    <div class="col-md-12">
        <!-- Carousel
		================================================== -->
        <div id="testimonialCarousel" class="carousel slide carousel-fade">
            <!-- Indicators -->
            <div class="carousel-inner">
	            <?php foreach ($newSorted as $item): ?>
                    <div class="item">
                        <div class="testimonialText schatten">
                            <blockquote><?php echo $item['customertext']; ?></blockquote>
                            <span class="customerName"><?php echo $item['customer']; ?></span>
                        </div>
                    </div>
	            <?php endforeach; ?>
            </div>
            <!-- <div class="carousel-controls">
                <a class="carousel-control left" href="#testimonialCarousel" data-slide="prev"><span class="fa fa-angle-double-left"></span></a>
                <a class="carousel-control right" href="#testimonialCarousel" data-slide="next"><span class="fa fa-angle-double-right"></span></a>
            </div> -->

        </div><!-- End Carousel -->
    </div>
</div>

<script>
    jQuery( document ).ready(function() {
        jQuery('#testimonialCarousel').carousel({
            interval:   4000
        });
        jQuery("#testimonialCarousel .carousel-inner .item:first").addClass("active");
    });
</script>