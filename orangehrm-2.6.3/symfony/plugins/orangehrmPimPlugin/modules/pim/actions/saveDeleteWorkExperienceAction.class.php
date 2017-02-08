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
class saveDeleteWorkExperienceAction extends sfAction {

    private $employeeService;
    
    /**
     * Get EmployeeService
     * @returns EmployeeService
     */
    public function getEmployeeService() {
        if(is_null($this->employeeService)) {
            $this->employeeService = new EmployeeService();
            $this->employeeService->setEmployeeDao(new EmployeeDao());
        }
        return $this->employeeService;
    }

    /**
     * Set EmployeeService
     * @param EmployeeService $employeeService
     */
    public function setEmployeeService(EmployeeService $employeeService) {
        $this->employeeService = $employeeService;
    }
    
    /**
     * @param sfForm $form
     * @return
     */
    public function setWorkExperienceForm(sfForm $form) {
        if (is_null($this->workExperienceForm)) {
            $this->workExperienceForm = $form;
        }
    }
    
    public function execute($request) {

        $experience = $request->getParameter('experience');
        $empNumber = (isset($experience['emp_number']))?$experience['emp_number']:$request->getParameter('empNumber');

        $this->setWorkExperienceForm(new WorkExperienceForm(array(), array('empNumber' => $empNumber), true));

        //this is to save work experience
        if ($request->isMethod('post') && $request->getParameter('option') == "save") {

            $this->workExperienceForm->bind($request->getParameter($this->workExperienceForm->getName()));

            if ($this->workExperienceForm->isValid()) {
                
                $workExperience = $this->getWorkExperience($this->workExperienceForm);
                $this->getEmployeeService()->saveWorkExperience($workExperience);
                $this->getUser()->setFlash('templateMessage', array('success', __('Work Experience Details Saved Successfully')));
                $this->redirect('pim/viewQualifications?empNumber='. $empNumber);
            }
        }

        //this is to delete work experience
        if ($request->isMethod('post') && $request->getParameter('option') == "delete") {
            $deleteIds = $request->getParameter('delWorkExp');
            
            if(count($deleteIds) > 0) {
                $this->getEmployeeService()->deleteWorkExperience($empNumber, $request->getParameter('delWorkExp'));
                $this->getUser()->setFlash('templateMessage', array('success', __('Work Experience(s) Deleted Successfully')));
            }
            $this->redirect('pim/viewQualifications?empNumber='. $empNumber);
            
        }
    }

    private function getWorkExperience(sfForm $form) {

        $post = $form->getValues();

        $workExperience = $this->getEmployeeService()->getWorkExperience($post['emp_number'], $post['seqno']);

        if(!$workExperience instanceof EmpWorkExperience) {
            $workExperience = new EmpWorkExperience();
        }

        $workExperience->emp_number = $post['emp_number'];
        $workExperience->seqno = $post['seqno'];
        $workExperience->employer = $post['employer'];
        $workExperience->jobtitle = $post['jobtitle'];
        $workExperience->from_date = $post['from_date'];
        $workExperience->to_date = $post['to_date'];
        $workExperience->comments = $post['comments'];

        return $workExperience;
    }
}
?>