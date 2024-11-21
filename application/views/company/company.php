<!-- Company List Start -->
<style>
.btnclr{
   background-color:<?= $setting_detail[0]['button_color']; ?>;
   color: white;
}
</style>


<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?= display('manage_company') ?></h1>
         <small></small>
         <ol class="breadcrumb">
            <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
            <li><a href="#"><?= display('web_settings') ?></a></li>
            <li class="active" style="color:orange;" ><?= display('manage_company') ?></li>
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
         <?= $message ?>                    
      </div>
      <?php 
         $this->session->unset_userdata('message');
         }
         $error_message = $this->session->userdata('error_message');
         if (isset($error_message)) {
         ?>
      <div class="alert alert-danger alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?= $error_message ?>                    
      </div>
      <?php $this->session->unset_userdata('error_message'); } ?>

      <!-- Company List -->
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-heading">
                  <div class="panel-title">
                      <a href="<?= base_url('company_setup/company_branch'); ?>" class="btnclr btn m-b-5 m-r-2" style="color:white;" ><i class="ti-plus"> </i> <?= display('Add Company') ?>  </a>
                  </div>
               </div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <div class="sortableTable__container">
                     <div class="sortableTable__discard">
                     </div>
                     <table  id="ProfarmaInvList" class="table table-bordered table-striped table-hover">
                        <thead class="sortableTable">
                           <tr class="sortableTable__header btnclr">
                              <th class="1 value" data-col="1"><?= display('sl') ?></th>
                              <th class="text-center 2 value" data-col="2"><?= display('name') ?></th>
                              <th class="text-center 3 value" data-col="3"><?= display('address') ?></th>
                              <th class="text-center 4 value" data-col="4"><?= display('mobile') ?></th>
                              <th class="text-center 5 value" data-col="5"><?= display('website') ?></th>
                              <th class="text-center 6 value" data-col="6"><?= display('action') ?></th>
                           </tr>
                        </thead>
                        <tbody class="sortableTable__body">
                           
                           <?php 
                              if ($company_admin_info) {
                              	$i =1;
                              	foreach($company_admin_info as $list){
                              		echo "<tr class='task-list-row'>
                                       <td class='1 value' data-col='1'>".$i."</td>
                                       <td class='2 value' data-col='2'>".$list["company_name"]."</td>
                                       <td class='3 value' data-col='3'>".$list["address"]."</td>
                                       <td class='4 value' data-col='4'>".$list["mobile"]."</td>
                                       <td class='5 value' data-col='5'>".$list["website"]."</td>";
                           ?>
                           <td class="6 value" data-col="6">
                              <center>
                              <?= form_open()?>
                                 <a href="<?= base_url().'Company_setup/company_update_form/'.$list['company_id']; ?>" class="btnclr btn m-b-5 m-r-2" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                              <?= form_close()?>
                              </center>
                           </td>
                           </tr>

                           <!-- {/company_list} -->
                           <?php $i++;	} } ?>
                        </tbody>
                     </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- Company List End -->


<script type="text/javascript">
   $(document).ready(function() {
      // Function to store the visibility state of rows in localStorage
      function storeVisibilityState() {
         var ManageCompanylistvisibilityStates = {};
         $("#ProfarmaInvList tr").each(function(index, element) {
               var row = $(element);
               var rowID = index;
               var isVisible = row.is(':visible');
               ManageCompanylistvisibilityStates[rowID] = isVisible;
         });
         // Store the visibility states in localStorage
         localStorage.setItem("ManageCompanylistvisibilityStates", JSON.stringify(ManageCompanylistvisibilityStates));
      }

      // Apply the stored visibility state on page load
      function applyVisibilityState() {
         var storedVisibilityStates = JSON.parse(localStorage.getItem("ManageCompanylistvisibilityStates")) || {};
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

</script>