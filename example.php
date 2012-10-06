<?php
if(isset($_POST['sign']) && $_POST['sign'] != '' && isset($_POST['img']) && $_POST['img'] != ''){
    
    require('signature.class.php');

    $s = new signature;

    /*
     * makes a new pdf with signature with the given filename
     * parameter: filename to be produced
     */
    $s->make_new_pdf('output_new'); // 

    /*
     * embed the signature as image in html file with the given filename
     * parameter: filename to be produced
     */    
    $s->embed_in_html('signature'); // embed the signature as image in html file with the given filename

    /*
     * makes a pdf with signature with the given filename, using an existing pdf as template    
     * parameters: filename to be produced, template pdf to be used
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ PUT A TEMPLATE (template.pdf) in the dir.
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Upload of binary data (phpclasses.org) was not permitted
     */     
    $s->use_template_pdf('output','template'); // 
    
    /*
     * DO NOT FORGET TO DELETE THE SIGNATURE (IMAGE)  
     */ 
        
     $s->delete_signature(); 
     
     // some feedback
     $msg = '<h3>Processed.</h3>';  
}
?>
<html>
    <head>
        
    </head>
    <body>
        <h1>Signature class</h1>
        <p>Makes possible to sign on a monitor (even better on a tablet) and places the signature in a new pdf, existing pdf or embed it in a html page</p>
        <hr>
        <h2>Place your signature on the line in the square below and click on 'Sign!'.</h2> 
        <?php if(isset($msg)) echo($msg)?> 
        <div id="signature" style="width:600px; height:150px; border: dotted 2px black; margin: 15px"></div> 
         <form action="?" id="f" method="post">
            <input type="hidden" name="sign" id="sign" />
            <input type="hidden" name="img" id="img" />
            <input type="button" value="Sign!" onclick="signature()" />
        </form>        
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="flashcanvas.js"></script>
        <![endif]-->
        <script src="jSignature.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#signature").jSignature()
            })
            function signature(){
                var $sigdiv = $("#signature");
                var datax = $sigdiv.jSignature("getData"); // for embedding is html page
                $('#sign').val(datax);
                var datax = $sigdiv.jSignature("getData","image"); // for creating image
                $('#img').val(datax);
                $sigdiv.jSignature("reset")
                $('#f').submit();
            }
        </script>           
    </body>
</html>