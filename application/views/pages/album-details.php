<?php echo $header; ?>
<!--=============== content-holder ===============-->
<div class="content-holder elem scale-bg2 transition3 slid-hol">
    <!--page title -->
    <div class="fixed-title"><span><?php echo $album[0]->title; ?></span></div>
      <div class="count-folio">
          <div class="num-album"></div>
          <div class="all-album"></div>
      </div>    
    <!--page title end -->
    <!--=============== content ===============-->
    <div class="content full-height">
        <!--=============== description column  ===============-->
        <div class="fixed-info-container">
            <h3><?php echo $album[0]->title; ?></h3>
            <div class="separator"></div>
            <div class="clearfix"></div>
            <p><?php echo $album[0]->description; ?></p>
            <h4>Info</h4>
            <ul class="project-details">
                <li>
                    <i class="fa fa-camera"></i>
                    <div class="pd-holder">
                        <h5>Photos in Album : <?php echo $album[0]->photos; ?></h5>
                    </div>
                </li>
                <li>
                    <i class="fa fa-calendar"></i>
                    <div class="pd-holder">
                        <h5>Date Created : <?php echo date("M d, Y", strtotime($album[0]->date_create)); ?></h5>
                    </div>
                </li>
                <li>
                    <i class="fa fa-calendar"></i>
                    <div class="pd-holder">
                        <h5>Last Updated : <?php echo date("M d, Y", strtotime($album[0]->date_update)); ?></h5>
                    </div>
                </li>
            </ul>
            <div class="content-nav">
                <ul>
                    <li><a href="/albums/"><i class="fa fa-long-arrow-left"></i> Back to Albums</a></li>
                </ul>
            </div>
        </div>
        <!--description column end -->
        <!-- portfolio  Images  -->                                        
        <div class="resize-carousel-holder vis-info">
            <div class="swiper-container viom" id="horizontal-slider" data-mwc="1" data-mwa="0">
                <div class="swiper-wrapper">
                  <?php if (!empty($album[0]->photoset)) : ?>
                    <?php foreach ($album[0]->photoset as $photo) : ?>
                      <div class="swiper-slide">
                          <div class="bg bg-slider" style="background-image:url(<?php echo $photo->orig_size; ?>)"></div>
                          <div class="zoomimage"><img src="<?php echo $photo->orig_size; ?>" class="intense" alt=""><i class="fa fa-expand"></i></div>
                          <?php if ($photo->title) : ?>
                            <div class="show-info">
                                <span>Info</span> 
                                <div class="tooltip-info">
                                    <h5><?php echo $photo->title; ?></h5>
                                    <?php echo ($photo->description) ? "<p>".$photo->description."</p>" : ""; ?>
                                </div>
                            </div>
                          <?php endif; ?>
                      </div>
                    <?php endforeach; ?>    
                  <?php endif; ?> 
                   
                </div>
                <div class="pagination hide"></div>
            </div>
            <!-- slider navigation  -->
<!--
            <div class="swiper-nav-holder hor hs">
                <a class="swiper-nav arrow-left transition " href="#"><i class="fa fa-angle-left"></i></a>
                <a class="swiper-nav  arrow-right transition" href="#"><i class="fa fa-angle-right"></i></a>
            </div>
-->
            <!-- slider navigation  end -->
        </div>
    </div>
    <!-- Content end  -->  
</div>
<!-- content holder end -->
<?php echo $footer; ?>