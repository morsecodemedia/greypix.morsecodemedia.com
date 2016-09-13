<?php echo $header; ?>
<!--=============== Conten holder  ===============-->
<div class="content-holder elem scale-bg2 transition3" >
    <!-- Fixed title  -->	
    <div class="fixed-title"><span>Home</span></div>
    <!-- Fixed title end -->
    <!--=============== Content ===============-->  
    <div class="content full-height">
        <!-- Home wrapper -->
        <div class="full-height-wrap">
            <!-- Hero title -->
            <div class="slide-title-holder">
                <div class="slide-title">
                    <span class="subtitle">The Life of Greyson George:</span><br />
                    <span class="subtitle2">A Photo and Video Documentary.</span>
                    <div class="separator-image"><img src="/dist/images/separator.png" alt=""></div>
                    <div class="hero-text-holder">
                        <div class="hero-text owl-carousel">
                            <div class="item">Day-to-day<br />Life</div>
                            <div class="item">Birthdays &amp;<br />Holidays</div>
                            <div class="item">Vacations</div>
                        </div>
                    </div>
                    <h4><a href="/albums/">Enter</a></h4>
                </div>
            </div>
            <!-- Hero title end  -->           
            <!-- Homepage Sliders (4 sliders / 3 slides per slider) -->             
            <?php
              if ($randPix) :
                $i = 0;
                foreach ($randPix as $rp):
                  $i++;
                  if ($i%3 == 1) :
            ?>
                    <div class="hero-grid">
                      <div class="overlay"></div>
                      <div class="hero-slider <?php echo ($i==1) ? "synkslider" : ""; ?> owl-carousel" data-attime="3220" data-rtlt="false">
            <?php endif; ?>
                        <div class="item">
                          <div class="bg" data-src="<?php echo (isset($rp->lg1600_size)) ? $rp->lg1600_size : $rp->orig_size; ?>"></div>
                        </div>
            <?php if ($i%3 == 0) : ?>
                      </div>
                    </div>
            <?php 
                  endif;
                endforeach;
              endif;
            ?>
            <!-- Homepage Sliders end -->
        </div>
    </div>
</div>
<!-- content holder end -->
<?php echo $footer; ?>