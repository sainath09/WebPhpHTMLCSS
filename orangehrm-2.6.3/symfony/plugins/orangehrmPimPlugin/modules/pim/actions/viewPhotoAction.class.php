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
/**
 * Displays Employee Photo
 *
 */
class viewPhotoAction extends sfAction {

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
    
    public function execute($request) {
        $empNumber = $request->getParameter('empNumber');

        $employeeService = $this->getEmployeeService();
        $empPicture = $employeeService->getPicture($empNumber);

        if (!empty($empPicture)) {
            $contents = $empPicture->picture;
            $contentType = $empPicture->file_type;
            $fileSize = $empPicture->size;
            $fileName = $empPicture->filename;
        } else {
            $fileName = 'default_employee_image.gif';
            $tmpName = ROOT_PATH . '/themes/beyondT/pictures/' . $fileName;
            $fp = fopen($tmpName,'r');
            $fileSize = filesize($tmpName);
            $contents = fread($fp, $fileSize);
            $contentType = "image/gif";
            fclose($fp);
        }

        $response = $this->getResponse();
        $response->addCacheControlHttpHeader('no-cache');

        $response->setContentType($contentType);
        $response->setContent($contents);
        $response->send();

        return sfView::NONE;
    }
}
?>
