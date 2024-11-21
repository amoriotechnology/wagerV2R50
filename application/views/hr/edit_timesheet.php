<div class="content-wrapper">

    <section class="content-header" style="height:70px;">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>

        <div class="header-title">
            <h1>Edit TimeSheet</h1>
            <small></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
                <li><a href="#">HRM</a></li>
                <li class="active" style="color:orange">Edit Timesheet</li>
            </ol>
        </div>
    </section>

    <section class="content">
     
        <div class="row">
            <div class="col-sm-12">                
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading" style="height:50px;">
                        <div class="panel-title">
                            <a style="float:right;color:white;" href="<?php echo base_url('Chrm/manage_timesheet?id=' . $_GET['id']); ?>" class="btnclr btn  m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo "Manage TimeSheet" ?> </a>
                        </div>
                    </div>
                  
                    <?php echo form_open_multipart('Chrm/pay_slip?id=' . $_GET['id'], 'id="validate"'); ?>
                  
                    <div class="panel-body">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="customer" class="col-sm-4 col-form-label">Employee Name<i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input  type="hidden" readonly id="tsheet_id" value="<?= $time_sheet_data[0]['timesheet_id'];?>" name="tsheet_id" />
                                    <input  type="hidden" readonly id="unique_id" value="<?= $time_sheet_data[0]['unique_id'];?>" name="unique_id" />          
                                    <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                                    <select name="templ_name" <?php if($time_sheet_data[0]['uneditable']==1){ echo 'disabled';}  ?> id="templ_name" class="form-control"    tabindex="3" style="width100">
                                        <option value="<?= $employee_name[0]['id'] ;?>"> <?= $employee_name[0]['first_name']." ".$employee_name[0]['last_name'] ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="qdate" class="col-sm-4 col-form-label">Job title</label>
                                <div class="col-sm-6">
                                <input type="text" name="job_title" id="job_title" readonly placeholder="Job title" value="<?php  echo $employee_name[0]['designation']; ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="dailybreak" class="col-sm-4 col-form-label">Date Range<i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input id="reportrange" type="text" readonly name="date_range" <?php if($time_sheet_data[0]['uneditable']==1){ echo 'readonly';}  ?> value="<?= $time_sheet_data[0]['month']; ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="dailybreak" class="col-sm-4 col-form-label">Payroll Type <i class="text-danger"></i></label>
                                <div class="col-sm-6">
                                    <input id="payroll_type" name="payroll_type" type="text" value="<?= $time_sheet_data[0]['payroll_type'] ; ?>" readonly class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive work_table col-md-12">
		                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="PurList"> 
                                <thead>
                                    <tr> 
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
                                            <th style='height:25px; ' class="col-md-5">Present / Absence</th>
                                        <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') { ?>
                                        
                                        <?php } ?>
                                    </tr>
								</thead>

                                <?php 
                                
                                function compareDates($a, $b) {
                                    $dateA = DateTime::createFromFormat('d/m/Y', $a['Date']);
                                    $dateB = DateTime::createFromFormat('d/m/Y', $b['Date']);
                                    if ($dateA === false || $dateB === false) {
                                        return 0; 
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
                                   
                                    usort($time_sheet_data, 'compareDates');

                                   
                                    $printedDates = array();

                                 
                                    foreach($time_sheet_data as $tsheet) {
                                        $timesheetdata[$tsheet['Date']] = ['date' => $tsheet['Date'], 'day' => $tsheet['Day'], 'edit'=> $tsheet['uneditable'], 'start' => $tsheet['time_start'], 'end' => $tsheet['time_end'], 'per_hour' => $tsheet['hours_per_day'], 'check' => $tsheet['present'], 'break' => $tsheet['daily_break']];
                                        if( !empty($tsheet['hours_per_day']) && !in_array($tsheet['Date'], $printedDates)) {
                                         
                                            $printedDates[] = $tsheet['Date'];
                                        }
                                    }

                                    $time_tot = 0;
                                    for($i = 0; $i < $get_days; $i++) {
                                        $date = date('m/d/Y', strtotime($start_date .' +'.$i.' day'));
                                        $stru_time = (empty($timesheetdata[$date]['per_hour'])) ? '00:00' : str_replace(['.'], ':', $timesheetdata[$date]['per_hour']);
                                        $split_time = explode(':', $stru_time);
                                        $time_tot  += ((float)$split_time[0] * 3600);
                                        $time_tot += ((float)$split_time[1] * 60);
                                ?>
                                
                                <tr>
                                    <td class="date"> <input type="text" readonly value="<?= $date; ?>" name="date[]"> </td>
                                    
                                    <td class="day">
                                        <input type="text" readonly value="<?= $timesheetdata[$date]['day']; ?>" name="day[]">
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
                                        <a style="color:white;" class="delete_day btnclr btn  m-b-5 m-r-2 <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'disabled'; } ?> "><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>                                
                                <?php } ?>
                            </tbody>

                        <?php } elseif ($employee_name[0]['payroll_type'] == 'Salaried-weekly' || $employee_name[0]['payroll_type'] == 'Salaried-BiWeekly' || $employee_name[0]['payroll_type'] == 'Salaried-Monthly' || $employee_name[0]['payroll_type'] == 'Salaried-BiMonthly') { ?>

                            <tbody id="tBody">
                            <?php
                                // Initialize $i before the loop starts
                                $i = 0;
                                
                                // Sorting the $time_sheet_data array based on the 'Date' field
                                usort($time_sheet_data, 'compareDates');
                                // Variable to track printed dates
                                $printedDates = array();
                                // Rendering the sorted table rows
                                foreach($time_sheet_data as $tsheet) {
                                    $timesheetdata[$tsheet['Date']] = ['date' => $tsheet['Date'], 'day' => $tsheet['Day'], 'edit'=> $tsheet['uneditable'], 'start' => $tsheet['time_start'], 'end' => $tsheet['time_end'], 'per_hour' => $tsheet['hours_per_day'], 'check' => $tsheet['present'], 'break' => $tsheet['daily_break']];
                                    if( empty($tsheet['hours_per_day']) && !in_array($tsheet['Date'], $printedDates)) {
                                        // Add the date to the printed dates array
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
                                <td class="date">
                                    <input type="text" name="date[]" value="<?= $date; ?>" readonly />
                                </td>
                                <td class="day">
                                    <input type="text" name="day[]" readonly value="<?= $timesheetdata[$date]['day']; ?>">
                                </td>
                                <?php if($employee_name[0]['payroll_type'] == 'Salaried-weekly' || $employee_name[0]['payroll_type'] == 'Salaried-BiWeekly' || $employee_name[0]['payroll_type'] == 'Salaried-Monthly' || $employee_name[0]['payroll_type'] == 'Salaried-BiMonthly') { ?>
                                <td class="hours-worked">
                                    <label class="switch" style="width:100px;">
                                        <input type="checkbox" class="timeSum present checkbox switch-input" id="blockcheck_<?= $i; ?>" name="present[]"
                                            <?= (isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === 'present') ? 'checked="checked"' : ''; ?>
                                            data-present="<?= $timesheetdata[$date]['check'] ?? ''; ?>">
                                        <span class="switch-label" data-on="Present" data-off="Absent"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    <input type="hidden" name="block[]" id="block_<?= $i; ?>" value="<?= (isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === 'absent') ? 'absent' : 'present'; ?>" />
                                </td>
                                <?php } ?>
                            </tr>
                            <?php
                            // Increment $i after each iteration
                            $i++;
                        } ?>
                </tbody>
                <?php } ?>

                <tfoot>
            <!-- <tr style="text-align:end"> 
                    <td colspan="5" class="text-right" style="font-weight:bold;">Total Hours :</td>  
                    <td style="text-align: center;"> <input  type="text"    style="text-align:center;"  id="total_net" value="<?= $time_sheet_data[0]['total_hours'] ; ?>" name="total_net" />    </td> 
                </tr>  -->
                <tr style="text-align:end"> 
                    <?php if ($employee_name[0]['payroll_type'] == 'Hourly') { ?>
                    <td colspan="5" class="text-right" style="font-weight:bold;">Total Hours :</td> 
                    <td style="text-align: center;"> <input  type="text" readonly id="total_net" value="<?= $time_sheet_data[0]['total_hours'] ; ?>" name="total_net" />    </td> 

                    <?php } elseif ($employee_name[0]['payroll_type'] == 'Salaried-weekly' || $employee_name[0]['payroll_type'] == 'Salaried-BiWeekly' || $employee_name[0]['payroll_type'] == 'Salaried-Monthly' || $employee_name[0]['payroll_type'] == 'Salaried-BiMonthly') { ?>
                    <td colspan="2" class="text-right" style="font-weight:bold;">No of Days:</td> 
                    <td style="text-align: center;"> <input  type="text" readonly id="total_net" value="<?= $time_sheet_data[0]['total_hours'] ; ?>" name="total_net" />    </td> 

                    <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') { ?>
                    <?php } ?>
                </tr> 

            </tfoot>
        </table>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-4"><br/>
            <?php if($_data[0]['uneditable']==1){ 
                echo '<b>Note : </b>'.'This Timesheet is locked'; 
            }  ?>
            <input type="submit" style="<?php if($time_sheet_data[0]['uneditable']==1){ echo 'display:none;';}  ?>color:white;" value="Submit" class="btnclr btn btn-info"/> 
        </div>               
        <!-- <?php //echo form_close() ?> -->
    <?= form_close() ?>

        <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</section>


</div>

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
                var $select = $('select#insert_adm');
                    $select.empty();

                for(var i = 0; i < data1.length; i++) {
                    var option = $('<option/>').attr('value', data1[i].adms_name).text(data1[i].adms_name);
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

    // $(function() {

    // // //

    // $('#reportrange').daterangepicker({
    //     startDate: start,
    //     endDate: end,
    //     ranges: {
    //        'Today': [moment(), moment()],
    //        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //        'This Month': [moment().startOf('month'), moment().endOf('month')],
    //        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     }
    // }, //cb
    // );

    // //cb(start, end);

    // });

$('body').on('input select change','#reportrange',function(){
    var date = $(this).val();
    $('#tBody').empty();
    const myArray = date.split("-");
    var start = myArray[0];
    var s_split=start.split("/");
    var end = myArray[1];
    var e_split=end.split("/");
    const weekDays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    let chosenDate = start; //get chosen date from datepicker
    var Date1 = new Date (s_split[2], s_split[0], s_split[1]);
    var Date2 = new Date (e_split[2], e_split[0], e_split[1]);
    var Days = Math.round((Date2.getTime() - Date1.getTime())/(1000*60*60*24));
    console.log(s_split[2]+"/"+ s_split[1]+"/"+ s_split[0]+"/"+Days);
    const validDate = new Date(chosenDate);
    let newDate;
    const monStartWeekDays = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    
    for(let i = 0; i <= Days; i++) { //iterate through each weekday
        newDate = new Date(validDate); //create date object
        newDate.setDate(validDate.getDate() + i); //increment set date
        //append results to table
        var date=$('#date_'+i).html();
        // date=date.replace(/ /g,"");
        // var end=document.getElementById(`finishTime${monStartWeekDays[i]}`).value;
        //      var sum=document.getElementById(`hoursWorked${monStartWeekDays[i]}`).value;
        var day=$('#day_'+i).html();
        //   day=day.replace("/","");
        $('#tBody').append(
            `<tr>
                <td  class="date" id="date_`+i+`"><input type="hidden" value="`+`${newDate.getDate()}/${newDate.getMonth() + 1}/${newDate.getFullYear()}" name="date[]"   />`+`${newDate.getDate()} / ${newDate.getMonth() + 1} / ${newDate.getFullYear()}</td>
                <td  class="day" id="day_`+i+`"><input type="hidden" value="`+`${weekDays[newDate.getDay()].slice(0,10)}" name="day[]"   />`+`${weekDays[newDate.getDay()].slice(0,10)}</td>
            <?php if ($time_sheet_data[0]['payroll_type'] == 'Hourly') { ?>
                <td style="text-align:center;" class="daily-break_<?= $i; ?>">
                    <select name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px; margin: auto; display: block;">
                        <?php foreach ($dailybreak as $dbd) { ?>
                            <option value="<?= $dbd['dailybreak_name']; ?>"><?= $dbd['dailybreak_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td class="start-time_<?= $i; ?>"><input id="startTime<?= $monStartWeekDays[$i]; ?>" name="start[]" class="hasTimepicker start" type="time" /></td>
                <td class="finish-time_<?= $i; ?>"><input id="finishTime<?= $monStartWeekDays[$i]; ?>" name="end[]" class="hasTimepicker end" type="time" /></td>
                <td class="hours-worked_<?= $i; ?>"><input id="hoursWorked<?= $monStartWeekDays[$i]; ?>" name="sum[]" class="timeSum" readonly type="text" /></td>
            <?php } elseif ($time_sheet_data[0]['payroll_type'] == 'Salaried-weekly' || $time_sheet_data[0]['payroll_type'] == 'Salaried-BiWeekly' || $time_sheet_data[0]['payroll_type'] == 'Salaried-Monthly' || $time_sheet_data[0]['payroll_type'] == 'Salaried-BiMonthly') { ?>
                <td style="display:none;" class="start-time_<?= $i; ?>"><input id="startTime<?= $monStartWeekDays[$i]; ?>" name="start[]" class="hasTimepicker start" type="time" /></td>
                <td style="display:none;" class="finish-time_<?= $i; ?>"><input id="finishTime<?= $monStartWeekDays[$i]; ?>" name="end[]" class="hasTimepicker end" type="time" /></td>
                <td class="hours-worked_<?= $i; ?>">
                    <input id="hoursWorked<?= $monStartWeekDays[$i]; ?>" name="present[]" class="timeSum present" readonly type="checkbox" style="width: 20px; height: 20px" />
                </td>
            <?php } ?>
                <td>
                    <a style="color:white;" class="delete_day btnclr btn m-b-5 m-r-2"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                </td>
            </tr>`);
        }
    });

    function converToMinutes(s) {
        var c = s.split('.');
        return parseInt(c[0]) * 60 + parseInt(c[1]);
    }

    function parseTime(s) {
        return Math.floor(parseInt(s) / 60) + "." + parseInt(s) % 60
    }

    $(document).on('select change', '.end','.dailybreak', function () {

        var $begin = $(this).closest('tr').find('.start').val();
        var $end = $(this).closest('tr').find('.end').val();

        // Calculate time difference
        let valuestart = moment($begin, "HH:mm");
        let valuestop = moment($end, "HH:mm");
        let timeDiff = moment.duration(valuestop.diff(valuestart));

        // Capture the selected daily break in minutes
        var dailyBreakValue = parseInt($(this).closest('tr').find('.dailybreak').val()) || 0;

        // Subtract daily break time from timeDiff in minutes
        var totalMinutes = timeDiff.asMinutes() - dailyBreakValue;

        // Calculate the hours and minutes
        var hours = Math.floor(totalMinutes / 60);
        var minutes = totalMinutes % 60;

        // Format the result as "HH:mm"
        var formattedTime = hours.toString().padStart(2, '0') + '.' + minutes.toString().padStart(2, '0');

        if (isNaN(parseFloat(formattedTime))) {
            $(this).closest('tr').find('.timeSum').val('00:00');
        } else {
            $(this).closest('tr').find('.timeSum').val(formattedTime);
        }


        var total_net = 0;
        $('.table').each(function () {
            var tableTotal = 0;

            $(this).find('.timeSum').each(function () {
                var precio = $(this).val();
                if (!isNaN(precio) && precio.length !== 0) {
                    var [hours, minutes] = precio.split('.').map(parseFloat);
                    tableTotal += hours + minutes / 100; // Dividing minutes by 100 to get the correct decimal value
                }
            });
            total_net += tableTotal;
        });

        // Convert the total back to hours and minutes format
        var hours = Math.floor(total_net);
        var minutes = Math.round((total_net % 1) * 100); // Multiply by 100 to get the minutes

        if (minutes === 100) {
            hours += 1;
            minutes = 0;
        }

        $('#total_net').val(hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0')).trigger('change');
    });


    $(document).on('select change', '.start','.dailybreak', function () {

        var $begin = $(this).closest('tr').find('.start').val();
        var $end = $(this).closest('tr').find('.end').val();

        // Calculate time difference
        let valuestart = moment($begin, "HH:mm");
        let valuestop = moment($end, "HH:mm");
        let timeDiff = moment.duration(valuestop.diff(valuestart));

        // Capture the selected daily break in minutes
        var dailyBreakValue = parseInt($(this).closest('tr').find('.dailybreak').val()) || 0;

        // Subtract daily break time from timeDiff in minutes
        var totalMinutes = timeDiff.asMinutes() - dailyBreakValue;

        // Calculate the hours and minutes
        var hours = Math.floor(totalMinutes / 60);
        var minutes = totalMinutes % 60;

        // Format the result as "HH:mm"
        var formattedTime = hours.toString().padStart(2, '0') + '.' + minutes.toString().padStart(2, '0');

        if (isNaN(parseFloat(formattedTime))) {
            $(this).closest('tr').find('.timeSum').val('00:00');
        }else{
            $(this).closest('tr').find('.timeSum').val(formattedTime);
        }

        var total_net = 0;

        $('.table').each(function () {
            var tableTotal = 0;

            $(this).find('.timeSum').each(function () {
                var precio = $(this).val();
                if (!isNaN(precio) && precio.length !== 0) {
                    var [hours, minutes] = precio.split('.').map(parseFloat);
                    tableTotal += hours + minutes / 100; // Dividing minutes by 100 to get the correct decimal value
                }
            });

            total_net += tableTotal;
        });

        // Convert the total back to hours and minutes format
        var hours = Math.floor(total_net);
        var minutes = Math.round((total_net % 1) * 100); // Multiply by 100 to get the minutes

        if (minutes === 100) {
            hours += 1;
            minutes = 0;
        }

        $('#total_net').val(hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0')).trigger('change');
    });


    $(document).on('input','.timeSum', function () {
        // $(".timeSum").change(function(){
        var $addtotal = $(this).closest('tr').find('.timeSum').val();
        // alert($addtotal);
    });


        // var timeOptions = {
        //   interval: 15,
        //   dropdown: true,
        //   change: function(time) {
        //   sumHours();
        // }
    // }


    // $begin.timepicker(timeOptions);
    // $end.timepicker(timeOptions);


    // $(document).on('focus', $end, function() {
    // $(this).select();  // select entire text on focus
    // });


    // $begin.on("click, focus", function () {
    // $(this).select();
    // });

    $('body').on('keyup','.end',function(){

        var start=$(this).closest('tr').find('.strt').val();
        var end=$(this).closest('td').find('.end').val();
        var breakv=$('#dailybreak').val();
        var calculate=parseInt(start)+parseInt(end);
        var final =calculate-parseInt(breakv);
        // $(this).closest('tr').find('.hours-worked').html(final);
    });


    $(document).on('select change'  ,'#templ_name', function () {
        
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
                $('#payroll_type').val(result[0]['payroll_type']);
            }
        });
    });


    function sumHours () {

        var time1 = $begin.timepicker().getTime();
        var time2 = $end.timepicker().getTime();

        if ( time1 && time2 ) {
        if ( time1 > time2 ) {
            //Correct the day so second entry is always 
            //after first, as in midnight shift. Use a new 
            //date object so original is not incremented.
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

    $(document).on('click','.delete_day',function(){
    $(this).closest('tr').remove();
    var total_net=0;
    $('.table').each(function() {
        $(this).find('.timeSum').each(function() {
            var precio = $(this).val();
            if (!isNaN(precio) && precio.length !== 0) {
            total_net += parseFloat(precio);
            }
        });

    });
    //   console.log(total_net.toFixed(3));
    $('#total_net').val(total_net.toFixed(2)).trigger('change');
    var firstDate = $('.date input').first().val(); // Get the value of the first date input
        var lastDate = $('.date input').last().val(); // Get the value of the last date input

        // Function to convert date format from 'd/m/y' to 'm/d/y'
        function convertDateFormat(dateStr) {
            const [day, month, year] = dateStr.split('/');
            return `${month}/${day}/${year}`;
        }

        // Convert first and last dates to 'm/d/y' format
        var firstDateMDY = convertDateFormat(firstDate);
        var lastDateMDY = convertDateFormat(lastDate);
    $('#reportrange').val(firstDateMDY + ' - ' + lastDateMDY);

    });
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.checkbox.switch-input'); // Selects all checkboxes with class 'switch-input'
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                var idSuffix = this.id.split('_')[1]; // Extracts the unique identifier after 'blockcheck_'
                var correspondingInputField = document.getElementById('block_' + idSuffix); // Finds the matching input field
                // Correctly updates the input field's value based on the checkbox's checked state
                correspondingInputField.value = this.checked ? "present" : "absent";
            });
        });
    });

    

    $(document).ready(function() {
        function updateCounter() {
            var sumOfDays = 0;
            sumOfDays = $('input[type="checkbox"].present:checked').length;
            $('#total_net').val(sumOfDays);
        }
        $(document).on('change', 'input[type="checkbox"].present', function() {
            console.log('active');
            updateCounter();
        });
        var t=$('#payroll_type').val();
        if(t !=='Hourly'){
            updateCounter();
        }
    });

</script>