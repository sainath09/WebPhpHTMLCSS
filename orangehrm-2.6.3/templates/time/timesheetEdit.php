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
 *
 */

require_once ROOT_PATH . '/lib/controllers/TimeController.php';

$GLOBALS['lang_Common_Select'] = $lang_Common_Select;

function populateActivities($projectId, $row, $activityId=null, $activityName=null) {

	ob_clean();

	require ROOT_PATH . '/language/default/lang_default_full.php';

	$timeController = new TimeController();
	$projectActivities = $timeController->fetchProjectActivities($projectId);

	$objResponse = new xajaxResponse();
	$xajaxFiller = new xajaxElementFiller();
	$xajaxFiller->setDefaultOptionName($GLOBALS['lang_Common_Select']);
	$element="cmbActivity[$row]";

	if (count($projectActivities) == 0) {
		$projectActivities[0][0] = -1;
		$projectActivities[0][1] = "- $lang_Time_Timesheet_SelectProject -";

		$objResponse = $xajaxFiller->cmbFillerById($objResponse,$projectActivities, 0,'frmTimesheet',$element, 0);
	} else {
		if ($activityId != null) {
			$projectActivityObject = new ProjectActivity();
		    if ($projectId == $projectActivityObject->retrieveActivityProjectId($activityId)) {
				$activityExists = false;
				$i = 0;
				foreach ($projectActivities as $activity) {
					if ($activity[$i][0] == $activityId) {
					    $activityExists = true;
					}
					$i++;
				}

				if (!$activityExists) {
					$count = count($projectActivities);
					$projectActivities[$count][0] = $activityId;
					$projectActivities[$count][1] = $activityName;
				}
		    }
		}

		$objResponse->addScript("document.getElementById('".$element."').options.length = 0;");
	 	$objResponse->addScript("document.getElementById('".$element."').options[0] = new Option('- $lang_Common_Select -','-1');");
		$objResponse = $xajaxFiller->cmbFillerById($objResponse,$projectActivities, 0,'frmTimesheet',$element, 1);
	}

	$objResponse->addScript('document.getElementById("'.$element.'").focus();');

	$objResponse->addAssign('status','innerHTML','');

	return $objResponse->getXML();
}

$objAjax = new xajax();
$objAjax->registerFunction('populateActivities');
$objAjax->processRequests();

$timesheet=$records[0];
$timesheetSubmissionPeriod=$records[1];
$timeExpenses=$records[2];
$customers=$records[3];
$projects=$records[4];
$employee=$records[5];
$self=$records[6];
$return=$records[8];

$status=$timesheet->getStatus();

switch ($status) {
	case Timesheet::TIMESHEET_STATUS_NOT_SUBMITTED : $statusStr = $lang_Time_Timesheet_Status_NotSubmitted;
												break;
	case Timesheet::TIMESHEET_STATUS_SUBMITTED : $statusStr = $lang_Time_Timesheet_Status_Submitted;
												break;
	case Timesheet::TIMESHEET_STATUS_APPROVED : $statusStr = $lang_Time_Timesheet_Status_Approved;
												break;
	case Timesheet::TIMESHEET_STATUS_REJECTED : $statusStr = $lang_Time_Timesheet_Status_Rejected;
												break;
}

$startDate = strtotime($timesheet->getStartDate() . " 00:00:00");
$endDate = strtotime($timesheet->getEndDate() . " 23:59:59");
$startDatePrint = LocaleUtil::getInstance()->formatDateTime(date("Y-m-d H:i", $startDate));
$endDatePrint = LocaleUtil::getInstance()->formatDateTime(date("Y-m-d H:i", $endDate));
$row=0;

$sysConf = new sysConf();
$dateFormat = LocaleUtil::convertToXpDateFormat($sysConf->getDateFormat());
$timeFormat = LocaleUtil::convertToXpDateFormat($sysConf->getTimeFormat());

?>
<style type="text/css">
.tableTopLeft {
    background: none;
}
.tableTopMiddle {
    background: none;
}
.tableTopRight {
    background: none;
}
.tableMiddleLeft {
    background: none;
}
.tableMiddleRight {
    background: none;
}
.tableBottomLeft {
    background: none;
}
.tableBottomMiddle {
    background: none;
}
.tableBottomRight {
    background: none;
}
.tableMiddleMiddle {
	text-align: left;
}
</style>
<script type="text/javascript">
<!--
currFocus = null;
totRows = 0;

var initialAction = "<?php echo $_SERVER['PHP_SELF']; ?>?timecode=Time&id=<?php echo $timesheet->getTimesheetId(); ?>&action=";
var dateFormat = '<?php echo $dateFormat; ?>';
var timeFormat = '<?php echo $timeFormat; ?>';
var dateTimeFormat = dateFormat + " " + timeFormat;

function $(id) {
	return document.getElementById(id);
}

function isEmpty(value) {
	value = trim(value);
	return (value == "");
}

function isFieldEmpty(id) {
	return isEmpty($(id).value);
}

function actionSubmit() {
	$("frmTimesheet").action= initialAction+"Submit_Timesheet";

	$("frmTimesheet").submit();
}

function looseCurrFocus(row) {
	currFocus = null;
}

function setCurrFocus(label, row) {
	currFocus = $(label+"["+row+"]");
}

/**
 * Checks that the given date is within the timesheet period.
 * @return true if date within period, false otherwise
 */
function checkDateWithinPeriod(dateToCheck) {

	if (dateToCheck) {

		periodStart = strToTime("<?php echo $startDatePrint; ?>", dateTimeFormat);
		periodEnd = strToTime("<?php echo $endDatePrint; ?>", dateTimeFormat);

		if ((dateToCheck < periodStart) || (dateToCheck > periodEnd)) {
			return false;
		}
	}
	return true;

}

/**
 * checks that the given date and duration are within the timesheet period
 *
 * @return true if within period, false otherwise.
 */
function checkDateAndDuration(dateValue, duration) {

	periodStart = strToTime("<?php echo $startDatePrint; ?>", dateTimeFormat);
	periodEnd = strToTime("<?php echo $endDatePrint; ?>", dateTimeFormat);

	// ignore invalid dates and durations since those are checked separately
	if (dateValue && validateDuration(duration)) {

		if ((dateValue < periodStart) || (dateValue > periodEnd)) {
			return false;
		}

		endTime = new Date();
		endTime.setTime(dateValue + (3600000 * duration));

		if ((endTime < periodStart) || (endTime > periodEnd)) {
			return false;
		}
	}

	return true;
}


/**
 * Validates the given duration.
 * Checks that it is a positive number.
 *
 * @return true if valid, false otherwise
 */
function validateDuration(value) {

	if (value != "") {
		regExp = /^[0-9]+\.*[0-9]*/;

		if (!regExp.test(value)) {
			return false;
		}
	}
	return true;
}

/**
 * Validates fields
 *
 * @return true if valid, false otherwise
 */
function validate() {

	errorMsgs = new Array();
	err = new Array();
	errFlag = false;

	for (x = 0; x <= totRows; x++) {
		if (x == totRows) {
			lastRow = true;
		} else {
			lastRow = false;
		}

		if (!lastRow || !allEmpty(x)) {
			err[x] = false;

			txtReportedDate = trim($("txtReportedDate["+x+"]").value);
			duration = trim($("txtDuration["+x+"]").value);

			reportedDate = strToDate(txtReportedDate, dateFormat);

			// Validate values

			if ($("cmbActivity["+x+"]").value == "-1") {
				errorMsgs[0] = "<?php echo $lang_Time_Errors_ActivityNotSpecified_ERROR; ?>";
				err[x] = true;
			}

			if ($("cmbProject["+x+"]").value == "-1") {
				errorMsgs[1] = "<?php echo $lang_Time_Errors_ProjectNotSpecified_ERROR; ?>";
				err[x] = true;
			}

			if (txtReportedDate == "") {
				errorMsgs[4] = "<?php echo $lang_Time_Errors_ReportedDateNotSpecified_ERROR; ?>";
				err[x] = true;
			} else if (!reportedDate) {
				errorMsgs[5] = "<?php echo $lang_Time_Errors_InvalidReportedDate_ERROR; ?>";
				err[x] = true;
			}

			// 0 not allowed for duration in last row.
			if (!validateDuration(duration) || (lastRow && (duration != "") && (duration == 0))) {
				errorMsgs[6] = "<?php echo $lang_Time_Errors_InvalidDuration_ERROR; ?>";
				err[x] = true;
			}

			if (err[x]) {
				errFlag = true;
				$("row["+x+"]").style.background = "#FFAAAA";
			} else {
				$("row["+x+"]").style.background = "#FFFFFF";
			}
		}
	}

	if (errFlag) {
		errStr = "<?php echo $lang_Time_Errors_EncounteredTheFollowingProblems; ?>\n";
		for (j in errorMsgs) {
			errStr += " - " + errorMsgs[j] + "\n";
		}
		alert(errStr);

		return false;
	}

	return true;
}

/**
 * Checks whether all values in the row are empty.
 */
function allEmpty(row) {

	if (!isFieldEmpty("txtDuration["+row+"]")) {
		return false;
	}

	if ($("cmbActivity["+row+"]").value != "-1") {
		return false;
	}

	if ($("cmbProject["+row+"]").value != "-1") {
		return false;
	}

	if (!isFieldEmpty("txtDescription["+row+"]")) {
		return false;
	}

	return true;
}

function actionUpdate() {
	if (!validate()) return false;

	$('frmTimesheet').action= initialAction+'Edit_Timesheet';
	$('frmTimesheet').submit();
}

function actionReset() {
	$('frmTimesheet').reset();
}

function deleteTimeEvents() {
	$check = 0;
	with (document.frmTimesheet) {
		for (var i=0; i < elements.length; i++) {
			if ((elements[i].type == 'checkbox') && (elements[i].checked == true) && (elements[i].name == 'deleteEvent[]')){
				$check = 1;
			}
		}
	}

	if ($check == 1){
		var res = confirm("<?php echo $lang_Common_ConfirmDelete?>");

		if(!res) return;

		$('frmTimesheet').action= initialAction+'Delete_Timesheet';
		$('frmTimesheet').submit();
	}else{
		alert("<?php echo $lang_Common_SelectDelete; ?>");
	}
}

function goBack() {
	window.location=initialAction+"<?php echo $return; ?>&id=<?php echo $timesheet->getTimesheetId(); ?>";
}
-->
</script>
<?php $objAjax->printJavascript(); ?>
<div id="status"></div>

   <div class="navigation">
	    <input type="button" class="backbutton"
			onclick="goBack();" onmouseover="moverButton(this);" onmouseout="moutButton(this);"
			value="<?php echo $lang_Common_Back;?>" />
    </div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php  $headingStr = $lang_Time_Timesheet_TimesheetNameForEditTitle;
            if ($self) {
                $headingStr = $lang_Time_Timesheet_TimesheetForEditTitle;
            }
            echo preg_replace(array('/#periodName/', '/#startDate/', '/#name/'),
                            array($timesheetSubmissionPeriod->getName(), LocaleUtil::getInstance()->formatDate($timesheet->getStartDate()), "{$employee[2]} {$employee[1]}"),
                            $headingStr); ?>
</h2></div>

    <?php
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            $messageType = CommonFunctions::getCssClassForMessage($message);
            $message = "lang_Time_Errors_" . $message;
    ?>
        <div class="messagebar">
            <span class="<?php echo $messageType; ?>"><?php echo (isset($$message)) ? $$message: ""; ?></span>
        </div>
    <?php } ?>

<form id="frmTimesheet" name="frmTimesheet" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?timecode=Time&id=<?php echo $timesheet->getTimesheetId(); ?>&action=">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="tableTopLeft"></th>
	    	<th class="tableTopMiddle"></th>
	    	<th class="tableTopMiddle"></th>
	    	<th class="tableTopMiddle"></th>
	    	<th class="tableTopMiddle"></th>
	    	<th class="tableTopMiddle"></th>
	    	<th class="tableTopMiddle"></th>
			<th class="tableTopRight"></th>
		</tr>
		<tr>
			<th class="tableMiddleLeft"></th>
			<th class="tableMiddleMiddle"></th>
			<th class="tableMiddleMiddle"><?php echo $lang_Time_Timesheet_Project; ?></th>
			<th class="tableMiddleMiddle"><?php echo $lang_Time_Timesheet_Activity; ?></th>
			<th class="tableMiddleMiddle"><?php echo $lang_Time_Timesheet_ReportedDate; ?></th>
			<th class="tableMiddleMiddle"><?php echo $lang_Time_Timesheet_Duration; ?> <?php echo $lang_Time_Timesheet_DurationUnits; ?></th>
			<th class="tableMiddleMiddle"><?php echo $lang_Time_Timesheet_Decription; ?></th>
			<th class="tableMiddleRight"></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$customerObj = new Customer();
		$projectObj = new Projects();
		$projectActivityObj = new ProjectActivity();

		if (isset($timeExpenses) && is_array($timeExpenses)) {

			foreach ($timeExpenses as $timeExpense) {
				$projectId = $timeExpense->getProjectId();
				$projectName = $projectObj->retrieveProjectName($projectId);
				$customerName = $projectObj->retrieveCustomerName($projectId);
				$activityId = $timeExpense->getActivityId();
				$activityName = $projectActivityObj->retrieveActivityName($activityId);

				$projectDet = $projectObj->fetchProject($projectId);
				$projectActivities = $projectActivityObj->getActivityList($projectId);
			?>
			<tr id="row[<?php echo $row; ?>]">
				<td class="tableMiddleLeft"></td>
				<td ><input type="checkbox" id="deleteEvent[]" name="deleteEvent[]" value="<?php echo $timeExpense->getTimeEventId(); ?>" /></td>
				<td ><select id="cmbProject[<?php echo $row; ?>]" name="cmbProject[]" onfocus="looseCurrFocus();" onchange="$('status').innerHTML='<?php echo $lang_Common_Loading;?>...'; xajax_populateActivities(this.value, <?php echo "$row, $activityId, '" . CommonFunctions::escapeForJavascript($activityName) . "'"; ?>);">
				<option value="-1">--<?php echo $lang_Leave_Common_Select;?>--</option>
				<option selected value="<?php echo $projectId; ?>"><?php echo "{$customerName} - {$projectName}"; ?></option>
				<?php if (is_array($projects)) { ?>

				<?php	foreach ($projects as $project) {
							$customerDet = $customerObj->fetchCustomer($project->getCustomerId(), true);
							$customerStatus = $customerDet->getCustomerStatus();
							if ($projectId != $project->getProjectId() && $customerStatus == 0) {
				?>
				<option value="<?php echo $project->getProjectId(); ?>"><?php echo "{$customerDet->getCustomerName()} - {$project->getProjectName()}"; ?></option>
				<?php
							}
				?>

				<?php 	}
					} else { ?>
						<option value="-1">- <?php echo $lang_Time_Timesheet_NoProjects;?> -</option>
				<?php } ?>
					</select>
				</td>
				<td ><select id="cmbActivity[<?php echo $row; ?>]" name="cmbActivity[]" onfocus="looseCurrFocus();">
				<?php if (is_array($projectActivities)) { ?>
						<option value="-1">--<?php echo $lang_Leave_Common_Select;?>--</option>
						<option selected value="<?php echo $activityId; ?>"><?php echo $activityName; ?></option>
				<?php	foreach ($projectActivities as $projectActivity) {
							if ($activityId != $projectActivity->getId()) {
				?>
						<option value="<?php echo $projectActivity->getId(); ?>"><?php echo $projectActivity->getName(); ?></option>
				<?php
							}
				?>
				<?php 	}
					} else { ?>
						<option value="-1">- <?php echo $lang_Time_Timesheet_NoCustomers;?> -</option>
				<?php } ?>
					</select>
				</td>
				<td><input type="text" id="txtReportedDate[<?php echo $row; ?>]" name="txtReportedDate[]" value="<?php echo LocaleUtil::getInstance()->formatDate($timeExpense->getReportedDate()); ?>" onfocus="looseCurrFocus();" /></td>
				<td><input type="text" <?php echo ($timeExpense->getStartTime() == null)?'':'readonly="readonly"'; ?> id="txtDuration[<?php echo $row; ?>]" name="txtDuration[]" value="<?php echo round($timeExpense->getDuration()/36)/100; ?>" onfocus="looseCurrFocus();" /></td>
				<td><textarea type="text" id="txtDescription[<?php echo $row; ?>]" name="txtDescription[]" onfocus="looseCurrFocus();" ><?php echo $timeExpense->getDescription(); ?></textarea>
					<input type="hidden" id="txtTimeEventId[<?php echo $row; ?>]" name="txtTimeEventId[]" value="<?php echo $timeExpense->getTimeEventId(); ?>" />
				</td>
				<td class="tableMiddleRight"></td>
			</tr>
		<?php
				$row++;
			}
		}?>
			<tr id="row[<?php echo $row; ?>]">
				<td class="tableMiddleLeft"></td>
				<td ><input type="checkbox" id="deleteEvent[]" name="deleteEvent[]" disabled="disabled" /></td>
				<td ><select id="cmbProject[<?php echo $row; ?>]" name="cmbProject[]" onfocus="looseCurrFocus();"  onchange="$('status').innerHTML='<?php echo $lang_Common_Loading;?>...'; xajax_populateActivities(this.value, <?php echo $row; ?>);" >
				<?php if (is_array($projects)) { ?>
						<option value="-1">--<?php echo $lang_Leave_Common_Select;?>--</option>
				<?php	foreach ($projects as $project) {
							$customerDet = $customerObj->fetchCustomer($project->getCustomerId(), true);
							$customerStatus = $customerDet->getCustomerStatus();

							if ($customerStatus == 0) {
				?>
						<option value="<?php echo $project->getProjectId(); ?>"><?php echo "{$customerDet->getCustomerName()} - {$project->getProjectName()}"; ?></option>
				<?php 	}  }
					} else { ?>
						<option value="-1">- <?php echo $lang_Time_Timesheet_NoProjects;?> -</option>
				<?php } ?>
					</select>
				</td>
				<td ><select id="cmbActivity[<?php echo $row; ?>]" name="cmbActivity[]" onfocus="looseCurrFocus();">
						<option value="-1">- <?php echo $lang_Time_Timesheet_SelectProject; ?> -</option>
					</select>
				</td>
				<td><input type="text" id="txtReportedDate[<?php echo $row; ?>]" name="txtReportedDate[]" value="<?php echo LocaleUtil::getInstance()->formatDate(date('Y-m-d')); ?>" onfocus="looseCurrFocus();" /></td>
				<td><input type="text" id="txtDuration[<?php echo $row; ?>]" name="txtDuration[]" onfocus="looseCurrFocus();" /></td>
				<td><textarea type="text" id="txtDescription[<?php echo $row; ?>]" name="txtDescription[]" onfocus="looseCurrFocus();" ></textarea></td>
				<td class="tableMiddleRight"></td>
			</tr>
	</tbody>
	<tfoot>
	  	<tr>
			<td class="tableBottomLeft"></td>
			<td class="tableBottomMiddle"></td>
			<td class="tableBottomMiddle"></td>
			<td class="tableBottomMiddle"></td>
			<td class="tableBottomMiddle"></td>
			<td class="tableBottomMiddle"></td>
			<td class="tableBottomMiddle"></td>
			<td class="tableBottomRight"></td>
		</tr>
  	</tfoot>
</table>
<p id="controls">

<input type="hidden" name="txtTimesheetId" value="<?php echo $timesheet->getTimesheetId(); ?>" />
<input type="hidden" name="txtEmployeeId" value="<?php echo $timesheet->getEmployeeId(); ?>" />
<input type="hidden" name="nextAction" value="<?php echo $return; ?>" />
<div class="formbuttons">
<input type="button" class="updatebutton"
        onclick="actionUpdate(); return false;"
        onmouseover="moverButton(this);" onmouseout="moutButton(this);"
        name="btnUpdate" id="btnUpdate"
        value="<?php echo $lang_Common_Update;?>" />
<input type="button" class="resetbutton"
        onclick="actionReset(); return false;"
        onmouseover="moverButton(this);" onmouseout="moutButton(this);"
        name="btnReset" id="btnReset"
        value="<?php echo $lang_Common_Reset;?>" />

<input type="button" class="delbutton"
        onmouseover="moverButton(this);" onmouseout="moutButton(this);"
        onclick="deleteTimeEvents(); return false;"
        name="btnDelete" id="btnDelete"
        value="<?php echo $lang_Common_Delete;?>" />

&nbsp;<?php echo $lang_Time_TimeFormat . " : {$dateFormat} {$timeFormat}";?>
</div>

</form>
</div>
</div>
</p>
<script type="text/javascript">
        //<![CDATA[
        totRows = <?php echo $row; ?>;
        currFocus = $("cmbProject[<?php echo $row; ?>]");
        currFocus.focus();
        if (document.getElementById && document.createElement) {
            roundBorder('outerbox');
        }
        //]]>
</script>
