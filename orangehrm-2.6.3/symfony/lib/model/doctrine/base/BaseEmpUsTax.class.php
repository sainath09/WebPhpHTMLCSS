<?php

/**
 * BaseEmpUsTax
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $emp_number
 * @property integer $federal_exceptions
 * @property integer $state_exceptions
 * @property string $federal_status
 * @property string $state
 * @property string $state_status
 * @property string $unemp_state
 * @property string $work_state
 * @property Employee $Employee
 * 
 * @method integer  getEmpNumber()          Returns the current record's "emp_number" value
 * @method integer  getFederalExceptions()  Returns the current record's "federal_exceptions" value
 * @method integer  getStateExceptions()    Returns the current record's "state_exceptions" value
 * @method string   getFederalStatus()      Returns the current record's "federal_status" value
 * @method string   getState()              Returns the current record's "state" value
 * @method string   getStateStatus()        Returns the current record's "state_status" value
 * @method string   getUnempState()         Returns the current record's "unemp_state" value
 * @method string   getWorkState()          Returns the current record's "work_state" value
 * @method Employee getEmployee()           Returns the current record's "Employee" value
 * @method EmpUsTax setEmpNumber()          Sets the current record's "emp_number" value
 * @method EmpUsTax setFederalExceptions()  Sets the current record's "federal_exceptions" value
 * @method EmpUsTax setStateExceptions()    Sets the current record's "state_exceptions" value
 * @method EmpUsTax setFederalStatus()      Sets the current record's "federal_status" value
 * @method EmpUsTax setState()              Sets the current record's "state" value
 * @method EmpUsTax setStateStatus()        Sets the current record's "state_status" value
 * @method EmpUsTax setUnempState()         Sets the current record's "unemp_state" value
 * @method EmpUsTax setWorkState()          Sets the current record's "work_state" value
 * @method EmpUsTax setEmployee()           Sets the current record's "Employee" value
 * 
 * @package    orangehrm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEmpUsTax extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_emp_us_tax');
        $this->hasColumn('emp_number', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('tax_federal_exceptions as federal_exceptions', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 4,
             ));
        $this->hasColumn('tax_state_exceptions as state_exceptions', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 4,
             ));
        $this->hasColumn('tax_federal_status as federal_status', 'string', 13, array(
             'type' => 'string',
             'length' => 13,
             ));
        $this->hasColumn('tax_state as state', 'string', 13, array(
             'type' => 'string',
             'length' => 13,
             ));
        $this->hasColumn('tax_state_status as state_status', 'string', 13, array(
             'type' => 'string',
             'length' => 13,
             ));
        $this->hasColumn('tax_unemp_state as unemp_state', 'string', 13, array(
             'type' => 'string',
             'length' => 13,
             ));
        $this->hasColumn('tax_work_state as work_state', 'string', 13, array(
             'type' => 'string',
             'length' => 13,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Employee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));
    }
}