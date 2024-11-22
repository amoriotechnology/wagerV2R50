<?php  error_reporting(1); ?>
<div class="content-wrapper">
    <section class="content-header" style="height:70px;">
        <div class="header-icon"><i class="pe-7s-note2"></i></div>

        <div class="header-title">
            <h1>Payment Administration</h1>
            <small></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
                <li><a href="#">HRM</a></li>
                <li class="active" style="color:orange">Payment Administration</li>
            </ol>
        </div>
    </section>

<section class="content">
    <!-- New category -->
    <div class="row">
        <div class="col-sm-12">                
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading" style="height:50px;">
                    <div class="panel-title">
                        <a style="float:right;color:white;" href="<?php echo base_url('Chrm/manage_timesheet').'?id='.urlencode($_GET['id']).'&admin_id='.urlencode($_GET['admin_id']); ?>" class="btnclr btn  m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo "Manage TimeSheet" ?></a> 
                    </div>
                </div>               
                <?= form_open_multipart('Chrm/adminApprove?id=' . $_GET['id'],'id="validate"' ) ?>
                <div class="panel-body">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="customer" class="col-sm-4 col-form-label">Employee Name<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="hidden" readonly id="tsheet_id" value="<?= $time_sheet_data[0]['timesheet_id'];?>" name="tsheet_id" />
                                <input type="hidden" readonly id="unique_id" value="<?= $time_sheet_data[0]['unique_id'];?>" name="unique_id" />
                                <select name="templ_name" id="templ_name" class="form-control" tabindex="3" required>
                                    <?php foreach($employee_name as $pt){ ?>
                                        <option value="<?= $pt['id'] ;?>" <?= ($employee[0]['id'] == $pt['id']) ? 'selected' : '';  ?> ><?= $pt['first_name']." ".$pt['last_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                         <div class="col-sm-6">
                            <label for="qdate" class="col-sm-4 col-form-label">Job title</label>
                            <div class="col-sm-6">
                                <input type="text" name="job_title" id="job_title" readonly placeholder="Job title" value="<?= empty($employee_name[0]['designation']) ? 'Sales Partner' : $employee_name[0]['designation']; ?>" class="form-control">

                                <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="dailybreak" class="col-sm-4 col-form-label">Date Range<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input id="reportrange" type="text" readonly name="date_range" <?php if($time_sheet_data[0]['uneditable']==1){ echo 'readonly';}  ?> value="<?= $time_sheet_data[0]['month'] ; ?>" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="dailybreak" class="col-sm-4 col-form-label">Payroll Type <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input id="payroll_type" name="payroll_type" type="text" value="<?= $time_sheet_data[0]['payroll_type'] ; ?>" readonly class="form-control"/>
                            </div>
                        </div>
                    </div>
                    
                    <!-------------- Time Sheet table Start here -------------------->
                    <div class="table-responsive work_table col-md-12">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="PurList"> 
                            <thead class="btnclr">
                                <tr style="text-align:center;">  
                                    <?php if ($employee_name[0]['payroll_type'] == 'Hourly') { ?>
                                        <th style='height:25px;' class="col-md-2">Date</th>
                                        <th style='height:25px;' class="col-md-1">Day</th>
                                        <th class="col-md-1">Daily Break in mins</th>
                                        <th style='height:25px;' class="col-md-2">Start Time (HH:MM)</th>
                                        <th style='height:25px;' class="col-md-2">End Time (HH:MM)</th>
                                        <th style='height:25px;' class="col-md-5">Hours</th>
                                        <th style='height:25px;' class="col-md-5">Action</th>

                                    <?php } elseif ($employee_name[0]['payroll_type'] == 'Salaried-weekly' || $employee_name[0]['payroll_type'] == 'Salaried-BiWeekly' || $employee_name[0]['payroll_type'] == 'Salaried-Monthly' || $employee_name[0]['payroll_type'] == 'Salaried-BiMonthly') { ?>
                                        <th style='height:25px;' class="col-md-2">Date</th>
                                        <th style='height:25px;' class="col-md-1">Day</th>
                                        <th style='height:25px;' class="col-md-1">Present / Absent</th>
                                    <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') { ?>
                                        <!-- Your code for 'SalesCommission' payroll type here, if any -->
                                    <?php } ?>
                                </tr>
                            </thead>

                            <?php 
                                function compareDates($a, $b) {
                                    $dateA = DateTime::createFromFormat('d/m/Y', $a['Date']);
                                    $dateB = DateTime::createFromFormat('d/m/Y', $b['Date']);
                                    if ($dateA === false || $dateB === false) {
                                        return 0; // Handle invalid dates here if needed
                                    }
                                    return $dateA <=> $dateB;
                                }
                                $timesheetdata = [];
                                $split_date = explode(' - ', $time_sheet_data[0]['month']);
                                $start_date = date('Y-m-d', strtotime($split_date[0]));
                                $end_date = date('Y-m-d', strtotime($split_date[1]));
                                $btw_days = date_diff(date_create($start_date),date_create($end_date));
                                $get_days = (int)($btw_days->format('%a') + 1);
                                $end_week = $setting_detail[0]['end_week'];

                                if($employee_name[0]['payroll_type'] == 'Hourly') { ?>

                            <tbody id="tBody">
                            <?php                                    
                                if(!empty($time_sheet_data)) {

                                // Sorting the $time_sheet_data array based on the 'Date' field
                                usort($time_sheet_data, 'compareDates');
                                $printedDates = array();

                                // Rendering the sorted table rows
                                foreach($time_sheet_data as $tsheet) {
                                    // var_dump($tsheet); die;
                                    $timesheetdata[$tsheet['Date']] = ['date' => $tsheet['Date'], 'day' => $tsheet['Day'], 'edit'=> $tsheet['uneditable'], 'start' => $tsheet['time_start'], 'end' => $tsheet['time_end'], 'per_hour' => $tsheet['hours_per_day'], 'check' => $tsheet['present'], 'break' => $tsheet['daily_break']];
                                    if(!empty($tsheet['hours_per_day']) && !in_array($tsheet['Date'], $printedDates) ) {
                                        $printedDates[] = $tsheet['Date'];
                                    }
                                }
                                // var_dump($timesheetdata);exit;
                                $time_tot = 0;
                                for($i = 0; $i < $get_days; $i++) {
                                    $date = date('m/d/Y', strtotime($start_date .' +'.$i.' day'));
                                    $stru_time = (empty($timesheetdata[$date]['per_hour'])) ? '00:00' : str_replace(['.'], ':', $timesheetdata[$date]['per_hour']);
                                    $split_time = explode(':', $stru_time);
                                    $time_tot  += ((float)$split_time[0] * 3600);
                                    $time_tot += ((float)$split_time[1] * 60);
                            ?>
                            <tr>
                                <?php if ($employee_name[0]['payroll_type'] == 'Hourly') { ?>
                                <td class="date">
                                    <input type="text" value="<?= $date; ?>" name="date[]" readonly>
                                </td>
                                <td class="day">
                                    <input type="text" value="<?= empty($timesheetdata[$date]['day']) ? '' : $timesheetdata[$date]['day']; ?>" name="day[]" readonly>
                                </td>
                                <td style="text-align:center;" class="daily-break">
                                    <select name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px;margin: auto; display: block;">
                                    <option value="<?= $timesheetdata[$date]['break']; ?>"><?= $timesheetdata[$date]['break']; ?></option>
                                        <?php foreach ($dailybreak as $dbd) { ?>
                                            <option value="<?= $dbd['dailybreak_name']; ?>"><?= $dbd['dailybreak_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td class="start-time">
                                    <input type="time" <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'readonly'; } ?> name="start[]" class="hasTimepicker start" value="<?= empty($date) ? 'readonly' : $timesheetdata[$date]['start']; ?>">
                                </td>
                                <td class="finish-time">
                                    <input type="time" <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'readonly'; } ?> name="end[]" class="hasTimepicker end" value="<?= empty($date) ? 'readonly' : $timesheetdata[$date]['end']; ?>">
                                </td>
                                <td class="hours-worked">
                                    <input readonly name="sum[]" class="timeSum" value="<?= empty($date) ? 'readonly' : $timesheetdata[$date]['per_hour']; ?>" type="text">
                                </td>
                                <td>
                                    <a style='color:white;' class="delete_day btnclr btn  m-b-5 m-r-2"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                </td>
                                   
                                <?php if($end_week == $timesheetdata[$date]['day']) {
                                    $week_tot = $time_tot/3600;
                                    echo '<tr> 
                                        <td colspan="5" class="text-right" style="font-weight:bold;">Weekly Total Hours:</td> 
                                        <td> <input type="text" value="'.$week_tot.'" readonly> </td> 
                                    </tr>';
                                    $time_tot = 0;
                                } ?>

                                <?php } elseif ($employee_name[0]['payroll_type'] == 'Salaried-weekly' || $employee_name[0]['payroll_type'] == 'Salaried-BiWeekly' || $employee_name[0]['payroll_type'] == 'Salaried-Monthly' || $employee_name[0]['payroll_type'] == 'Salaried-BiMonthly') { ?>
                                <td class="date">
                                    <input type="text" <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'readonly'; } ?> value="<?= empty($timesheetdata[$date]['date']) ? 'readonly' : $timesheetdata[$date]['date']; ?>" name="date[]">
                                </td>
                                <td class="day">
                                    <input type="text" <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'readonly'; } ?> value="<?= empty($timesheetdata[$date]['Day']) ? 'readonly' : $timesheetdata[$date]['Day']; ?>" name="day[]">
                                </td>
                                <td class="hours-worked">
                                    <input name="sum[]" class="timeSum" type="checkbox" style="width: 20px;height: 20px"
                                    <?= (isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === "no") ? 'checked' : ''; ?>
                                    <?= (!isset($timesheetdata[$date]['check']) || $timesheetdata[$date]['check'] === '') ? 'disabled' : ''; ?>>
                                </td>

                                <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') { } ?>
                            </tr>
                            <?php } } ?>
                        </tbody>
                        <?php } else { ?>

                        <tbody id="tBody">
                            <?php
                            if(!empty($time_sheet_data)) {

                                // Sorting the $time_sheet_data array based on the 'Date' field
                                usort($time_sheet_data, 'compareDates');
                                $printedDates = array();

                                // Rendering the sorted table rows
                                foreach($time_sheet_data as $tsheet) {
                                    $timesheetdata[$tsheet['Date']] = ['date' => $tsheet['Date'], 'day' => $tsheet['Day'], 'edit'=> $tsheet['uneditable'], 'start' => $tsheet['time_start'], 'end' => $tsheet['time_end'], 'per_hour' => $tsheet['hours_per_day'], 'check' => $tsheet['present'], 'break' => $tsheet['daily_break']];
                                    if(empty($tsheet['hours_per_day']) && !in_array($tsheet['Date'], $printedDates) ) {
                                        $printedDates[] = $tsheet['Date'];
                                    }
                                }

                                $time_tot = 0;
                                for($j = 0; $j < $get_days; $j++) {
                                    $date = date('m/d/Y', strtotime($start_date .' +'.$j.' day'));
                                    $stru_time = (empty($timesheetdata[$date]['per_hour'])) ? '00:00' : str_replace(['.'], ':', $timesheetdata[$date]['per_hour']);
                                    $split_time = explode(':', $stru_time);
                                    $time_tot  += ((float)$split_time[0] * 3600);
                                    $time_tot += ((float)$split_time[1] * 60);
                            ?>
                            <tr>
                                <?php if ($employee_name[0]['payroll_type'] == 'Hourly') { ?>
                                <td class="date">
                                    <input type="text" name="date[]" value="<?= $date; ?>" readonly>
                                </td>
                                <td class="day">
                                    <input type="text" value="<?= empty($timesheetdata[$date]['day']) ? '' : $timesheetdata[$date]['day']; ?>" name="day[]" readonly>
                                </td>
                                <td style="text-align:center;" class="daily-break">
                                    <select name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px;margin: auto; display: block;">
                                    <option value="<?= $timesheetdata[$date]['break']; ?>"><?= $timesheetdata[$date]['break']; ?></option>
                                        <?php foreach ($dailybreak as $dbd) { ?>
                                            <option value="<?= $dbd['dailybreak_name']; ?>"><?= $dbd['dailybreak_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td class="start-time">
                                    <input <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'readonly'; } ?> name="start[]" class="hasTimepicker start" value="<?= empty($timesheetdata[$date]['day']) ? 'readonly' : $timesheetdata[$date]['start']; ?>" type="time">
                                </td>
                                <td class="finish-time">
                                    <input <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'readonly'; } ?> name="end[]" class="hasTimepicker end" value="<?= empty($timesheetdata[$date]['day']) ? 'readonly' : $timesheetdata[$date]['end']; ?>" type="time">
                                </td>
                                <td class="hours-worked">
                                    <input readonly name="sum[]" class="timeSum" value="<?= empty($timesheetdata[$date]['day']) ? 'readonly' : $timesheetdata[$date]['per_hour']; ?>" type="text">
                                </td>
                                <td>
                                    <a style='color:white;' class="delete_day btnclr btn  m-b-5 m-r-2"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                </td>

                                <?php } elseif ($employee_name[0]['payroll_type'] == 'Salaried-weekly' || $employee_name[0]['payroll_type'] == 'Salaried-BiWeekly' || $employee_name[0]['payroll_type'] == 'Salaried-Monthly' || $employee_name[0]['payroll_type'] == 'Salaried-BiMonthly') { ?>
                                <td class="date">
                                    <input type="text" value="<?= empty($date) ? 'readonly' : $date; ?>" name="date[]" readonly>
                                </td>
                                <td class="day">
                                    <input type="text" value="<?= empty($timesheetdata[$date]['day']) ? '' : $timesheetdata[$date]['day']; ?>" name="day[]" readonly>
                                </td>
                                <td class="hours-worked">
                                    <label class="switch" style="width:100px;">
                                        <input type="checkbox" class="timeSum present checkbox switch-input" id="blockcheck_<?= $i; ?>" name="present[]" <?= (isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === 'present') ? 'checked="checked"' : ''; ?> data-present="<?= $timesheetdata[$date]['check'] ?? ''; ?>" disabled>
                                        <span contenteditable="false" class="switch-label" data-on="Present" data-off="Absent"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    <input readonly type="hidden" name="block[]" id="block_<?= $i++; ?>" value="<?= (isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === 'absent') ? 'absent' : 'present'; ?>" />
                                </td>

                                <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') { ?>
                                <!-- Your code for 'SalesCommission' payroll type here, if any -->
                                <?php } ?>

                            </tr>
                            <?php } } ?>
                        </tbody>
                        <?php } ?>

                        <tfoot>
                        <tr style="text-align:end"> 

                            <?php if ($employee_name[0]['payroll_type'] == 'Hourly') { ?>
                            <td colspan="5" class="text-right" style="font-weight:bold;">Total Hours :</td>
                            <td style="text-align: center;"> 
                                <input type="text" readonly id="total_net" value="<?= $time_sheet_data[0]['total_hours'] ; ?>" name="total_net" />   
                            </td>

                            <?php
                            if($time_sheet_data[0]['total_hours'] > $extratime_info[0]['work_hour']) { ?>
                                <input  type="hidden" readonly id="above_extra_beforehours"
                                value="<?php
                                $mins  =  (float)$time_sheet_data[0]['total_hours'] - (float)$extratime_info[0]['work_hour'];
                                $get_value  = (float)$time_sheet_data[0]['total_hours'] - $mins;
                                $get_value = sprintf('%d:00', $get_value);
                                
                                //For This Period
                                $hrate = $employee_name[0]['hrate']; 
                                list($hours, $minutes) = explode(':', $get_value);

                                // Convert to decimal hours
                                $total_hours = (int)$hours + ((int)$minutes / 60); // This should yield 25.5
                                
                                // Calculate total cost
                                $total_cost = $total_hours * $hrate; // This should yield 2550

                                // Round the total cost
                                $total_cost = round($total_cost, 2);
                                //For YTD
                                $total=$time_sheet_data[0]['total_hours'];
                                list($hours, $minutes) = explode(':', $total);
                                $total_hours_ytd = $hours + ($minutes / 60);
                                $total_cost_ytd = $total_hours_ytd * $hrate;
                                $total_cost_ytd =round($total_cost_ytd,2);
                            ?>"
                            name="above_extra_beforehours" />

                            <input type="hidden" id="above_extra_rate" name="above_extra_rate" value="<?=  $employee_name[0]['hrate']; ?>" />
                            <input type="hidden" id="above_extra_sum" name="above_extra_sum" value="<?=  $total_cost ; ?>" />
                            <input type="hidden" id="above_this_hours" name="above_this_hours" value="<?=  $get_value; ?>" />
                            <input type="hidden" id="above_extra_ytd" name="above_extra_ytd" value="<?=  $total_cost ; ?>" />
                            <?php } else {
                                $mins  =  (float)$time_sheet_data[0]['total_hours'] - (float)$extratime_info[0]['work_hour'];
                                $get_value  = (float)$time_sheet_data[0]['total_hours'] - $mins;
                                $get_value = sprintf('%d:00', $get_value);
                                //For This Period
                                $hrate = $employee_name[0]['hrate']; 
                                list($hours, $minutes) = explode(':', $get_value);

                                // Convert to decimal hours
                                $total_hours = (int)$hours + ((int)$minutes / 60); // This should yield 25.5
                                
                                // Calculate total cost
                                $total_cost = $total_hours * $hrate; // This should yield 2550

                                // Round the total cost
                                $total_cost = round($total_cost, 2);
                                //For YTD
                                $total=$time_sheet_data[0]['total_hours'];
                                list($hours, $minutes) = explode(':', $total);
                                $total_hours_ytd = (float)$hours + ($minutes / 60);
                                $total_cost_ytd = $total_hours_ytd * $hrate;
                                $total_cost_ytd =round($total_cost_ytd,2);
                            ?> 
                            <input type="hidden" readonly id="above_extra_beforehours" value="<?php echo $time_sheet_data[0]['total_hours'];  ?>" name="above_extra_beforehours" />
                            <input type="hidden" id="above_extra_rate" name="above_extra_rate" value="<?=  $employee_name[0]['hrate']; ?>" />
                            <input type="hidden" id="above_extra_sum" name="above_extra_sum" value="<?=  $total_cost_ytd ; ?>" />
                            <input type="hidden" id="above_this_hours" name="above_this_hours" value="<?= $time_sheet_data[0]['total_hours']; ?>" />
                            <input type="hidden" id="above_extra_ytd" name="above_extra_ytd" value="<?=  $total_cost_ytd; ?>" />
                            
                            <?php } ?>
                            <?php } elseif ($employee_name[0]['payroll_type'] == 'Salaried-weekly' || $employee_name[0]['payroll_type'] == 'Salaried-BiWeekly' || $employee_name[0]['payroll_type'] == 'Salaried-Monthly' || $employee_name[0]['payroll_type'] == 'Salaried-BiMonthly') { ?>
                            <td colspan="2" class="text-right" style="font-weight:bold;">No of Days:</td>
                            <td style="text-align: center;"> 
                                <input  type="text" readonly id="total_net" value="<?= $time_sheet_data[0]['total_hours'] ; ?>" name="total_net" />
                            </td>
                            <?php  if($time_sheet_data[0]['total_hours'] > $extratime_info[0]['work_hour']) { ?>
                            <input  type="hidden"   readonly id="above_extra_beforehours" value="<?php $mins = $time_sheet_data[0]['total_hours'] - $extratime_info[0]['work_hour']; $get_value  =  $time_sheet_data[0]['total_hours'] - $mins; echo $get_value ; ?>" name="above_extra_beforehours" />
                            <input type="hidden" id="above_extra_rate" name="above_extra_rate" value="<?=  $employee_name[0]['hrate']; ?>" />
                            <input type="hidden" id="above_extra_sum" name="above_extra_sum" value="<?=  $get_value * $employee_name[0]['hrate'] ; ?>" />
                            <input type="hidden" id="above_this_hours" name="above_this_hours" value="<?=  $get_value; ?>" />
                            <input type="hidden" id="above_extra_ytd" name="above_extra_ytd" value="<?=  $get_value * $employee_name[0]['hrate'] ; ?>" />
                    
                        <?php } else { ?>
                        <input type="hidden" readonly id="above_extra_beforehours" value="<?php   echo $time_sheet_data[0]['total_hours'] *8; ?>" name="above_extra_beforehours" />
                        <input type="hidden" id="above_extra_rate" name="above_extra_rate" value="<?=  $employee_name[0]['hrate']; ?>" />
                        <input type="hidden" id="above_extra_sum" name="above_extra_sum" value="<?=  ($time_sheet_data[0]['total_hours']*8) * $employee_name[0]['hrate'] ; ?>" />
                        <input type="hidden" id="above_this_hours" name="above_this_hours" value="<?= $time_sheet_data[0]['total_hours'] *8; ?>" />
                        <input type="hidden" id="above_extra_ytd" name="above_extra_ytd" value="<?=  ($time_sheet_data[0]['total_hours']*8) * $employee_name[0]['hrate']; ?>" />
                        <?php } ?>
                            
                        <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') { ?>
                        <?php } ?>
                        </tr>
                        <br>
                    
                        <?php 
                        if($time_sheet_data[0]['total_hours'] > $extratime_info[0]['work_hour']) {
                                                        
                        $total_hours = $time_sheet_data[0]['total_hours']; // Total hours in hh:mm format
                        $work_hour = $extratime_info[0]['work_hour'].':00'; // Work hours to subtract in hh:mm format
                
                        $hourly_rate = $employee_name[0]['hrate'] * $extratime_info[0]['extra_workamount'];     // Cost per hour

                        // Split total hours
                        list($totalH, $totalM) = explode(':', $total_hours);
                        $totalMinutes = ($totalH * 60) + (int)$totalM; // Convert to total minutes


                        // Split work hours
                        list($workH, $workM) = explode(':', $work_hour);
                        $workMinutes = ($workH * 60) + (int)$workM; // Convert to total minutes

                        // Calculate remaining minutes
                        $remainingMinutes = $totalMinutes - $workMinutes;

                        if ($remainingMinutes < 0) {
                            $remainingMinutes = 0; // Ensure it doesn't go negative
                        }

                        // Convert remaining minutes back to hh:mm format
                        $remainingHours = floor($remainingMinutes / 60);
                        $remainingMinutes = $remainingMinutes % 60;
                        $get_value = sprintf('%02d:%02d', $remainingHours, $remainingMinutes); // Remaining time in hh:mm format

                        // Convert remaining time to decimal hours
                        list($hours, $minutes) = explode(':', $get_value);
                        $total_hours_decimal = (int)$hours + ((int)$minutes / 60); // Convert to decimal

                        // Calculate total cost
                        $total_cost = $total_hours_decimal * $hourly_rate;

                        // Optional: Round the total cost
                        $total_cost = round($total_cost, 2);
                        ?>

                        <input type="hidden" id="extra_hour" name="extra_hour" value="<?= ($time_sheet_data[0]['total_hours'] > $extratime_info[0]['work_hour']) ? ($get_value) : '0'; ?>" />

                        <input type="hidden" id="extra_rate" name="extra_rate" value="<?=  $employee_name[0]['hrate'] * $extratime_info[0]['extra_workamount']; ?>" />

                        <input type="hidden" id="extra_thisrate" name="extra_thisrate" value="<?= $total_cost; ?>" />
                        <input type="hidden" id="extra_this_hour" name="extra_this_hour" value="<?php   echo  ($get_value); ?>" />
                        <input type="hidden" id="extra_ytd" name="extra_ytd" value="<?=  $total_cost; ?>"   />
                        <?php } else { 
                            list($hours, $minutes) = explode(':', $time_sheet_data[0]['total_hours'].':00');
                            $total_hours_ytd = (int)$hours + ((int)$minutes / 60); // Ensure minutes are treated as integers
                            $total_c = $total_hours_ytd * $employee_name[0]['hrate'];
                            $total_c = round($total_c, 2); ?>
                            <input type="hidden" id="extra_hour" name="extra_hour" value="<?= $time_sheet_data[0]['total_hours']; ?>" />
                            <input type="hidden" id="extra_rate" name="extra_rate" value="<?=  $employee_name[0]['hrate']; ?>" />
                            <input type="hidden" id="extra_thisrate" name="extra_thisrate" value="<?= ($total_c); ?>" />
                            <input type="hidden" id="extra_rate" name="extra_rate" value="<?=  $employee_name[0]['hrate']; ?>" />
                            <input type="hidden" id="extra_thisrate" name="extra_thisrate" value="<?= ($total_c); ?>" />
                        <?php } ?>
                    </tfoot>
                    
                </table>
            </div>

            <div class="form-group row">
                <div class="col-sm-4"></div>
                    <div class="col-sm-4" style="border: 5px solid gainsboro;border-radius: 20px;">
                        <div class="">
                            <div class="panel-title">
                            <br/>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <label for="administrator_person">Administrator Name<i class="text-danger">*</i></label> 
                                    </div>

                                    <div class="col-sm-4">
                                        <select name="administrator_person" id="administrator_person" class="form-control" required data-placeholder="<?= display('select_one'); ?>">                                   
                                                <option value="">Select Administrator Name</option>
                                            <?php foreach($administrator as $adv) { ?>
                                                <option value="<?= $adv['adm_id'] ; ?>" <?= ($time_sheet_data[0]['admin_name'] == $adv['adm_id']) ? 'selected' : ''; ?> ><?= $adv['adm_name'] ; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <a class="client-add-btn btn btnclr text-white" aria-hidden="true"  data-toggle="modal" data-target="#add_admst" ><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                        <div class="panel-title">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <label for="selector">Payment Method <i class="text-danger">*</i> </label>
                                </div>
                                
                                <div class="col-sm-6">
                                    <select id="selector" name="payment_method" onchange="yesnoCheck(this);"  class="form-control" required >
                                        <option value="">Select Payment Method</option>
                                        <option value="Cheque" <?= ($time_sheet_data[0]['payment_method'] == "Cheque") ? 'Selected' : ''; ?>>Cheque/Check </option>
                                        <option value="Bank" <?= ($time_sheet_data[0]['payment_method'] == "Bank") ? 'Selected' : ''; ?>>Bank</option>
                                        <option value="Cash" <?= ($time_sheet_data[0]['payment_method'] == "Cash") ? 'Selected' : ''; ?>>Cash</option>
                                    </select>
                                    <!-- <label for="selector">Select ID Proof</label> -->
                                </div>
                            </div>
                        </div>
                    
                        <div id="adc" ><br/>
                            <div class="col-sm-12" style="padding-top:20px;">
                                <div class="col-sm-6">
                                    <label for="aadhar">Cheque No<i class="text-danger">*</i></label> 
                                </div>
                                
                                <div class="col-sm-6"> 
                                    <input type="number" id="cheque_no" name="cheque_no"  value="<?php  echo $time_sheet_data[0]['cheque_no']; ?>"  class="form-control" requried /><br />
                                </div>
                        
                                <div class="col-sm-6">
                                    <label for="aadhar">Cheque Date<i class="text-danger">*</i></label> 
                                </div>
                                
                                <div class="col-sm-6"> 
                                    <input type="text" id="datepicker_cheque" name="cheque_date" value="<?php echo $time_sheet_data[0]['cheque_date']; ?>"  class="form-control"  requried/><br />
                                </div>
                            </div>
                        </div>

                        <div id="pc" >
                            <div class="col-sm-12" style="padding-top:20px;">
                                <div class="col-sm-6">
                                    <label for="pan">Bank Name<i class="text-danger">*</i></label> 
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" id="bank_name" name="bank_name" value="<?= $time_sheet_data[0]['bank_name']; ?>"  class="form-control" requried /><br />
                                </div>

                                <div class="col-sm-6">
                                    <label for="pan">Payment Reference No<i class="text-danger">*</i></label> 
                                </div>
                
                                <div class="col-sm-6">
                                    <input type="text" id="payment_refno" name="payment_refno" value="<?= $time_sheet_data[0]['payment_ref_no']; ?>"  class="form-control"  requried/><br />
                                </div>
                            </div>
                        </div>
                        
                        <div id="ps" style="display:none;">
                            <div class="col-sm-12" style="padding-top:20px;">
                                <div class="col-sm-6">
                                    <label for="pass">Cash<i class="text-danger">*</i></label> 
                                </div>
                                
                                <div class="col-sm-4">
                                    <input type="text" id="cash" name="cash"  class="form-control"  value="Cash" readonly /><br />
                                </div>
                            </div>
                        </div>

                        <!--Cash Method -->
                        <div id="Cashmethod">
                            <br/>
                            <div class="col-sm-12" style="padding-top:20px;">
                                <div class="col-sm-6">
                                    <label for="aadhar">Date<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" id="datepicker" name="cash_date" value="<?= $time_sheet_data[0]['cheque_date']; ?>"  class="form-control" requried autocomplete="off" /><br />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="col-sm-12 m-3" align="center">
                    <input type="submit" value="Generate pay slip" class="btnclr btn text-white"/> 
                </div> 
            </div>               
                <!-- <?php //echo form_close() ?> -->
                <?= form_close() ?><!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<script>

function yesnoCheck(that) {
  if (that.value == "Cheque") {
        document.getElementById("adc").style.display = "block";
        document.getElementById("pc").style.display = "none";
        document.getElementById("Cashmethod").style.display = "none";
        // document.getElementById("ps").style.display = "none";
    } else if (that.value == "Bank") {
        document.getElementById("adc").style.display = "none";
        document.getElementById("pc").style.display = "block";
        document.getElementById("Cashmethod").style.display = "none";
        //   document.getElementById("ps").style.display = "none";
    } else if (that.value == "Cash") {
        document.getElementById("adc").style.display = "none";
        document.getElementById("pc").style.display = "none";
        document.getElementById("Cashmethod").style.display = "block";
        //  document.getElementById("ps").style.display = "block";
    } else {
        document.getElementById("adc").style.display = "none";
        document.getElementById("pc").style.display = "none";
        document.getElementById("Cashmethod").style.display = "none";
        // document.getElementById("ps").style.display = "none";
    }
}

$(document).ready(function(){
    var that=$('#selector').val();
    if (that == "Cheque") {
        $('#adc').show();
        $('#pc').hide();
        $('#Cashmethod').hide();
        //  $('#ps').hide();
    } else if (that == "Bank") {
        $('#adc').hide();
        $('#pc').show();
        $('#Cashmethod').hide();
        // $('#ps').hide();
    } else if (that == "Cash") {
        $('#adc').hide();
        $('#pc').hide();
        $('#Cashmethod').show();
        //  $('#ps').show();
    } else {
        $('#adc').hide();
        $('#pc').hide();
        $('#Cashmethod').hide();
        // $('#ps').hide();
    }
 });

</script>

<script>
var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';

$('#insert_adm').submit(function (event) {
    event.preventDefault();

    var dataString = {
        dataString : $("#insert_adm").serialize()
    };
    dataString[csrfName] = csrfHash;
    $.ajax({
        type:"POST",
        dataType:"json",
        url:"<?= base_url(); ?>Chrm/insert_data_adsr",
        data:$("#insert_adm").serialize(),
        success:function (data1) {
            var $select = $('select#administrator_person');
            $select.empty();
            $('#add_admst').modal('hide');
            for(var i = 0; i < data1.length; i++) {
                var option = $('<option/>').attr('value', data1[i].adm_name).text(data1[i].adm_name);
                $select.append(option); // append new options
            }
        }
    });
});

var data = {
    value:$('#customer_name').val()
};
var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';



$('body').on('input select change','#reportrange',function(){
    var date = $(this).val();
    const myArray = date.split("-");
    var start = myArray[0];
    var end = myArray[1];
    getTimesheet(start, end);     
});


function getTimesheet(start, end) {

    const weekDays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    let chosenDate = start; //get chosen date from datepicker
    var s_split = start.split("/");
    var e_split = end.split("/");
    var Date1 = new Date (s_split[2]+'/'+s_split[0]+'/'+s_split[1]);
    var Date2 = new Date (e_split[2]+'/'+e_split[0]+'/'+e_split[1]);
    var Days = Math.round((Date2.getTime() - Date1.getTime())/(1000*60*60*24));

    const validDate = new Date(chosenDate);
    let newDate;
    const monStartWeekDays = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

    var end_week = "<?php echo (!empty($setting_detail[0]['end_week'])) ? $setting_detail[0]['end_week'] : 'Sunday'; ?>";
    var total_pres = 0;
    var data_id = 0;
    var tbody = '';

    for(let i = 0; i <= Days; i++) { 
        newDate = new Date(validDate.getTime()); //create date object
        newDate.setDate(validDate.getDate() + i); //increment set date
        //append results to table
        var date=$('#date_'+i).html();
        let dayString = weekDays[newDate.getDay()].slice(0, 10);
        let days = ("0" + newDate.getDate()).slice(-2); 
        let month = ("0" + (newDate.getMonth() + 1)).slice(-2); 
        let dateString = `${month}/${days}/${newDate.getFullYear()}`;

        var day=$('#day_'+i).html();
        //   day=day.replace("/","");
        tbody += $('#tBody').append( `
        <tr> 
            <td  class="date" id="date_`+i+`"><input type="hidden" value="${newDate.getDate()}/${newDate.getMonth() + 1}/${newDate.getFullYear()}" name="date[]"   />${dateString}</td>
            <td  class="day" id="day_`+i+`"><input type="hidden" value="`+`${weekDays[newDate.getDay()].slice(0,10)}" name="day[]"   />`+`${weekDays[newDate.getDay()].slice(0,10)}</td>
            <td style="text-align:center;" class="daily-break_${i}">
                <select name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px;margin: auto; display: block;">
                    <?php foreach ($dailybreak as $dbd) { ?>
                        <option value="<?= $dbd['dailybreak_name']; ?>"><?= $dbd['dailybreak_name']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td class="start-time_`+i+`"> 
                <input id="startTime${monStartWeekDays[i]}" name="start[]"  class="hasTimepicker start" type="time" />
            </td>
            <td class="finish-time_`+i+`"> 
                <input id="finishTime${monStartWeekDays[i]}" name="end[]" class="hasTimepicker end" type="time" />
            </td>
            <td class="hours-worked_`+i+`"> 
                <input id="hoursWorked${dayString}" ="sum[]" class="timeSum" readonly type="text" />
            </td> 
            <td>
                <a style="color:white;" class="delete_day btnclr btn  m-b-5 m-r-2"><i class="fa fa-trash" aria-hidden="true"></i> </a>
            </td>
         </tr>`);

         if(end_week == dayString) {
            tbody += $('#tBody').append(`<tr> 
                <td colspan="5" class="text-right" style="font-weight:bold;"> Weekly Total Hours:</td> 
                <td class="hour_week_total">
                    <input type="text" name="hour_weekly_total" id="hourly_`+data_id+`" value="" readonly />
                </td>
            </tr>`);
            data_id++;
        }
    }
    return tbody;
}


function converToMinutes(s) {
    var c = s.split('.');
    return parseInt(c[0]) * 60 + parseInt(c[1]);
}

function parseTime(s) {
    return Math.floor(parseInt(s) / 60) + "." + parseInt(s) % 60
}

$('body').on('keyup','.end',function(){

    var start = $(this).closest('tr').find('.strt').val();
    var end = $(this).closest('td').find('.end').val();
    var breakv = $('#dailybreak').val();

    var calculate = parseInt(start)+parseInt(end);
    var final = calculate-parseInt(breakv);
    console.log(final);
    // $(this).closest('tr').find('.hours-worked').html(final);

});


$(document).on('select change', '#templ_name', function () {
    var data = {
        value:$('#templ_name').val()
    };
    data[csrfName] = csrfHash;
    $.ajax({
        type:'POST',
        data: data, 
        dataType:"json",
        url:'<?= base_url();?>Chrm/getemployee_data',
        success: function(result, statut) {
            $('#job_title').val(result[0]['designation']);
        }
    });
});


$(document).ready(function() {
    function updateCounter() {
        var sumOfDays = $('input[type="checkbox"].present:checked').length;
        $('#total_net').val(sumOfDays); // Assuming you have an input with ID 'total_net'
    }
    $(document).on('change', 'input[type="checkbox"].present', updateCounter);
      var t=$('#payroll_type').val();
    if(t !=='Hourly'){
        updateCounter(); // Initial count update
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var checkboxes = document.querySelectorAll('.checkbox.switch-input');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var idSuffix = this.id.split('_')[1];
            var correspondingInputField = document.getElementById('block_' + idSuffix);
            correspondingInputField.value = this.checked ? "present" : "absent";
        });
    });
});

$(document).on('select change', '.end','.dailybreak', function () {
 var $begin = $(this).closest('tr').find('.start').val();
    var $end = $(this).closest('tr').find('.end').val();
    let valuestart = moment($begin, "HH:mm");
    let valuestop = moment($end, "HH:mm");
    let timeDiff = moment.duration(valuestop.diff(valuestart));
    var dailyBreakValue = parseInt($(this).closest('tr').find('.dailybreak').val()) || 0;
    var totalMinutes = timeDiff.asMinutes() - dailyBreakValue;
    var hours = Math.floor(totalMinutes / 60);
    var minutes = totalMinutes % 60;
    var formattedTime = hours.toString().padStart(2, '0') + '.' + minutes.toString().padStart(2, '0');
    if (isNaN(parseFloat(formattedTime))) {
        $(this).closest('tr').find('.timeSum').val('00.00');
    }else{
        $(this).closest('tr').find('.timeSum').val(formattedTime);
    }
    // $(this).closest('tr').find('.timeSum').val(formattedTime);
    //var total_net = 0;
    var total_netH = 0;
    var total_netM = 0;
    $('.table').each(function () {
        var tableTotal = 0;
        var tableHours = 0;
        var tableMinutes = 0;
        $(this).find('.timeSum').each(function () {
            var precio = $(this).val();
            if (!isNaN(precio) && precio.length !== 0) {
                var [hours, minutes] = precio.split('.').map(parseFloat);
                //tableTotal += hours + minutes / 100; // Dividing minutes by 100 to get the correct decimal value
                tableHours += hours;
                tableMinutes += minutes;
            }
        });
        total_netH += tableHours;
        total_netM += tableMinutes;
    });
    var timeConvertion = convertToTime(total_netH ,total_netM);
    $('#total_net').val(timeConvertion).trigger('change');
});


$(document).on('select change'  ,'.start','.dailybreak', function () {
 var $begin = $(this).closest('tr').find('.start').val();
    var $end = $(this).closest('tr').find('.end').val();
    let valuestart = moment($begin, "HH:mm");
    let valuestop = moment($end, "HH:mm");
    let timeDiff = moment.duration(valuestop.diff(valuestart));
    var dailyBreakValue = parseInt($(this).closest('tr').find('.dailybreak').val()) || 0;
    var totalMinutes = timeDiff.asMinutes() - dailyBreakValue;
    var hours = Math.floor(totalMinutes / 60);
    var minutes = totalMinutes % 60;
    var formattedTime = hours.toString().padStart(2, '0') + '.' + minutes.toString().padStart(2, '0');
    if (isNaN(parseFloat(formattedTime))) {
        $(this).closest('tr').find('.timeSum').val('00.00');
    }else{
        $(this).closest('tr').find('.timeSum').val(formattedTime);
    }

    //var total_net = 0;
    var total_netH =0;
    var total_netM =0;
    $('.table').each(function () {
        var tableTotal = 0;
        var tableHours = 0;
        var tableMinutes = 0;
        $(this).find('.timeSum').each(function () {
            var precio = $(this).val();
            if (!isNaN(precio) && precio.length !== 0) {
                var [hours, minutes] = precio.split('.').map(parseFloat);
                //tableTotal += hours + minutes / 100; // Dividing minutes by 100 to get the correct decimal value
                tableHours += hours;
                tableMinutes += minutes;
            }
        });
        //total_net += tableTotal;
        total_netH += tableHours;
        total_netM += tableMinutes;
    });
   
    var timeConvertion = convertToTime(total_netH,total_netM);
    $('#total_net').val(timeConvertion).trigger('change');
});


$(document).on('input','.timeSum', function () {
    // $(".timeSum").change(function(){
    var $addtotal = $(this).closest('tr').find('.timeSum').val();
    // alert($addtotal);
});

function sumHours () {
    var time1 = $begin.timepicker().getTime();
    var time2 = $end.timepicker().getTime();
    if ( time1 && time2 ) {
      if ( time1 > time2 ) {
        v = new Date(time2);
        v.setDate(v.getDate() + 1);
      } else {
        v = time2;
      }
      var diff = ( Math.abs( v - time1) / 36e5 ).toFixed(2);
      $input.val(diff); 
    } else {
      $input.val(''); 
    }
}

$('#total_net').on('keyup',function(){
    var value=$(this).val();
   if($(this).val() == ''){
$(".hasTimepicker").prop("readonly", false);
    $('#tBody .hasTimepicker').prop('defaultValue');  
    }else{
   $(".hasTimepicker").prop("readonly", true); 
    }
});

$(document).on('click', '.delete_day', function() {
    $(this).closest('tr').remove();

    // Recalculate the total net after deleting a row
    var total_netH = 0;
    var total_netM = 0;

    $('.table').each(function() {
        $(this).find('.timeSum').each(function() {
            var precio = $(this).val();
            if (!isNaN(precio) && precio.length !== 0) {
                var [hours, minutes] = precio.split('.').map(parseFloat);
                total_netH += hours;
                total_netM += minutes;
            }
        });
    });

    // Convert total hours and minutes to the correct format
    var timeConversion = convertToTime(total_netH, total_netM);
    $('#total_net').val(timeConversion).trigger('change');

    // Update the date range if necessary
    var firstDate = $('.date input').first().val(); 
    var lastDate = $('.date input').last().val(); 
    function convertDateFormat(dateStr) {
        const [day, month, year] = dateStr.split('/');
        return `${month}/${day}/${year}`;
    }
    var firstDateMDY = convertDateFormat(firstDate);
    var lastDateMDY = convertDateFormat(lastDate);
    $('#reportrange').val(firstDateMDY + ' - ' + lastDateMDY);
});

function convertToTime(hr,min) {
    let hours = Math.floor(min / 60);
    let minutes = min % 60;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    return `${hours+hr}:${minutes}`;
}

$(function() {
    $("#datepicker").datepicker({
        dateFormat: 'mm-dd-yy',
        maxDate: 0
    });
    $("#datepicker_cheque").datepicker({
        dateFormat: 'mm-dd-yy',
        maxDate: 0
    });
});
</script>
