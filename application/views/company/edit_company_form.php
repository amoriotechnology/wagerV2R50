<style>
    .btnclr{
       background-color:<?php echo $setting_detail[0]['button_color']; ?>;
       color: white;
   }
</style>
<!-- Edit Company start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('company_edit') ?></h1>
            <small></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active" style="color:orange;"><?php echo display('company_edit') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- Edit Company -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    
                    <?php echo form_open_multipart('User/company_update_branch/'.$c_id,array('class' => 'form-vertical', 'id' => 'company_update'))?>
                    <div class="panel-body">
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?php echo display('Company Name') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="2" class="form-control" name="company_name" id="company_name" value="{company_name}"  placeholder="<?php echo display('company_name') ?>" required tabindex="1"/>
                            </div>
                        </div>
                        <input type="hidden" name="url_id" value="<?= (isset($_GET['id']) ? $_GET['id'] : ''); ?>">
                        <input type="hidden" name="url_admin_id" value="<?= (isset($_GET['admin_id']) ? $_GET['admin_id'] : ''); ?>">
                         <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="3" class="form-control" name="mobile"  id="mobile"  value="<?php  echo $mobile; ?>"   required tabindex="2"/>
                            </div>
                        </div>
                   <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo 'City'; ?><i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="1" class="form-control" value="<?php  echo $c_city; ?>" name="c_city" id="c_city" required placeholder="Enter your city" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo 'State'; ?><i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="1" class="form-control" value="<?php  echo $c_state; ?>" name="c_state" id="c_state" required placeholder="Enter your state" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"/>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <textarea class="form-control input-description" tabindex="3" id="adress" name="address" placeholder="<?php echo display('address') ?>" required>{address}</textarea>
                            </div>
                        </div>
                         <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Company Email<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="email" tabindex="3" class="form-control" value="{email}" name="email" placeholder="<?php echo display('email') ?>" required tabindex="4"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo display('website') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="url" tabindex="3" class="form-control" value="{website}" name="website" placeholder="<?php echo display('website') ?>" required tabindex="5"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo display('Bank_Name') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="3" class="form-control" value="{Bank_Name}" name="Bank_Name" placeholder="<?php echo display('Bank_Name') ?>"  tabindex="5"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'Account Number'?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="3" class="form-control" value="{Account_Number}" name="Account_Number" placeholder="<?php echo 'Account Number' ?>"  tabindex="5"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'Bank Routing Number' ?><i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="3" class="form-control" value="{Bank_Routing_Number}" name="Bank_Routing_Number" placeholder="<?php echo 'Bank Routing Number' ?>"  tabindex="5"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'Bank Address' ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="3" class="form-control" value="{Bank_Address}" name="Bank_Address" placeholder="<?php echo 'Bank Address' ?>"  tabindex="5"/>
                            </div>
                        </div>
                        <div class="form-group row">
                     <label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'Federal Identification Number' ?> <i class="text-danger"></i></label>
                     <div class="col-sm-6">
                        <input type="text" tabindex="3" class="form-control" value="{Federal_Pin_Number}" name="Federal_Pin_Number" placeholder="<?php echo 'Federal Identification Number' ?>"  tabindex="5"/>
                     </div>
                  </div>
<?php 
if(is_array($url)) {
    foreach($url as $dt) { 
        ?>
         <div class="form-group row">
                     <label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'User Name' ?> <i class="text-danger"></i></label>
                     <div class="col-sm-2">
                        <input type="text" tabindex="3" class="form-control" value="<?php echo $dt->user_name; ?>" name="user_name[]" placeholder="<?php echo 'User Name' ?>"  tabindex="5"/>
                     </div>
                     <label for="bank_name" class="col-sm-1 col-form-label"><?php echo 'Password' ?> <i class="text-danger"></i></label>
                     <div class="col-sm-2">
                        <input type="text" tabindex="3" class="form-control" value="<?php  echo $dt->password; ?>" name="password[]" placeholder="<?php echo 'Password' ?>"  tabindex="5"/>
                     </div>
                     <label for="bank_name" class="col-sm-1 col-form-label"><?php echo 'Pin Number' ?> <i class="text-danger"></i></label>
                     <div class="col-sm-2">
                        <input type="number" tabindex="3" class="form-control" value="<?php  echo $dt->pin_number; ?>" name="pin_number[]" placeholder="<?php echo 'pin number' ?>"  tabindex="5"/>
                     </div>
                  </div>
<div class="form-group row" id="url-group-1">
    <label class="col-sm-3 col-form-label">URL<i class="text-danger"></i></label>
    <div class="col-sm-6">
        <input type="url" tabindex="1" class="form-control" name="url[]" id="url" value="<?php  echo $dt->url; ?>" placeholder="Enter URL" />
    </div>
    <div class="col-sm-2">
        <button type="button" class="btnclr client-add-btn btn" onclick="addUrlField()"><i class="fa fa-plus"></i></button>
    </div>
</div>
        <?php   
    }
}  
?>
<div id="output"></div>
<div class="form-group row">
                     <label for="statetx" class="col-sm-3 col-form-label"><?php echo 'State Tax ID Number'?><i class="text-danger"></i></label>
                     <div class="col-sm-6">
                        <input list="magic_state_tax_id" name="statetx"  id="statetx" value="<?= $st_tax_id; ?>"  class="form-control" placeholder="Enter your State Tax ID Number" onchange="this.blur();" />
                        <datalist id="magic_state_tax_id">
                           <?php  foreach($editState as $st){  ?>
                           <option value="<?php  echo $st->state_tax_id ;?>"><?php  echo $st->state_tax_id ;?></option>
                           <?php  } ?>
                        </datalist>
                     </div>
                  </div>
<?php 
if(is_array($url_st)) {
    foreach($url_st as $dt) { 
        ?>
                  <div class="form-group row">
                     <label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'User Name (State tax)' ?> <i class="text-danger"></i></label>
                     <div class="col-sm-2">
                        <input type="text" tabindex="3" class="form-control" value="<?php echo $dt->user_name_st; ?>" name="user_name_st[]" placeholder="<?php echo 'User Name (State tax)' ?>"  tabindex="5"/>
                     </div>
                     <label for="bank_name" class="col-sm-1 col-form-label"><?php echo 'Password' ?> <i class="text-danger"></i></label>
                     <div class="col-sm-2">
                        <input type="text" tabindex="3" class="form-control" value="<?php  echo $dt->password_st; ?>" name="password_st[]" placeholder="<?php echo 'Password' ?>"  tabindex="5"/>
                     </div>
                     <label for="bank_name" class="col-sm-1 col-form-label"><?php echo 'Pin Number' ?> <i class="text-danger"></i></label>
                     <div class="col-sm-2">
                        <input type="number" tabindex="3" class="form-control" value="<?php  echo $dt->pin_number_st; ?>" name="pin_number_st[]" placeholder="<?php echo 'pin number' ?>"  tabindex="5"/>
                     </div>
                  </div>
<div class="form-group row" id="urlst-group-1">
    <label class="col-sm-3 col-form-label">URL(State tax)<i class="text-danger"></i></label>
    <div class="col-sm-6">
        <input type="url" tabindex="1" class="form-control" name="url_st[]" id="url_st" value="<?php  echo $dt->url_st; ?>"  placeholder="Enter URL" />
    </div>
    <div class="col-sm-2">
        <button type="button" class="btnclr client-add-btn btn" onclick="addUrlstField()"><i class="fa fa-plus"></i></button>
    </div>
</div>
<?php   }  }  ?>
<div id="outputst"></div>
<div class="form-group row">
                     <label for="localtx" class="col-sm-3 col-form-label"><?php echo 'Local Tax ID Number'?><i class="text-danger"></i></label>
                     <div class="col-sm-6">
                        <input list="magic_local_tax_id" name="localtx"  id="localtx" class="form-control" value="<?php echo $lc_tax_id; ?>" placeholder="Enter your Local Tax ID Number"    onchange="this.blur();" />
                        <datalist id="magic_local_tax_id">
                           <?php foreach($editLocal as $st){  ?>
                           <option value="<?php  echo $st->local_tax_id ;?>"><?php  echo $st->local_tax_id ;?></option>
                           <?php  } ?>
                        </datalist>
                     </div>
                  </div>
<?php 
if(is_array($url_lctx)) {
    foreach($url_lctx as $dt) { 
        ?>
<div class="form-group row">
<label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'User Name (Local tax)' ?> <i class="text-danger"></i></label>
<div class="col-sm-2">
   <input type="text" tabindex="3" class="form-control" value="<?php echo $dt->user_name_lctx; ?>" name="user_name_lctx[]" placeholder="<?php echo 'User Name (Local tax)' ?>"  tabindex="5"/>
</div>
<label for="bank_name" class="col-sm-1 col-form-label"><?php echo 'Password' ?> <i class="text-danger"></i></label>
<div class="col-sm-2">
   <input type="text" tabindex="3" class="form-control" value="<?php  echo $dt->password_lctx; ?>" name="password_lctx[]" placeholder="<?php echo 'Password' ?>"  tabindex="5"/>
</div>
<label for="bank_name" class="col-sm-1 col-form-label"><?php echo 'Pin Number' ?> <i class="text-danger"></i></label>
<div class="col-sm-2">
   <input type="number" tabindex="3" class="form-control" value="<?php  echo $dt->pin_number_lctx; ?>" name="pin_number_lctx[]" placeholder="<?php echo 'pin number' ?>"  tabindex="5"/>
</div>
</div>
<div class="form-group row" id="urllctx-group-1">
<label class="col-sm-3 col-form-label">URL(Local tax)<i class="text-danger"></i></label>
<div class="col-sm-6">
<input type="url" tabindex="1" class="form-control" name="url_lctx[]" id="url_lctx" value="<?php  echo $dt->url_lctx; ?>"  placeholder="Enter URL" />
</div>
<div class="col-sm-2">
<button type="button" class="btnclr client-add-btn btn" onclick="addUrllctxField()"><i class="fa fa-plus"></i></button>
</div>
</div>
<?php   }  }  ?>
<div id="outputlctx"></div>
<div class="form-group row">
                     <label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'State Sales Tax Number' ?> <i class="text-danger"></i></label>
                     <div class="col-sm-6">
                        <input type="text" tabindex="3" class="form-control" value="{State_Sales_Tax_Number}" name="State_Sales_Tax_Number" placeholder="<?php echo 'State Sales Tax Number' ?>"  tabindex="5"/>
                     </div>
                  </div>
                  <?php 
if(is_array($url_sstx)) {
    foreach($url_sstx as $dt) { 
        ?>
<div class="form-group row">
<label for="bank_name" class="col-sm-3 col-form-label"><?php echo 'User Name (State sales tax)' ?> <i class="text-danger"></i></label>
<div class="col-sm-2">
   <input type="text" tabindex="3" class="form-control" value="<?php echo $dt->user_name_sstx; ?>" name="user_name_sstx[]" placeholder="<?php echo 'User Name (State sales tax)' ?>"  tabindex="5"/>
</div>
<label for="bank_name" class="col-sm-1 col-form-label"><?php echo 'Password' ?> <i class="text-danger"></i></label>
<div class="col-sm-2">
   <input type="text" tabindex="3" class="form-control" value="<?php  echo $dt->password_sstx; ?>" name="password_sstx[]" placeholder="<?php echo 'Password' ?>"  tabindex="5"/>
</div>
<label for="bank_name" class="col-sm-1 col-form-label"><?php echo 'Pin Number' ?> <i class="text-danger"></i></label>
<div class="col-sm-2">
   <input type="number" tabindex="3" class="form-control" value="<?php  echo $dt->pin_number_sstx; ?>" name="pin_number_sstx[]" placeholder="<?php echo 'pin number' ?>"  tabindex="5"/>
</div>
</div>
<div class="form-group row" id="urlsstx-group-1">
<label class="col-sm-3 col-form-label">URL(State sales tax)<i class="text-danger"></i></label>
<div class="col-sm-6">
<input type="url" tabindex="1" class="form-control" name="url_sstx[]" id="url_sstx" value="<?php  echo $dt->url_sstx; ?>"  placeholder="Enter URL" />
</div>
<div class="col-sm-2">
<button type="button" class="btnclr client-add-btn btn" onclick="addUrlsstxField()"><i class="fa fa-plus"></i></button>
</div>
</div>
<?php   }  }  ?>
<div id="outputsstx"></div>
                  <input type="hidden" name="company_id" value="{company_id}" />
                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                     <div class="col-sm-6">
                        <input type="submit" id="add-Customer" class="btnclr btn m-b-5 m-r-2" name="add-Customer" value="Save" tabindex="6"/>
                     </div>
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </section>
</div>

