<?php

/**
 * BaseMembership
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $membship_code
 * @property string $membtype_code
 * @property string $membship_name
 * @property MembershipType $MembershipType
 * @property Doctrine_Collection $EmployeeMemberDetail
 * 
 * @method string              getMembshipCode()         Returns the current record's "membship_code" value
 * @method string              getMembtypeCode()         Returns the current record's "membtype_code" value
 * @method string              getMembshipName()         Returns the current record's "membship_name" value
 * @method MembershipType      getMembershipType()       Returns the current record's "MembershipType" value
 * @method Doctrine_Collection getEmployeeMemberDetail() Returns the current record's "EmployeeMemberDetail" collection
 * @method Membership          setMembshipCode()         Sets the current record's "membship_code" value
 * @method Membership          setMembtypeCode()         Sets the current record's "membtype_code" value
 * @method Membership          setMembshipName()         Sets the current record's "membship_name" value
 * @method Membership          setMembershipType()       Sets the current record's "MembershipType" value
 * @method Membership          setEmployeeMemberDetail() Sets the current record's "EmployeeMemberDetail" collection
 * 
 * @package    orangehrm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMembership extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_membership');
        $this->hasColumn('membship_code', 'string', 13, array(
             'type' => 'string',
             'primary' => true,
             'length' => 13,
             ));
        $this->hasColumn('membtype_code', 'string', 13, array(
             'type' => 'string',
             'length' => 13,
             ));
        $this->hasColumn('membship_name', 'string', 120, array(
             'type' => 'string',
             'length' => 120,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('MembershipType', array(
             'local' => 'membtype_code',
             'foreign' => 'membtype_code'));

        $this->hasMany('EmployeeMemberDetail', array(
             'local' => 'membship_code',
             'foreign' => 'membship_code'));
    }
}