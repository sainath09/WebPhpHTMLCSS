<?php
/*
 *
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
class LeaveSummaryDao extends BaseDao {

    private static $doneSyncingLeaveEntitlements = false;

    public function __construct() {
    }

    /**
     * Get Leave Type list
     * @return LeaveType Collection
     */
    /*public function getLeaveTypeList(){
		try {
            	$q = Doctrine_Query::create()
			    ->from('LeaveType lt')
			    ->where('lt.availableFlag = 1')
			    ->orderBy('lt.leaveTypeId');
			    
			$leaveTypeList	=	$q->execute();
			
			return $leaveTypeList ;
		
        } catch( Exception $e) {
            throw new DaoException( $e->getMessage());
        }
	}*/

    public function fetchRawLeaveSummaryRecords($clues, $offset=0, $limit=20) {
        
        $q = "SELECT a.emp_number AS empNumber, a.emp_firstname AS empFirstName,
              a.emp_lastname AS empLastName, b.leave_type_id AS leaveTypeId,
              b.leave_type_name AS leaveTypeName, b.available_flag AS availableFlag FROM
              (hs_hr_employee a, hs_hr_leavetype b)";

        if (!empty($clues['cmbLocation'])) {
            $q .= " LEFT JOIN hs_hr_emp_locations c ON a.emp_number = c.emp_number";
        }

        $where = array();

        if (!empty($clues['cmbEmpId'])) {
            $where[] = "a.emp_number = '{$clues['cmbEmpId']}'";
        } elseif ($clues['userType'] == 'Supervisor') {
            $where[] = "a.emp_number IN(".implode(",", $clues['subordinates']).")";
        }

        if (!empty($clues['cmbLeaveType'])) {
            $where[] = "b.leave_type_id = '{$clues['cmbLeaveType']}'";
        }

        if (!empty($clues['cmbSubDivision'])) {
            $where[] = "a.work_station = '{$clues['cmbSubDivision']}'";
        }

        if (!empty($clues['cmbJobTitle'])) {
            $where[] = "a.job_title_code = '{$clues['cmbJobTitle']}'";
        }

        if (!empty($clues['cmbLocation'])) {
            $where[] = "c.loc_code = '{$clues['cmbLocation']}'";
        }

        //$where[] = "b.available_flag = 1";
        if(count($where) > 0) {
            $q .= ' WHERE '.implode(' AND ',$where);
        }

        $q .= " ORDER By a.emp_number, b.leave_type_id";

        $limitArray = array(20, 50, 100, 200);

        if (!in_array($limit, $limitArray)) {
            $limit = 20;
        }

        $q .= " LIMIT $offset,$limit";

        $pdo = Doctrine_Manager::connection()->getDbh();
        $res = $pdo->query($q);
        
        return $res;

    }

    public function fetchRawLeaveSummaryRecordsCount($clues) {

        $q = "SELECT COUNT(*) FROM (hs_hr_employee a, hs_hr_leavetype b)";

        if (!empty($clues['cmbLocation'])) {
            $q .= " LEFT JOIN hs_hr_emp_locations c ON a.emp_number = c.emp_number";
        }

        $where = array();

        if (!empty($clues['cmbEmpId'])) {
            $where[] = "a.emp_number = '{$clues['cmbEmpId']}'";
        } elseif ($clues['userType'] == 'Supervisor') {
            $where[] = "a.emp_number IN(".implode(",", $clues['subordinates']).")";
        }

        if (!empty($clues['cmbLeaveType'])) {
            $where[] = "b.leave_type_id = '{$clues['cmbLeaveType']}'";
        }

        if (!empty($clues['cmbSubDivision'])) {
            $where[] = "a.work_station = '{$clues['cmbSubDivision']}'";
        }

        if (!empty($clues['cmbJobTitle'])) {
            $where[] = "a.job_title_code = '{$clues['cmbJobTitle']}'";
        }

        if (!empty($clues['cmbLocation'])) {
            $where[] = "c.loc_code = '{$clues['cmbLocation']}'";
        }

        //$where[] = "b.available_flag = 1";
        if(count($where) > 0) {
            $q .= ' WHERE '.implode(' AND ',$where);
        }

        $pdo = Doctrine_Manager::connection()->getDbh();
        $res = $pdo->query($q);
        
        $row = $res->fetch();

        return $row[0];

    }

}