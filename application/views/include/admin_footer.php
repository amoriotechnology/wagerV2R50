<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
?>
<footer class="main-footer">
    <i><span style="font-style: normal;" > 2024 © Copyright : Amorio Technologies </span></i>
    <input type ="hidden" name="csrf_test_name" id="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
    <input type ="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
</footer>
<style>
   #files-area{
 
   margin: 0 auto;
   }
   .file-block{
   border-radius: 10px;
   background-color: #38469f;
   margin: 5px;
   color: #fff;
   display: inline-flex;
   padding: 4px 10px 4px 4px;
   }
   .file-delete{
   display: flex;
   width: 24px;
   color: initial;
   background-color: #38469f;
   font-size: large;
   justify-content: center;
   margin-right: 3px;
   cursor: pointer;
   color: #fff;
   }
   span.name{
   position: relative;
   top: 2px;
   }
   .btn-primary {
   color: #fff;
   background-color: #38469f !important;
   border-color: #38469f !important;
   }
   a:active{
    color: #fff !important;
   }

   a:hover{
    color: #000 !important;
   }

   a:focus{
    color: #fff !important;
   }

   .btnclr{
       background-color:<?php echo $setting_detail[0]['button_color']; ?>;
       color: white;
    }

    .toast-success {
        background-color: #006400 !important; 
        color: white !important;
        opacity: 0;
        animation: fadeIn 1s forwards; 
    }

    @keyframes fadeIn {
        from {
            opacity: 0; 
        }
        to {
            opacity: 1; 
        }
    }
</style>




<script type="text/javascript">
   const dt = new DataTransfer(); 
   
   $('span.file-delete').click(function(){
    alert('hi');
           let name = $(this).next('span.name').text();
           $(this).parent().remove();
           for(let i = 0; i < dt.items.length; i++){
              
               if(name === dt.items[i].getAsFile().name){
                  
                   dt.items.remove(i);
                   continue;
               }
           }
          
           document.getElementById('attachment').files = dt.files;
       });
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2.min.css">
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/datatables/dataTables.colReorder.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datatables/buttons.dataTables.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables/buttons.colVis.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/datatables/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons.print.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/number-to-words"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/css.css" />
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/jspdf.umd.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/html2canvas.js"></script>

