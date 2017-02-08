<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */
?>
<?php echo stylesheet_tag('../orangehrmCoreLeavePlugin/css/viewHolidayListSuccess'); ?>
<div id="flash_message_wrapper" style="width: 630px;">
    <?php echo isset($templateMessage)?templateMessage($templateMessage):''; ?>
</div>
<div id="errorDiv"></div>

<div id="errorDiv"></div>

<div class="outerbox" style="width: 600px;">
    <div class="mainHeading"><h2><?php echo __('Holidays'); ?></h2></div>
    <form method="post" name="frmHolidaySearch" id="frmHolidaySearch" action="<?php echo url_for('leave/viewHolidayList'); ?>">
        <table border="0" id="holidaySearch">
            <tr>
                <td class="labelText"><?php echo __('Leave Period'); ?></td>
                <td>
                    <select name="leavePeriod">
                        <?php 
                            if (empty($leavePeriods)) {                            
                        ?>
                        <option value="0"><?php echo __('No Leave Periods');?></option>
                        <?php                       
                            } else {

                            foreach($leavePeriods as $leavePeriod) {
                                $id = $leavePeriod->getLeavePeriodId();
                                $selected = ($id == $leavePeriodId) ? 'selected="selected"' : '';
                        ?>

                        <option value="<?php echo $id;?>" <?php echo $selected;?>>
                            <?php echo ohrm_format_date($leavePeriod->getStartDate()) . " " . __("to") . " " . ohrm_format_date($leavePeriod->getEndDate());?>
                        </option>

                        <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
    <div class="formbuttons paddingLeft">
    <input type="button" name="btnSearch" id="btnSearch" value="<?php echo __("Search") ?>" class="savebutton" />
    </div>
</div>

<div class="outerbox">

    <form method="post" name="frmHolidayList" id="frmHolidayList" action="<?php echo url_for('leave/holidayList'); ?>">

        <div class="actionbar">

            <div class="actionbuttons">

                <input type="button" class="addbutton" name="btnAdd" id="btnAdd" value="<?php echo __('Add'); ?>" />
                <!--<input type="button" class="editbutton" name="btnEdit" id="btnEdit" value="<?php echo __('Edit'); ?>" />-->
                <input type="button" class="delbutton" name="btnDel" id="btnDel" value="<?php echo __('Delete'); ?>" />
                <input type="hidden" name="hdnEditId" id="hdnEditId" value="" />
            </div> <!-- End of actionbuttons -->

        </div> <!-- End of actionbar -->

        <br class="clear" />

        <table border="0" cellpadding="0" cellspacing="0" class="data-table">

            <thead>
                <tr>
                    <td width="50">
                        <input type="checkbox" class="innercheckbox" name="allCheck" id="allCheck" value="" />
                    </td>
                    <td><?php echo __('Name of Holiday'); ?></td>
                    <td><?php echo __('Date'); ?></td>
                    <td><?php echo __('Full Day') . "/" . __('Half Day'); ?></td>
                    <td><?php echo __('Repeats Annually'); ?></td>
                </tr>
            </thead>

            <tbody>

                <?php $rowClass = 'odd' ?>
                <?php

                ?>

                <?php foreach ($holidayList as $holiday)
                { ?>

                <tr class="<?php echo $rowClass; ?>">
                    <td>
                        <input type="checkbox" class="innercheckbox" name="chkHolidayId[]" value="<?php echo $holiday->getHolidayId(); ?>" />
                    </td>
                    <td>
                       <a href="<?php echo url_for('leave/defineHoliday/?hdnEditId=' . $holiday->getHolidayId());?>"><?php echo $holiday->getDescription(); ?></a>
                    </td>
                    <td>
                            <?php echo ohrm_format_date($holiday->getFdate()); ?>
                    </td>

                    <td>
                            <?php echo __($daysLenthList[$holiday->getLength()]); ?>
                    </td>
                    <td>
                            <?php echo __($yesNoList[$holiday->getRecurring()]); ?>
                    </td>
                        <?php $rowClass = $rowClass=='odd'?'even':'odd'; ?>

                </tr>

                    <?php } // End of $leaveTypeList foreach ?>

            </tbody>

        </table>

<!--<div><span class="error" id="messageLayer1"></span></div>--> 
<!--<div><span class="error" id="messageLayer2"></span></div>--> 

    </form>

</div> <!-- End of outerbox -->

<script type="text/javascript"> 

    $(document).ready(function() {

        $("#btnSearch").click(function(){
            $("#frmHolidaySearch").submit();
        });

        // Add button
        $('#btnAdd').click(function(){
            window.location.href = '<?php echo url_for('leave/defineHoliday'); ?>';
        });

        /* Delete button */
        $('#btnDel').click(function(){

            $('#frmHolidayList').attr('action', '<?php echo url_for('leave/deleteHoliday'); ?>');
            $('#frmHolidayList').submit();

        });

        /* Edit button */
        $('#btnEdit').click(function(){
            var holidayId = '';
            var checkedCount = 0;
            var errorCount = 0;
            var errorMessage = '';

            $('.innercheckbox').each(function(){

                if ($(this).attr('checked')) {
                    holidayId = $(this).val();
                    checkedCount++;
                }

            });
            if (checkedCount == 0) {
                errorCount++;
                errorMessage = '<?php echo __('Please select at least one holiday to edit'); ?>';
            }

            if (checkedCount > 1) {
                errorCount++;
                errorMessage = '<?php echo __('Please select only one holiday to edit'); ?>';
            }

            if (errorCount > 0) {
                $("#flash_message_wrapper").html('');
                $('#errorDiv').attr('class', 'messageBalloon_warning');
                $('#errorDiv').empty();
                $('#errorDiv').append('<ul><li>'+errorMessage+'</li></ul>');
            }

            if (checkedCount == 1) {
                $('#hdnEditId').val(holidayId);
                $('#frmHolidayList').attr('method', 'get');
                $('#frmHolidayList').attr('action', '<?php echo url_for('leave/defineHoliday'); ?>');
                $('#frmHolidayList').submit();
            }

        });

        /* Checkbox behavior */
        $("#allCheck").click(function() {
            if ($('#allCheck').attr('checked')) {
                $('.innercheckbox').attr('checked', true);
                $('#btnDel').attr('disabled', false);
            } else {
                $('.innercheckbox').attr('checked', false);
            }
        });

        $(".innercheckbox").click(function() {
            if(!($(this).attr('checked'))) {
                $('#allCheck').attr('checked', false);
            }
            $('#btnDel').attr('disabled', false);
        });



    }); // ready():Ends


</script>
