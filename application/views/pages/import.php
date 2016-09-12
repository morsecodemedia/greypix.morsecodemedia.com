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
                    <div id="status-report"></div>
                    <button id="import-script" class="btn anim-button trans-btn transition text-center">
                      <span>Import Pictures</span>
                      <i class="fa fa-cloud-download"></i>
                    </button>
                    <div id="import-loader" class="hide">
                      <span class="arrows st"></span>
                      <span class="arrows nd"></span>
                      <span class="arrows rd"></span>
                      <span class="arrows th"></span>
                      <span class="arrows fth"></span>
                      <span class="arrows sth"></span>
                      <span class="arrows vth"></span>
                      <span class="loading">Importing Pictures</span>
                    </div>
                </div>
            </div>
        </section>
        <!--  Section contact form end  -->
    </div>
    <!-- Content end  -->  
</div>
<!-- content holder end -->
<?php echo $footer; ?>