<?php

/**
 * BaseEmployeeMemberDetail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $emp_number
 * @property string $membship_code
 * @property string $membtype_code
 * @property decimal $subscription
 * @property string $ownership
 * @property timestamp $commence_date
 * @property timestamp $renewal_date
 * @property MembershipType $MembershipType
 * @property Membership $Membership
 * @property Employee $Employee
 * 
 * @method integer              getEmpNumber()      Returns the current record's "emp_number" value
 * @method string               getMembshipCode()   Returns the current record's "membship_code" value
 * @method string               getMembtypeCode()   Returns the current record's "membtype_code" value
 * @method decimal              getSubscription()   Returns the current record's "subscription" value
 * @method string               getOwnership()      Returns the current record's "ownership" value
 * @method timestamp            getCommenceDate()   Returns the current record's "commence_date" value
 * @method timestamp            getRenewalDate()    Returns the current record's "renewal_date" value
 * @method MembershipType       getMembershipType() Returns the current record's "MembershipType" value
 * @method Membership           getMembership()     Returns the current record's "Membership" value
 * @method Employee             getEmployee()       Returns the current record's "Employee" value
 * @method EmployeeMemberDetail setEmpNumber()      Sets the current record's "emp_number" value
 * @method EmployeeMemberDetail setMembshipCode()   Sets the current record's "membship_code" value
 * @method EmployeeMemberDetail setMembtypeCode()   Sets the current record's "membtype_code" value
 * @method EmployeeMemberDetail setSubscription()   Sets the current record's "subscription" value
 * @method EmployeeMemberDetail setOwnership()      Sets the current record's "ownership" value
 * @method EmployeeMemberDetail setCommenceDate()   Sets the current record's "commence_date" value
 * @method EmployeeMemberDetail setRenewalDate()    Sets the current record's "renewal_date" value
 * @method EmployeeMemberDetail setMembershipType() Sets the current record's "MembershipType" value
 * @method EmployeeMemberDetail setMembership()     Sets the current record's "Membership" value
 * @method EmployeeMemberDetail setEmployee()       Sets the current record's "Employee" value
 * 
 * @package    orangehrm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEmployeeMemberDetail extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_emp_member_detail');
        $this->hasColumn('emp_number', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('membship_code', 'string', 13, array(
             'type' => 'string',
             'primary' => true,
             'length' => 13,
             ));
        $this->hasColumn('membtype_code', 'string', 13, array(
             'type' => 'string',
             'primary' => true,
             'length' => 13,
             ));
        $this->hasColumn('ememb_subscript_amount as subscription', 'decimal', 15, array(
             'type' => 'decimal',
             'scale' => false,
             'length' => 15,
             ));
        $this->hasColumn('ememb_subscript_ownership as ownership', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('ememb_commence_date as commence_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('ememb_renewal_date as renewal_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('MembershipType', array(
             'local' => 'membtype_code',
             'foreign' => 'membtype_code'));

        $this->hasOne('Membership', array(
             'local' => 'membship_code',
             'foreign' => 'membship_code'));

        $this->hasOne('Employee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));
    }
}