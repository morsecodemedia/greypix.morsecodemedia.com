<?php echo $header; ?>
<!--=============== Conten holder  ===============-->
<div class="content-holder elem scale-bg2 transition3" >
    <!--  Page title    -->
    <div class="fixed-title"><span>Import</span></div>
    <!--  Page title end   -->

    <div class="content full-height">

        <!--  Section contact form  -->
        <section class="flat-form" id="sec3">
            <div class="container">
                <h2>Import Photos from Flickr</h2>
                <div id="contact-form">
                    <?php if ( ($this->uri->segment(2, 0) === 0) ) : ?>
                      <a href="/import/import-albums/" id="import-script" class="btn anim-button trans-btn transition text-center">
                        <span>Import Pictures</span>
                        <i class="fa fa-cloud-download"></i>
                      </a>
                    <?php else : ?>
                      <div id="status-report" class="text-center;">
                        <?php echo $message; ?>
                      </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!--  Section contact form end  -->
    </div>
    <!-- Content end  -->  
</div>
<!-- content holder end -->
<?php echo $footer; ?>