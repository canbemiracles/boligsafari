    <footer id="footer" class="top-space">

        <div class="footer1">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-4 widget">
                        <?php render_widgets('footer_first_column');?>
                    </div>

                    <div class="col-md-4 widget">
                        <?php render_widgets('footer_second_column');?>
                    </div> 

                    <div class="col-md-4 widget">
                         <h3 class="widget-title">Lejibyen.dk</h3>
<div class="widget-body">
    <p>Med Lejibyen.dk er det nemt at leje og udleje en bolig<br><br>

Lejibyen.dk gør det nemt og sikkert at leje en bolig rundt om i landets største byer. Vi er Danmarks billigste boligportal og garanterer den højeste kvalitet på markedet inden for private lejemål.</p>
</div>   
                    </div>

                </div> <!-- /row of widgets -->
            </div>
        </div>

       

    </footer>
    <a href="#" class="scrollToTop">Top</a>
    <style type="text/css">
    .scrollToTop{
        width:50px; 
        height:40px;
        padding:10px; 
        text-align:center; 
        background: whiteSmoke;
        font-weight: bold;
        color: #444;
        text-decoration: none;
        position:fixed;
        top:75px;
        right:10px;
        display:none;
        background: #222;
        opacity: .9;
        color: #fff;
        border-radius: 4px;
    }
    .scrollToTop:hover{
        text-decoration:none;
    }
    </style> 

    <script type="text/javascript">
     jQuery(document).ready(function(){
    
        //Check to see if the window is top if not then display button
        jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() > 150) {
                jQuery('.scrollToTop').css('top',jQuery(window).height()-70);                
                jQuery('.scrollToTop').fadeIn();
            } else {
                jQuery('.scrollToTop').fadeOut();
            }
        });
        
        //Click event to scroll to top
        jQuery('.scrollToTop').click(function(){
            jQuery('html, body').animate({scrollTop : 0},800);
            return false;
        });
    
    });
    </script>


<script type="text/javascript">
var clicky_site_ids = clicky_site_ids || [];
clicky_site_ids.push(240867);
(function() {
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = '//static.getclicky.com/js';
  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
})();
</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/240867ns.gif" /></p></noscript>
