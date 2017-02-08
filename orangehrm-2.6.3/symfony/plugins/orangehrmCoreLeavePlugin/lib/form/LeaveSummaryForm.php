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

class LeaveSummaryForm extends sfForm {

    private $formWidgets = array();
    private $formValidators = array();
    public $leaveSummaryEditMode = false;
    public $pageNo = 1;
    public $pager;
    public $offset = 0;
    public $recordsCount;
    public $recordsLimit = 20;
    public $saveSuccess;
    public $userType;
    public $loggedUserId;
    public $subordinatesList;
    public $currentLeavePeriodId;
    private $leavePeriodService;
    private $searchParam = array();
    private $empId;
    private $employeeService;
    private $leaveTypeService;
    private $companyService;
    private $jobService;
    private $leaveSummaryService;
    private $leaveEntitlementService;

    public function configure() {

        $this->userType = $this->getOption('userType');
        $this->loggedUserId = $this->getOption('loggedUserId');
        $this->searchParam['employeeId'] = $this->getOption('employeeId');
        $this->empId = $this->getOption('empId');

        $this->_setCurrentLeavePeriodId(); // This should be called before _setLeavePeriodWidgets()

        $formWidgets = array();
        $formValidators = array();

        /* Setting leave periods */
        $this->_setLeavePeriodWidgets();

        /* Setting leave types */
        $this->_setLeaveTypeWidgets();

        /* Setting records count */
        $this->_setRecordsCountWidgets();

        if ($this->userType == 'Admin' || $this->userType == 'Supervisor') {

            /* Setting locations */
            $this->_setLocationWidgets();

            /* Setting job titles */
            $this->_setJobTitleWidgets();

            /* Setting sub divisions */
            $this->_setSubDivisionWidgets();

            /* Setting txtEmpName */
            $this->formWidgets['txtEmpName'] = new sfWidgetFormInput();
            $this->formValidators['txtEmpName'] = new sfValidatorString(array('required' => false));

            /* Setting cmbEmpId */
            $this->formWidgets['cmbEmpId'] = new sfWidgetFormInputHidden();
            $this->formValidators['cmbEmpId'] = new sfValidatorString(array('required' => false));

            $employeeId = 0;
            $empName = __("All");
            if(!is_null($this->searchParam['employeeId'])) {
                $employeeId = $this->searchParam['employeeId'];
                $employeeService = $this->getEmployeeService();
                $employee = $employeeService->getEmployee($this->searchParam['employeeId']);
                $empName = $employee->getFirstName() . " " . $employee->getLastName();
            }

            /* Setting default values */
            $this->setDefault('txtEmpName', $empName);
            $this->setDefault('cmbEmpId', $employeeId);

            $this->setDefault('cmbLeavePeriod', $this->currentLeavePeriodId);

        }

    	$this->setWidgets($this->formWidgets);
    	$this->setValidators($this->formValidators);
        $this->widgetSchema->setNameFormat('leaveSummary[%s]');

    }

    public function setEmployeeService(EmployeeService $employeeService) {
        $this->employeeService = $employeeService;
    }

    public function getEmployeeService() {
        if(is_null($this->employeeService)) {
            $this->employeeService = new EmployeeService();
            $this->employeeService->setEmployeeDao(new EmployeeDao());
        }
        return $this->employeeService;
    }

    public function setRecordsLimitDefaultValue() {
        $this->setDefault('cmbRecordsCount', $this->recordsLimit);
    }

    private function _setLeavePeriodWidgets() {

        $leavePeriodService = $this->getLeavePeriodService();
        $leavePeriodList = $leavePeriodService->getLeavePeriodList();
        $choices = array();

        sfContext::getInstance()->getConfiguration()->loadHelpers('OrangeDate');

        foreach ($leavePeriodList as $leavePeriod) {

            $choices[$leavePeriod->getLeavePeriodId()] = ohrm_format_date($leavePeriod->getStartDate())
                                                         . " " .  __('to') . " "
                                                         . ohrm_format_date($leavePeriod->getEndDate());

        }

        if (empty($choices)) {
            $choices = array('0' => 'No Leave Periods');
        }

        $this->formWidgets['cmbLeavePeriod'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->formValidators['cmbLeavePeriod'] = new sfValidatorChoice(array('choices' => array_keys($choices)));

    }

    public function setLeaveTypeService(LeaveTypeService $leaveTypeService) {
        $this->leaveTypeService = $leaveTypeService;
    }

    public function getLeaveTypeService() {
        if(is_null($this->leaveTypeService)) {
            $this->leaveTypeService = new LeaveTypeService();
            $this->leaveTypeService->setLeaveTypeDao(new LeaveTypeDao());
        }
        return $this->leaveTypeService;
    }

    private function _setLeaveTypeWidgets() {

        $leaveTypeService = $this->getLeaveTypeService();
        $leaveTypeService->setLeaveTypeDao(new LeaveTypeDao());
        $leaveTypeList = $leaveTypeService->getLeaveTypeList();
        $choices = array('0' => __('All'));

        foreach ($leaveTypeList as $leaveType) {

            $choices[$leaveType->getLeaveTypeId()] = $leaveType->getLeaveTypeName();

        }

        $this->formWidgets['cmbLeaveType'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->formValidators['cmbLeaveType'] = new sfValidatorChoice(array('choices' => array_keys($choices)));

    }

    private function _setRecordsCountWidgets() {

        $choices = array('20' => 20, '50' => 50, '100' => 100, '200' => 200);

        $this->formWidgets['cmbRecordsCount'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->formValidators['cmbRecordsCount'] = new sfValidatorChoice(array('choices' => array_keys($choices)));

    }

    public function getCompanyService() {
        if(is_null($this->companyService)) {
            $this->companyService = new CompanyService();
            $this->companyService->setCompanyDao(new CompanyDao());
        }
        return $this->companyService;
    }

    public function setCompanyService(CompanyService $companyService) {
        $this->companyService = $companyService;
    }

    private function _setLocationWidgets() {

        $companyService = $this->getCompanyService();
        $locationList = $companyService->getCompanyLocation();
        $choices = array('0' => __('All'));

        foreach ($locationList as $location) {

            $choices[$location->getLocCode()] = $location->getLocName();

        }

        $this->formWidgets['cmbLocation'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->formValidators['cmbLocation'] = new sfValidatorChoice(array('choices' => array_keys($choices)));

    }

    private function _setSubDivisionWidgets() {

        $companyService = $this->getCompanyService();

        $subUnitList = array(0 => __("All"));
        $tree = $companyService->getSubDivisionTree();

        foreach($tree as $node) {

            // Add nodes, indenting correctly. Skip root node
            if ($node->getId() != 1) {
                if($node->depth == "") {
                    $node->depth = 1;
                }
                $indent = str_repeat('&nbsp;&nbsp;', $node->depth - 1);
                $subUnitList[$node->getId()] = $indent . $node->getTitle();
            }
        }

        $this->formWidgets['cmbSubDivision'] = new sfWidgetFormChoice(array('choices' => $subUnitList));
        $this->formValidators['cmbSubDivision'] = new sfValidatorChoice(array('choices' => array_keys($subUnitList)));

    }

    public function getJobService() {
        if(is_null($this->jobService)) {
            $this->jobService = new JobService();
            $this->jobService->setJobDao(new JobDao());
        }
        return $this->jobService;
    }

    public function setJobService(JobService $jobService) {
        $this->jobService = $jobService;
    }

    private function _setJobTitleWidgets() {

        $jobService = $this->getJobService();
        $jobList = $jobService->getJobTitleList();
        $choices = array('0' => __('All'));

        foreach ($jobList as $job) {

            $choices[$job->getId()] = $job->getName();

        }

        $this->formWidgets['cmbJobTitle'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->formValidators['cmbJobTitle'] = new sfValidatorChoice(array('choices' => array_keys($choices)));

    }

    public function getLeaveSummaryTbodyHtml() {

        $leaveSummaryService = new LeaveSummaryService();
        $leaveSummaryService->setLeaveSummaryDao(new LeaveSummaryDao());
        $recordsResult = $leaveSummaryService->fetchRawLeaveSummaryRecords($this->_getSearchClues(), $this->offset, $this->recordsLimit);

        $leaveEntitlementService = new LeaveEntitlementService();
        $leaveEntitlementService->setLeaveEntitlementDao(new LeaveEntitlementDao());

        $class = 'odd';
        $baseUrl = url_for('leave/viewLeaveList') . '/leavePeriodId/%s/';
        $html = "<tbody>\n";
        if ($this->recordsCount > 0) {

            $i = 0;

            while ($row = $recordsResult->fetch()) {

                $employeeName = $row['empFirstName'].' '.$row['empLastName'];
                $employeeId = $row['empNumber'];
                $leaveType = $row['leaveTypeName'];
                $leaveTypeId = $row['leaveTypeId'];
                $leavePeriodId = $this->_getLeavePeriod();
                
                $baseUrl = sprintf($baseUrl, $leavePeriodId);

                $leaveEntitlementObj = $leaveEntitlementService->readEmployeeLeaveEntitlement($employeeId, $leaveTypeId, $leavePeriodId);

                if ($leaveEntitlementObj instanceof EmployeeLeaveEntitlement) {
                    $leaveEntitled = $leaveEntitlementObj->getNoOfDaysAllotted();
                    $leaveBroughtForward = $leaveEntitlementObj->getLeaveBroughtForward();
                    $leaveCarryForward = $leaveEntitlementObj->getLeaveCarriedForward();
                } else {
                    $leaveEntitled = '0.00';
                    $leaveBroughtForward = '0.00';
                    $leaveCarryForward = '0.00';
                }

                $leaveRequestService = new LeaveRequestService();
                $leaveRequestService->setLeaveRequestDao(new LeaveRequestDao());

                $leaveTaken = $leaveRequestService->getTakenLeaveSum($employeeId, $leaveTypeId, $leavePeriodId);
                $leaveTaken = empty($leaveTaken)?'0.00':$leaveTaken;

                $leaveScheduled = $this->_getLeaveScheduled($employeeId, $leaveTypeId, $leavePeriodId);
                
                $leaveRemaining = ($leaveEntitled + $leaveBroughtForward) - ($leaveTaken + $leaveScheduled + $leaveCarryForward);
                $leaveRemaining = number_format($leaveRemaining, 2);

                $rowDisplayFlag = false;
                $deletedFlag = false;
                //show active leave types
                if($row['availableFlag'] == 1) {
                    $rowDisplayFlag = true;
                }

                //show inactive leave types if any leaveEntitled, leaveTaken, leaveScheduled of them above 0
                if(($row['availableFlag'] != 1) && ($leaveEntitled > 0 || $leaveTaken > 0 || $leaveScheduled > 0)) {
                    $rowDisplayFlag = true;
                    $deletedFlag = true;
                }

                if($rowDisplayFlag) {
                    $html .= "<tr class=\"$class\">\n";
                    $class = $class=='odd'?'even':'odd';

                    $html .= $this->getEmployeeNameColumnHtml($employeeId, $employeeName);
                    $html .= $this->getLeaveTypeNameColumnHtml($leaveType, $deletedFlag);
                    $html .= $this->getLeaveEntitledColumnHtml($leaveTypeId, $leaveEntitled, $i, $employeeId, $leavePeriodId);
                    $html .= $this->getLeaveBroughtForwardColumnHtml($leaveBroughtForward);
                    $html .= $this->getScheduledColumnHtml($leaveScheduled, $employeeId, $leaveTypeId);
                    $html .= $this->getTakenColumnHtml($leaveTaken, $employeeId, $leaveTypeId);
                    $html .= $this->getCarriedForwardColumnHtml($leaveCarryForward);
                    $html .= $this->getLeaveRemainingColumnHtml($leaveRemaining);

                    $i++;

                } // while ($row = mysql_fetch_array($recordsResult))
            }
            $html .= "</tbody>\n";

        } // if ($count > 0)

        return $html;

    }

    /**
     * Returns Employee Name Column HTML String
     * @param int $employeeId
     * @param String $employeeName
     * @returns String
     */
    protected function getEmployeeNameColumnHtml($employeeId, $employeeName) {
        $html = "<td>\n";
        //$html .= content_tag('a', $employeeName, array('href' => "{$baseUrl}employeeId/{$employeeId}")) . "\n";

        if($this->empId != $employeeId) {
            //$pimLink = public_path("../../lib/controllers/CentralController.php?menu_no_top=hr&id=" . $employeeId . "&capturemode=updatemode&reqcode=EMP&currentPage=1");
            $pimLink = "../pim/viewPersonalDetails?empNumber=" . $employeeId;
            $html .= "&nbsp;<a href='" . $pimLink . "'>". $employeeName . "</a>\n";
        } else {
            $html .= "&nbsp;". $employeeName;
        }
        $html .= "</td>\n";
        return $html;
    }

    /**
     * Returns LeaveType Name Column HTML String
     * @param String $leaveType
     * @param boolean $deletedFlag
     * @returns String
     */
    protected function getLeaveTypeNameColumnHtml($leaveType, $deletedFlag = false) {
        $html = "<td>\n";
        $html .= "$leaveType";
        if($deletedFlag) {
            $html .= " (deleted)";
        }
        //content_tag('a', $leaveType, array('href' => "{$baseUrl}employeeId/{$employeeId}/leaveTypeId/{$leaveTypeId}")) . "\n";
        $html .= "</td>\n";
        return $html;
    }

    /**
     * Returns Leave Entitled Column HTML String
     * @param String $leaveTypeId
     * @param int $leaveEntitled
     * @param int $rowId
     * @param int $employeeId
     * @param int $leavePeriodId
     * @param boolean $deletedFlag
     * @returns String
     */
    protected function getLeaveEntitledColumnHtml($leaveTypeId, $leaveEntitled, $rowId, $employeeId, $leavePeriodId) {
        $html = "<td align='center'>\n";

        if ($this->isLeaveTypeEditable($leaveTypeId) && $this->userType == 'Admin') {
            $html .= "<div class='textAlignRight'><input type=\"text\" name=\"txtLeaveEntitled[]\" id=\"txtLeaveEntitled-$rowId\" class=\"formInputText inputBoxRight\" value=\"$leaveEntitled\" /></div>\n";
            $html .= "<input type=\"hidden\" name=\"hdnEmpId[]\" id=\"hdnEmpId-$rowId\" value=\"$employeeId\" />\n";
            $html .= "<input type=\"hidden\" name=\"hdnLeaveTypeId[]\" id=\"hdnLeaveTypeId-$rowId\" value=\"$leaveTypeId\" />\n";
            $html .= "<input type=\"hidden\" name=\"hdnLeavePeriodId[]\" id=\"hdnLeavePeriodId-$rowId\" value=\"$leavePeriodId\" />\n";
            $html .= "<br />";
            $html .= "<div class=\"errorHolder\"></div>\n";
            $this->leaveSummaryEditMode = true;
        } else {
            $html .= "<div class='textAlignRight'>$leaveEntitled</div>\n";
        }
        $html .= "</td>\n";
        return $html;
    }

    /**
     * Returns Scheduled Column HTML String
     * @param int $leaveScheduled
     * @param int $employeeId
     * @param int $leaveTypeId
     * @returns String
     */
    protected function getScheduledColumnHtml($leaveScheduled, $employeeId, $leaveTypeId) {
        $html = "<td align='center'>\n";
        $scheduledStr = $leaveScheduled;
        if($leaveScheduled > 0) {
            $url = "viewLeaveList";
            if($employeeId == $this->empId) {
                $url = "viewMyLeaveList";
            }
            $url .= "?txtEmpID=" . $employeeId . "&leaveTypeId=" . $leaveTypeId . "&status=" . Leave::LEAVE_STATUS_LEAVE_APPROVED . "&leavePeriodId=" . $this->_getLeavePeriod();
            $scheduledStr = "<a href='" . $url . "'>" . $scheduledStr . "</a>";
        }
        $html .= "<div class='textAlignRight'>$scheduledStr</div>\n";
        $html .= "</td>\n";
        return $html;
    }

    /**
     * Returns Taken Column HTML String
     * @param int $leaveTaken
     * @param int $employeeId
     * @param int $leaveTypeId
     * @returns String
     */
    protected function getTakenColumnHtml($leaveTaken, $employeeId, $leaveTypeId) {
        $takenStr = $leaveTaken;
        if($takenStr > 0) {
            $url = "viewLeaveList";
            if($employeeId == $this->empId) {
                $url = "viewMyLeaveList";
            }
            $url .= "?txtEmpID=" . $employeeId . "&leaveTypeId=" . $leaveTypeId . "&status=" . Leave::LEAVE_STATUS_LEAVE_TAKEN . "&leavePeriodId=" . $this->_getLeavePeriod();
            $takenStr = "<a href='" . $url . "'>" .$takenStr . "</a>";
        }
        $html = "<td align='center'>\n";
        $html .= "<div class='textAlignRight'>$takenStr</div>\n";
        $html .= "</td>\n";
        return $html;
    }

    /**
     * Returns Leave Remaining Column HTML String
     * @param int $leaveRemaining
     * @returns String
     */
    protected function getLeaveRemainingColumnHtml($leaveRemaining) {
        $html = "<td align='center'>\n";
        $html .= "<div class='textAlignRight'>$leaveRemaining</div>\n";
        $html .= "</td>\n";
        $html .= "</tr>\n";
        return $html;
    }

    /**
     * Returns LeaveBroughtForward Column HTML String
     */
    protected function getLeaveBroughtForwardColumnHtml($leaveBroughtForward) {

    }

    /**
     * Returns CarriedForward Column HTML String
     * @param int $leaveBroughtForward
     */
    protected function getCarriedForwardColumnHtml($leaveCarryForward) {
        
    }

    /**
     * Is leave type editable? 
     * Always returns true in core module. Can be overridden to
     * support none editable leave types
     */
    protected function isLeaveTypeEditable($leaveTypeId) {
        return true;
    }
    
    private function _getLeaveScheduled($employeeId, $leaveTypeId, $leavePeriodId) {

        $leaveRequestService = new LeaveRequestService();
        $leaveRequestService->setLeaveRequestDao(new LeaveRequestDao());
        $scheduledSum = $leaveRequestService->getScheduledLeavesSum($employeeId, $leaveTypeId, $leavePeriodId);

        return empty($scheduledSum)?'0.00':$scheduledSum;

    }

    public function getEmployeeListAsJson() {

        $jsonArray	=	array();
        $escapeCharSet = array(38, 39, 34, 60, 61,62, 63, 64, 58, 59, 94, 96);
        $employeeService = $this->getEmployeeService();

        if ($this->userType == 'Admin') {
            $employeeList = $employeeService->getEmployeeList();
        } elseif ($this->userType == 'Supervisor') {

            $employeeList = $employeeService->getSupervisorEmployeeChain($this->loggedUserId);
            $loggedInEmployee = $employeeService->getEmployee($this->loggedUserId);
            array_push($employeeList, $loggedInEmployee);

        }
        $employeeUnique = array();
        foreach($employeeList as $employee) {
            if(!isset($employeeUnique[$employee->getEmpNumber()])) {
                $name = $employee->getFirstName() . " " . $employee->getLastName();

                foreach($escapeCharSet as $char) {
                    $name = str_replace(chr($char), (chr(92) . chr($char)), $name);
                }
                $employeeUnique[$employee->getEmpNumber()] = $name;
                array_push($jsonArray,"{name:\"".$name."\",id:\"".$employee->getEmpNumber()."\"}");
            }
        }

        array_push($jsonArray,"{name:\"All\",id:\"0\"}"); // Including All

        $jsonString = " [".implode(",",$jsonArray)."]";

        return $jsonString;

    }

    public function setPager(sfWebRequest $request) {

        if ($request->isMethod('post')) {

            if ($request->getParameter('hdnAction') == 'search') {
                $this->pageNo = 1;
            } elseif ($request->getParameter('pageNo')) {
                $this->pageNo = $request->getParameter('pageNo');
            }

        } else {
            $this->pageNo = 1;
        }


        $this->pager = new SimplePager('LeaveSummary', $this->recordsLimit);
        $this->pager->setPage($this->pageNo);
        $this->pager->setNumResults($this->recordsCount);
        $this->pager->init();
        $offset = $this->pager->getOffset();
        $offset = empty($offset)?0:$offset;
        $this->offset = $offset;

    }

    public function getLeaveSummaryRecordsCount() {

        $leaveSummaryService = $this->getLeaveSummaryService();
        $recordsCount = $leaveSummaryService->fetchRawLeaveSummaryRecordsCount($this->_getSearchClues());

        return $recordsCount;

    }

    public function getLeaveSummaryService() {
        if(is_null($this->leaveSummaryService)) {
            $this->leaveSummaryService = new LeaveSummaryService();
            $this->leaveSummaryService->setLeaveSummaryDao(new LeaveSummaryDao());
        }
        return $this->leaveSummaryService;
    }

    public function setLeaveSummaryService(LeaveSummaryService $leaveSummaryService) {
        $this->leaveSummaryService = $leaveSummaryService;
    }


    public function setLeaveEntitlementService(LeaveEntitlementService $leaveEntitlementService) {
        $this->leaveEntitlementService = $leaveEntitlementService;
    }

    public function getLeaveEntitlementService() {
        if(is_null($this->leaveEntitlementService)) {
            $this->leaveEntitlementService = new LeaveEntitlementService();
            $this->leaveEntitlementService->setLeaveEntitlementDao(new LeaveEntitlementDao());
        }
        return $this->leaveEntitlementService;
    }
    
    public function saveEntitlements($request) {

        $hdnEmpId = $request->getParameter('hdnEmpId');
        $hdnLeaveTypeId = $request->getParameter('hdnLeaveTypeId');
        $hdnLeavePeriodId = $request->getParameter('hdnLeavePeriodId');
        $txtLeaveEntitled = $request->getParameter('txtLeaveEntitled');
        $count = count($txtLeaveEntitled);

        $leaveEntitlementService = $this->getLeaveEntitlementService();

        for ($i=0; $i<$count; $i++) {

            $leaveEntitlementService->saveEmployeeLeaveEntitlement($hdnEmpId[$i], 
                $hdnLeaveTypeId[$i], $hdnLeavePeriodId[$i], $txtLeaveEntitled[$i],
                true);
            
        }

        $this->saveSuccess = true;

    }

    private function _getSearchClues() {

        if ($this->getValues()) {

            return $this->_adjustSearchClues($this->getValues());

        } else {

            $clues['cmbLeavePeriod'] = 0;
            $clues['cmbEmpId'] = 0;
            if(!is_null($this->searchParam['employeeId'])) {
                $clues['cmbEmpId'] = $this->searchParam['employeeId'];
            }

            $clues['cmbLeaveType'] = 0;
            $clues['cmbLocation'] = 0;
            $clues['cmbSubDivision'] = 0;
            $clues['cmbJobTitle'] = 0;

            return $this->_adjustSearchClues($clues);

        }

    }

    private function _adjustSearchClues($clues) {

        if ($this->userType == 'Admin') {

            $clues['userType'] = 'Admin';
            return $clues;

        } elseif ($this->userType == 'Supervisor') {

            $clues['userType'] = 'Supervisor';
            $clues['subordinates'] = $this->_getSubordinatesIds();
            return $clues;

        } else {

            $clues['userType'] = 'ESS';
            $clues['cmbEmpId'] = $this->loggedUserId;
            return $clues;

        }

    }
        
    private function _getSubordinatesList() {

        if (!empty($this->subordinatesList)) {

            return $this->subordinatesList;

        } else {

            $employeeService = new EmployeeService();
            $employeeService->setEmployeeDao(new EmployeeDao());
            $this->subordinatesList = $employeeService->getSupervisorEmployeeChain($this->loggedUserId);

            return $this->subordinatesList;

        }

    }

    private function _getSubordinatesIds() {

        $ids = array();

        foreach ($this->_getSubordinatesList() as $employee) {
        
            $ids[] = $employee->getEmpNumber();

        }

        $ids[] = $this->loggedUserId;

        return $ids;

    }

    private function _getLeavePeriod() {

        if ($this->getValue('cmbLeavePeriod')) {

            return $this->getValue('cmbLeavePeriod');
            
        } else {

            return $this->currentLeavePeriodId;

        }

    }

    private function _setCurrentLeavePeriodId() {

        $leavePeriodService = $this->getLeavePeriodService();
        $this->currentLeavePeriodId = (!$leavePeriodService->getCurrentLeavePeriod() instanceof LeavePeriod)?0:$leavePeriodService->getCurrentLeavePeriod()->getLeavePeriodId();
    }

	/**
     * Returns LeavePeriodService
	 * @return LeavePeriodService
	 */
    public function getLeavePeriodService() {
        if(is_null($this->leavePeriodService)) {
            $this->leavePeriodService = new LeavePeriodService();
            $this->leavePeriodService->setLeavePeriodDao(new LeavePeriodDao());
        }
        return $this->leavePeriodService;
    }

	/**
     * Sets LeavePeriodService
	 * @param LeavePeriodService $leavePeriodService
	 */
    public function setLeavePeriodService(LeavePeriodService $leavePeriodService) {
        $this->leavePeriodService = $leavePeriodService;
    }

}
