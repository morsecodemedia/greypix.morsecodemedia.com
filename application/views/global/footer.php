            </div><!-- wrapper end -->
            <div class="left-decor"></div>
            <div class="right-decor"></div>
            <!--=============== Footer ===============-->
            <footer>
                <div class="policy-box">
                    <span><?php echo $this->config->item('copyright'); ?></span> 
                </div>
                <div class="to-top"><i class="fa fa-angle-up"></i></div>
            </footer>
            <!-- footer end -->
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="/dist/js/jquery.min.js"></script>
        <script type="text/javascript" src="/dist/js/plugins.js"></script>
        <script type="text/javascript" src="/dist/js/scripts.js"></script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
          
          ga('create', '<?php echo $this->config->item('google'); ?>', 'auto');
          ga('send', 'pageview');        
        </script>
    </body>
</html>