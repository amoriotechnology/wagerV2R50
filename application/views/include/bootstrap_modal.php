<?php 

if(in_array(BOOTSTRAP_MODALS['add_states'],$bootstrap_modal)){ ?>

<!-- Add States -->
<div class="modal fade modal-success" id="add_states" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New States</h3>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <?php echo form_open('Chrm/add_state', array('class' => 'form-vertical', 'id' => 'newcustomer')) ?>
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
               <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">State Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="state_name" id="" type="text" placeholder="State Name"  required="" tabindex="1">

                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />

                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"  value="Submit">
         </div>
         <?php echo form_close() ?>
      </div>
   </div>
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['add_state_tax'],$bootstrap_modal)){ ?>
 
 <!-- Add New State Tax  -->
<div class="modal fade modal-success" id="add_state_tax" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New States Tax</h3>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <?php echo form_open('Chrm/add_state_tax', array('class' => 'form-vertical', 'id' => 'add_state_tax')) ?>
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">State Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <select class="form-control" name="selected_state" required>
                        <option value="" selected disabled><?php echo display('select_one') ?></option>
                        <?php  foreach($states_list as $state){ ?>
                        <option value="<?php  echo $state['state']; ?>"><?php  echo $state['state']; ?></option>
                        <?php  }  ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">Tax Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="state_tax_name" id="" type="text" placeholder="State Tax Name"  required="" tabindex="1">

                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />

                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"   value="Submit">
         </div>
         <?php echo form_close() ?>
      </div>
   </div>
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['add_state_tax'],$bootstrap_modal)){ ?>

<!-- Add New City -->
<div class="modal fade modal-success" id="add_city_info" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New City</h3>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <?php echo form_open('Chrm/add_city', array('class' => 'form-vertical', 'id' => 'newcustomer')) ?>
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
               <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">City Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="city_name" id="" type="text" placeholder="City Name"  required="" tabindex="1">
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"  value="Submit">
         </div>
         <?php echo form_close() ?>
      </div>
   </div>
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['add_city_tax'],$bootstrap_modal)){ ?>

<!-- Add New City Tax -->

<div class="modal fade modal-success" id="add_city_tax" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New City Tax</h3>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <?php echo form_open('Chrm/add_city_state_tax', array('class' => 'form-vertical', 'id' => 'add_city_state_tax')) ?>
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">City Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <select class="form-control" name="selected_city" required>
                        <option value="" selected disabled><?php echo display('select_one') ?></option>
                        <?php  foreach($city_list as $city){ ?>
                        <option value="<?php  echo $city['state']; ?>"><?php  echo $city['state']; ?></option>
                        <?php  }  ?>
                     </select>
                  </div>
               </div> 
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">City Tax Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="city_tax_name" id="" type="text" placeholder="City Tax Name"  required="" tabindex="1">
                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"   value="Submit">
         </div>
         <?php echo form_close() ?>
      </div>
   </div>
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['add_county_info'],$bootstrap_modal)){ ?>

<!-- Add County -->
<div class="modal fade modal-success" id="add_county_info" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New County</h3>
         </div>   
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <?php echo form_open('Chrm/add_county', array('class' => 'form-vertical', 'id' => 'newcustomer')) ?>
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">County Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="county" id="" type="text" placeholder="County Name"  required="" tabindex="1">
                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"  value="Submit">
         </div>
         <?php echo form_close() ?>
      </div>
   </div>
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['add_county_tax'],$bootstrap_modal)){ ?>

<!-- Add New County Tax -->
<div class="modal fade modal-success" id="add_county_tax" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New County Tax</h3>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <?php echo form_open('Chrm/add_county_tax', array('class' => 'form-vertical', 'id' => 'add_county_tax')) ?>
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">County Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <select class="form-control" name="selected_county" required>
                        <option value="" selected disabled><?php echo display('select_one') ?></option>
                        <?php  foreach($county_list as $county){ ?>
                        <option value="<?php  echo $county['state']; ?>"><?php  echo $county['state']; ?></option>
                        <?php  }  ?>
                     </select>
                  </div>
               </div> 
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">County Tax Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="county_tax_name" id="" type="text" placeholder="County Tax Name"  required="" tabindex="1">
                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"   value="Submit">
         </div>
         <?php echo form_close() ?>
      </div>
   </div>
</div>
<?php } ?>