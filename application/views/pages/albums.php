<?php echo $header; ?>
<!--=============== Conten holder  ===============-->
<div class="content-holder elem scale-bg2 transition3" >
  <!--=============== Content  ===============-->
  <div class="content full-height">
      <div class="fixed-title"><span>Albums</span></div>
      <!-- Portfolio counter  -->	
      <div class="count-folio">
          <div class="num-album"></div>
          <div class="all-album"></div>
      </div>
      <!-- Portfolio counter end -->	
<!--
      <div class="filter-holder column-filter">
          <div class="filter-button">Filter <i class="fa fa-long-arrow-down"></i></div>
          <div class="gallery-filters hid-filter">
              <a href="#" class="gallery-filter transition2 gallery-filter_active" data-filter="*">All Albums</a>
              <a href="#" class="gallery-filter transition2" data-filter=".candids">Candids</a>
              <a href="#" class="gallery-filter transition2" data-filter=".pregnany">Pregnancy</a>
              <a href="#" class="gallery-filter transition2" data-filter=".birthdays">Birthdays</a>
              <a href="#" class="gallery-filter transition2" data-filter=".holidays">Holidays</a>              
              <a href="#" class="gallery-filter transition2" data-filter=".year-1">Year 1</a>
          </div>
      </div>
-->
      <!--=============== portfolio holder ===============-->
      <div class="resize-carousel-holder">
          <div class="p_horizontal_wrap">
              <div id="portfolio_horizontal_container">
              <?php if ($albums) : ?>
                <?php foreach ($albums as $album) : ?>
                  <!-- portfolio item -->
                  <div class="portfolio_item {tags}">
                      <img src="<?php echo (isset($album->lg1600_size)) ? $album->lg1600_size : $album->orig_size; ?>" alt="<?php echo $album->title; ?>">
                      <div class="port-desc-holder">
                          <div class="port-desc">
                              <div class="overlay"></div>
                              <div class="grid-item">
                                  <h3><a href="/albums/<?php echo $album->id; ?>/"><?php echo $album->title; ?></a></h3>
                                  <span><?php echo $album->description; ?></span>
                              </div>
                          </div>
                      </div>
                      <div class="port-subtitle-holder">
                          <div class="port-subtitle">
                              <h3><a href="/albums/<?php echo $album->id; ?>/"><?php echo $album->title; ?></a></h3>
                              <!-- <span><a href="#">{TAGS}</a></span> -->
                          </div>
                      </div>
                  </div>
                  <!-- portfolio item end -->
                <?php endforeach; ?>
              <?php endif; ?>                              
              </div>
              <!--portfolio_horizontal_container  end-->        
          </div>
          <!--p_horizontal_wrap  end-->                    
      </div>
  </div>
  <!-- Content end  -->  
</div>
<!-- content holder end -->
<?php echo $footer; ?>