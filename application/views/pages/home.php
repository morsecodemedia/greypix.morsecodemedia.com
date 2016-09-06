<?php
  if ($randPix) :
    $item = array_chunk($randPix, 3, true); 
    echo "<pre>"; print_r($item); echo "</pre>";
  endif;
  exit; 
?>

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
            
<!--
            <?php
              if ($randPix) :
                $item = array_chunk($randPix, 3, true); 
              endif; 
            ?>
-->
            
            <!-- 1 -->
            <div class="hero-grid">
                <div class="overlay"></div>
                <div class="hero-slider synkslider owl-carousel" data-attime="3220" data-rtlt="false">
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                </div>
            </div>
            <!-- 1 end -->
            <!-- 2 -->
            <div class="hero-grid">
                <div class="overlay"></div>
                <div class="hero-slider owl-carousel" data-attime="3220" data-rtlt="false">
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                </div>
            </div>
            <!-- 2end -->
            <!-- 3 -->
            <div class="hero-grid">
                <div class="overlay"></div>
                <div class="hero-slider owl-carousel"  data-attime="3220" data-rtlt="true">
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                </div>
            </div>
            <!-- 3end -->
            <!-- 4 -->
            <div class="hero-grid">
                <div class="overlay"></div>
                <div class="hero-slider owl-carousel" data-attime="3220" data-rtlt="true">
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                    <div class="item">
                        <div class="bg" style="background-image:url(/dist/images/bg/1.jpg)"></div>
                    </div>
                </div>
            </div>
            <!-- 4end -->
        </div>
    </div>
</div>
<!-- content holder end -->
<?php echo $footer; ?>