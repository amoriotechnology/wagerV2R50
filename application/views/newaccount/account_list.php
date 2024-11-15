<?php error_reporting(1);  ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.base64.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/drag_drop_index_table.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jspdf.plugin.autotable"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jspdf.umd.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>my-assets/js/invoice_tableManager.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<!--<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />-->
<!-- <script type="text/javascript" src="<?php echo base_url()?>my-assets/js/tableManager.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script type="text/javascript" src="http://mrrio.github.io/jsPDF/dist/jspdf.debug.js"></script>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="<?php echo base_url() ?>assets/js/dashboard.js" ></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>my-assets/css/style.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="http://www.bacubacu.com/colresizable/js/colResizable-1.5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>my-assets/css/css.css" />
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>my-assets/css/css.css" />
<!-- <script type="text/javascript" src="http://www.bacubacu.com/colresizable/js/colResizable-1.5.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>my-assets/css/css.css" />
<style>
.btnclr{
       background-color:<?php echo $setting_detail[0]['button_color']; ?>;
       color: white;

   }
   table {
   border-collapse: collapse;
   width: 100%;
   margin-bottom: 20px;
   }
   /* Style the table header */
   thead {
   background-color: #333;
   color: #fff;
   text-align: center;
   }
   thead th {
   padding: 10px;
   border: 1px solid #000;
   }
   /* Style the table rows */
   tbody tr:nth-child(even) {
   background-color: #f2f2f2;
   }
   tbody tr:hover {
   background-color: #ddd;
   }
   tbody td {
   padding: 10px;
   border: 1px solid #000;
   text-align: center;
   }
   th{
   text-align:center;
   padding:10px !important;
   }
   
  
      .logo-9 i{
    font-size:80px;
    position:absolute;
    z-index:0;
    text-align:center;
    width:100%;
    left:0;
    top:-10px;
    color:#34495e;
    -webkit-animation:ring 2s ease infinite;
    animation:ring 2s ease infinite;
}
.logo-9 h1{
    font-family: 'Lora', serif;
    font-weight:600;
    text-transform:uppercase;
    font-size:40px;
    position:relative;
    z-index:1;
    color:#e74c3c;
    text-shadow: 3px 3px 0 #fff, -3px -3px 0 #fff, 3px -3px 0 #fff, -3px 3px 0 #fff;
}
   
   
  
   .logo-9{
    position:relative;
} 
   
   /*//side*/
   
.bar {
  float: left;
  width: 25px;
  height: 3px;
  border-radius: 4px;
  background-color: #4b9cdb;
}


.load-10 .bar {
  animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
}


@keyframes loadingJ {
  0%,
  100% {
    transform: translate(0, 0);
  }

  50% {
    transform: translate(80px, 0);
    background-color: #f5634a;
    width: 130px;
  }
}

   
   
   
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>my-assets/css/balance_sheet.css" />
<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         
      
      <figure class="one">
               <img src="<?php echo base_url()  ?>asset/images/accountlist.png"  class="headshotphoto" style="height:50px;" />
      </div>
      
      
      
      <div class="header-title">
         
         
         
           <div class="logo-holder logo-9">
         <h1><?php echo "Account List"; ?></h1>
       </div>
         
         
         
         <small><?php //echo "Vocher Report"; ?></small>
         <ol class="breadcrumb"   style="border:3px solid #d7d4d6;" >
            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
            <li><a href="#"><?php echo "Accounts"; ?></a></li>
            <li class="active" style="color:orange;"><?php echo "Account List"; ?></li>
       
        <div class="load-wrapp">
      <div class="load-10">
         <div class="bar"></div>
      </div>
    </div>
       
       
       
         </ol>
      </div>
   </section>
   <section class="content">
      <!-- Alert Message -->
      <?php
         $message = $this->session->userdata('message');
         if (isset($message)) {
             ?>
      <div class="alert alert-info alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?php echo $message ?>                    
      </div>
      <?php
         $this->session->unset_userdata('message');
         }
         $error_message = $this->session->userdata('error_message');
         if (isset($error_message)) {
         ?>
      <div class="alert alert-danger alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?php echo $error_message ?>                    
      </div>
      <?php
         $this->session->unset_userdata('error_message');
         }
         ?>
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag"      style="border:3px solid #d7d4d6;"    >
               <div class="panel-body" style='height:60px;'>
                  <div class="row" id="">
                     <div class="col-sm-12" style='height:10px;'>
                        <div class="col-sm-5"></div>
                        <?php echo form_open_multipart('accounts/treeview_form', array('class' => 'form-vertical', 'id' => 'insert_sale', 'name' => 'insert_sale')) ?>
                        <?php
                           $today = date('Y-m-d');
                           ?>            
                        <div class="col-sm-4 form-group" style="display: inline-block; vertical-align: middle;">
                           <!-- <div class="form-group row"     style="width: 300px;"> -->
                           <input type="text" class="form-control daterangepicker-field" name="daterangepicker-field"
                              style="padding: 5px;width: 200px;border-radius: 8px;height: inherit;"/>
                           <button type="submit" class="btn btnclr dropdown-toggle" style="margin-bottom: 10px;" ><i class="fa fa-search-plus" aria-hidden="true"></i> <?php echo display('search') ?></button> 
                        </div>
                        <div class='col-sm-2' style='text-align:end;'>
                           <div class="dropdown bootcol" id="drop" style="    width: 300px;">
                              <button class="btnclr btn btn-default dropdown-toggle" type="button"   id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              <span class="fa fa-download"></span> <?php echo display('download') ?>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                 <li><a href="#" onclick="generate()"> <img src="<?php echo base_url() ?>assets/images/pdf.png" width="24px"> <?php echo display('PDF') ?></a></li>
                                 <li class="divider"></li>
                                 <li><a href="#" onclick="fnExcelReport()"> <img src="<?php echo base_url() ?>assets/images/xls.png" width="24px"> <?php echo display('XLS') ?></a></li>
                              </ul>
                              &nbsp;
                              <button type="button"   class="btnclr btn btn-default dropdown-toggle"  onclick="printDiv('printableArea')"><b class="ti-printer"></b>&nbsp;<?php echo display('print') ?></button>
                           </div>
                        </div>
                        <?php echo form_close() ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag" id="printArea"   style="border:3px solid #d7d4d6;"  >
               <div class="panel-body">
                  <table class="print-table " width="100%">
                    
                    
                         <tr>
                            <td style='height:10px;padding: 0px;' colspan="3" align="center">
                                <h2 class="statement"><?php echo "Account List"; ?> </h2>
                            </td>
                        </tr>
                     
                     
                     
                     
                     <?php   if($start){ ?>
                     <tr class="table_head">
                        <td colspan="3" align="center"  style='border:none;background-color:white;' class="equivalent"><b>From
                           <?php echo html_escape($start); ?> To
                           <?php echo html_escape($end); ?></b>
                        </td>
                     </tr>
                     <?php  } ?>
                  </table>
                  <div class="sortableTable__container">
                     <div class="sortableTable__discard">
                     </div>
                     <table width="80%" class="table_boxnew table-bordered" style='text-align:center;' id="ProfarmaInvList" cellpadding="0" cellspacing="0">
                        <thead class="sortableTable">
                           <tr class="sortableTable__header btnclr">
                              <!--<th class="1 value" data-col="1">Customer/Vendor</th>-->
                              <!--<th class="2 value" data-col="2">Invoice/Bill</th>-->
                              <th class="1 value" data-col="1">Account Category</th>
                              <th class="2 value" data-col="2">Account Sub Category</th>
                              <th class="3 value" data-col="3">Account Subsub Category</th>
                              <th class="4 value" data-col="4">Remarks</th>
                              <th class="5 value" data-col="5">Balance</th>
                           </tr>
                        </thead>
                        <tbody class="sortableTable__body" id="tab">
                        <?php $totalinvoice = 0; 
                        if(!empty($invoice_data)){ foreach ($invoice_data as $key => $arr) { $totalinvoice += floatval(str_replace(',', '', $arr->providerdue_amount));   ?>
                           <tr class="task-list-row">
                               <td class="1 value" data-col="1"><?php echo $arr->account_category; ?></td>
                               <td class="2 value" data-col="2"><?php echo $arr->sub_category; ?></td>
                               <td class="3 value" data-col="3"><?php echo $arr->account_subcat; ?></td>
                               <td class="4 value" data-col="4"><?php echo $arr->remark; ?></td>
                               <td class="5 value" data-col="5"><?php echo $currency . $arr->providerdue_amount; ?></td>
                           </tr>
                        <?php } ?>  
                        
                        <?php $totalexpense = 0; 
                        foreach ($expense_data as $key => $exarr) { $totalexpense += floatval(str_replace(',', '', $exarr->providerbalance_amount));  ?>
                            <tr class="task-list-row">
                               <td class="1 value" data-col="1"><?php echo $exarr->account_category; ?></td>
                               <td class="2 value" data-col="2"><?php echo $exarr->sub_category; ?></td>
                               <td class="3 value" data-col="3"><?php echo $exarr->account_subcat; ?></td>
                               <td class="4 value" data-col="4"><?php echo $exarr->remarks; ?></td>
                               <td class="5 value" data-col="5"><?php echo $currency . $exarr->providerbalance_amount; ?></td>
                           </tr>
                           
                        <?php } ?>      
                        
                        <?php $totalservice = 0; 
                        foreach ($services_data as $key => $sarr) { $totalservice += floatval(str_replace(',', '', $sarr->providerbalances_amount));  ?>
                            <tr class="task-list-row">
                               <td class="1 value" data-col="1"><?php echo $sarr->acc_cat_name; ?></td>
                               <td class="2 value" data-col="2"><?php echo $sarr->acc_cat; ?></td>
                               <td class="3 value" data-col="3"><?php echo $sarr->acc_sub_name; ?></td>
                               <td class="4 value" data-col="4"><?php echo $sarr->memo_details; ?></td>
                               <td class="5 value" data-col="5"><?php echo $currency . $sarr->providerbalances_amount; ?></td>
                           </tr>
                           
                        <?php } ?> 
                        <tr class="task-list-row">
                            <td class="1 value" data-col="1"></td>
                            <td class="2 value" data-col="2"></td>
                            <td class="3 value" data-col="3"></td>
                            <td class="4 value text-right" data-col="4"><b>Total Balances</b></td>
                            <td class="5 value" data-col="5"><b><?php echo $currency . number_format($totalinvoice + $totalexpense + $totalservice, 2); ?></b></td>
                        </tr>
                        <?php }else{ ?>   
                        <tr>
                            <td colspan='7' class="text-center">No Results found</td>
                        </tr>
                        <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="<?php echo base_url()?>assets/js/jquery.bootgrid.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.0-alpha.1/jspdf.plugin.autotable.js"></script>
      <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
      <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-debug.js'></script>
      <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
      <script  src="<?php echo base_url() ?>my-assets/js/script.js"></script> 
      <script src="<?php echo base_url()?>assets/js/jquery.bootgrid.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.0-alpha.1/jspdf.plugin.autotable.js"></script>
      <script>
         $('.datepickers').datepicker({
           dateFormat: 'yy-mm-dd'
         });
      </script>
      <script type="text/javascript">
         function generate() {
         var utc = new Date().toJSON().slice(0,10).replace(/-/g,'/');
         $(".myButtonClass").hide();
         var doc = new jsPDF("p", "pt");
         var res = doc.autoTableHtmlToJson(document.getElementById("ProfarmaInvList"));
         var height = doc.internal.pageSize.height;
         //doc.text("Generated PDF", 50, 50);
         
         doc.autoTable(res.columns, res.data, {
         startY: doc.autoTableEndPosY() + 50,
         });
         doc.save("Account_List_"+utc+".pdf");
         }
         $(document).ready(function() {
         
         // Function to store the visibility state of rows in localStorage
         function storeVisibilityState() {
         var bankaccountlistvisibilityStates = {};
         $("#ProfarmaInvList tr").each(function(index, element) {
         var row = $(element);
         var rowID = index;
         var isVisible = row.is(':visible');
         bankvisibilityStates[rowID] = isVisible;
         });
         // Store the visibility states in localStorage
         localStorage.setItem("bankaccountlistvisibilityStates", JSON.stringify(bankaccountlistvisibilityStates));
         }
         // Apply the stored visibility state on page load
         function applyVisibilityState() {
         var storedVisibilityStates = JSON.parse(localStorage.getItem("bankaccountlistvisibilityStates")) || {};
         $("#ProfarmaInvList tr").each(function(index, element) {
         var row = $(element);
         var rowID = index;
         if (storedVisibilityStates.hasOwnProperty(rowID) && !storedVisibilityStates[rowID]) {
          row.hide();
         } else {
          row.show();
         }
         });
         }
         // Event listener for row clicks to toggle row visibility
         $(".bank_edit").on('click', function() {
         var row = $(this);
         row.toggle();
         storeVisibilityState(); // Store the updated visibility state
         });
         applyVisibilityState(); 
         });
         
         
         
         function fnExcelReport()
         {
         table = $('#ProfarmaInvList').clone();
         
         
         
         var hyperLinks = table.find('a');
         
         var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
         var textRange; var j=0;
         tab = document.getElementById('ProfarmaInvList'); // id of table
         
         for(j = 0 ; j < tab.rows.length ; j++) 
         {   var sp=  $(hyperLinks[j]).text();
         tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
         //tab_text=tab_text+"</tr>";
         console.log(sp);
         }
         
         tab_text=tab_text+"</table>";
         tab_text= tab_text.replace(/<a[^>]*>/g, "");
         tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
         tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
         tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
         
         var ua = window.navigator.userAgent;
         var msie = ua.indexOf("MSIE "); 
         
         if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
         {
         txtArea1.document.open("txt/html","replace");
         txtArea1.document.write(tab_text);
         txtArea1.document.close();
         txtArea1.focus(); 
         sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
         }  
         else                 //other browser not tested on IE 11
         sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  
         
         return (sa);
         }
         
      </script>
   </section>
</div>