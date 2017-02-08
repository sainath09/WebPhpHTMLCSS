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

require_once($lan->getLangPath("full.php"));

$locRights=$_SESSION['localRights'];

$formAction="{$_SERVER['PHP_SELF']}?uniqcode={$this->getArr['uniqcode']}";
$available = $this->popArr['available'];
$fieldTypes = array(CustomFields::FIELD_TYPE_STRING => $lang_customeFields_StringType,
    CustomFields::FIELD_TYPE_SELECT => $lang_customeFields_SelectType);

$new = true;
$disabled = '';
$customField = $this->popArr['editArr'];
$extraClass = ($customField->getFieldType() == CustomFields::FIELD_TYPE_SELECT) ? "show" : "hide";

if ((isset($this->getArr['capturemode'])) && ($this->getArr['capturemode'] == 'updatemode')) {
    $formAction="{$formAction}&amp;id={$this->getArr['id']}&amp;capturemode=updatemode";
    $new = false;
    $disabled = "disabled='disabled'";
}
$tabIndex = 1;
$token = $this->popArr['token'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript" src="../../scripts/archive.js"></script>
<script type="text/javascript">
//<![CDATA[

    var editMode = <?php echo $new ? 'true' : 'false'; ?>;

    function goBack() {
        location.href = "./CentralController.php?uniqcode=<?php echo $this->getArr['uniqcode']?>&VIEW=MAIN";
    }

    function hideextra() {
        if (document.frmCustomField.cmbFieldType.value == <?php echo CustomFields::FIELD_TYPE_SELECT;?>) {
            $('selectOptions').className = 'show';
        } else {
            $('selectOptions').className = 'hide';
        }
    }

    function validate() {
        var err = false;
        var msg = '<?php echo $lang_Error_PleaseCorrectTheFollowing; ?>\n\n';

        var name = trim($('txtFieldName').value);

        if (name == '') {
            err = true;
            msg += "\t- <?php echo $lang_Admin_CustomeFields_PleaseSpecifyCustomFieldName; ?>\n";
        }

        if ($('cmbFieldType').value == <?php echo CustomFields::FIELD_TYPE_SELECT;?>) {
            if (trim($('txtExtra').value) == '') {
                err = true;
                msg += "\t- <?php echo $lang_Admin_CustomeFields_PleaseSpecifySelectOptions; ?>\n";
            }
        }

        if (err) {
            alert(msg);
            return false;
        } else {
            return true;
        }
    }

    function resetForm() {
        $('frmCustomField').reset();
        hideextra();
    }

    function edit() {

<?php if($locRights['edit']) { ?>
        if (editMode) {
            if (validate()) {
                $('frmCustomField').submit();
            }
            return;
        }
        editMode = true;
        var frm = $('frmCustomField');

        for (var i=0; i < frm.elements.length; i++) {
            frm.elements[i].disabled = false;
        }
        $('editBtn').value="<?php echo $lang_Common_Save; ?>";
        $('editBtn').title="<?php echo $lang_Common_Save; ?>";
        $('editBtn').className = "savebutton";

<?php } else {?>
        alert('<?php echo $lang_Common_AccessDenied;?>');
<?php } ?>
    }

//]]>
</script>
<script type="text/javascript" src="../../themes/<?php echo $styleSheet;?>/scripts/style.js"></script>
<link href="../../themes/<?php echo $styleSheet;?>/css/style.css" rel="stylesheet" type="text/css"/>
<!--[if lte IE 6]>
<link href="../../themes/<?php echo $styleSheet; ?>/css/IE6_style.css" rel="stylesheet" type="text/css"/>
<![endif]-->
<!--[if IE]>
<link href="../../themes/<?php echo $styleSheet; ?>/css/IE_style.css" rel="stylesheet" type="text/css"/>
<![endif]-->
</head>

<body>
    <div class="formpage">
        <div class="navigation">
            <input type="button" class="savebutton"
            onclick="goBack();" onmouseover="moverButton(this);" onmouseout="moutButton(this);"
            value="<?php echo $lang_Common_Back;?>" />
        </div>
        <div class="outerbox">
            <div class="mainHeading"><h2><?php echo $lang_customeFields_Heading;?></h2></div>

        <?php $message =  isset($this->getArr['msg']) ? $this->getArr['msg'] : (isset($this->getArr['message']) ? $this->getArr['message'] : null);
            if (isset($message)) {
                $messageType = CommonFunctions::getCssClassForMessage($message);
                $message = "lang_Common_" . $message;
        ?>
            <div class="messagebar">
                <span class="<?php echo $messageType; ?>"><?php echo (isset($$message)) ? $$message: ""; ?></span>
            </div>
        <?php } ?>

            <form name="frmCustomField" id="frmCustomField" method="post" onsubmit="return validate()" action="<?php echo $formAction;?>">
               <input type="hidden" name="token" value="<?php echo $token;?>" />
               <input type="hidden" name="sqlState" value="<?php echo $new ? 'NewRecord' : 'UpdateRecord'; ?>"/>
                <label for="txtId"><?php echo $lang_CustomFields_CustomFieldNumber; ?></label>

                <?php if ($new) { ?>
                    <select id="txtId" name="txtId" class="formSelect" <?php echo $disabled;?>
                        tabindex="<?php echo $tabIndex++;?>">
                        <?php foreach ($available as $av) {?>
                        <option value="<?php echo $av;?>"><?php echo $av;?></option>
                        <?php } ?>
                    </select>
                    <?php if (count($available) == 0) { ?>
                        <div class="fielderror"><?php echo $lang_Admin_CustomeFields_MaxCustomFieldsCreated;?></div>
                    <?php } ?>
                <?php } else { ?>
                    <input type="hidden" id="txtId" name="txtId"
                        value="<?php echo $customField->getFieldNumber(); ?>"/>
                    <span class="formValue"><?php echo $customField->getFieldNumber(); ?></span>
                <?php } ?>
                <br class="clear"/>

                <label for="txtFieldName"><?php echo $lang_customeFields_FieldName; ?><span class="required">*</span>
                </label>
                <input type="text" id="txtFieldName" name="txtFieldName" class="formInputText" <?php echo $disabled;?>
                    value="<?php echo $customField->getName(); ?>" tabindex="<?php echo $tabIndex++;?>"/>
                <br class="clear"/>

                <label for="cmbFieldType"><?php echo $lang_customeFields_Type; ?><span class="required">*</span>
                </label>
                <select name="cmbFieldType" id="cmbFieldType" class="formSelect" tabindex="<?php echo $tabIndex++;?>"
                        onchange="hideextra();" <?php echo $disabled;?>>
                    <?php foreach ($fieldTypes as $key=>$fieldType) {
                            $selected = ($customField->getFieldType() == $key)? 'selected="selected"' : '';
                    ?>
                    <option <?php echo $selected; ?> value="<?php echo $key;?>"><?php echo $fieldType;?></option>
                    <?php } ?>
                </select>
                <br class="clear"/>

                <div id="selectOptions" class="<?php echo $extraClass; ?>">
                <label for="txtExtra"><?php echo $lang_customeFields_SelectOptions; ?> <span class="required">*</span>
                </label>
                <input type="text" id="txtExtra" name="txtExtra" tabindex="<?php echo $tabIndex++;?>"
                    class="formInputText" value="<?php echo $customField->getExtraData();?>" <?php echo $disabled;?>/>
                <div class="fieldHint"><?php echo $lang_Admin_CustomeFields_SelectOptionsHint; ?></div>
                </div>
                <br class="clear"/>

                <div class="formbuttons">
<?php if($locRights['edit']) { ?>
                    <input type="button" class="<?php echo $new ? 'savebutton': 'editbutton';?>" id="editBtn"
                        onclick="edit();" tabindex="<?php echo $tabIndex++;?>"
                        onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                        value="<?php echo $new ? $lang_Common_Save : $lang_Common_Edit;?>" />
                    <input type="button" class="clearbutton" onclick="resetForm();" tabindex="<?php echo $tabIndex++;?>"
                        onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                         value="<?php echo $lang_Common_Reset;?>" />
<?php } ?>
                </div>
            </form>
        </div>
        <script type="text/javascript">
        //<![CDATA[
            if (document.getElementById && document.createElement) {
                roundBorder('outerbox');
            }
        //]]>
        </script>
        <div class="requirednotice"><?php echo preg_replace('/#star/', '<span class="required">*</span>', $lang_Commn_RequiredFieldMark); ?>.</div>
    </div>
</body>
</html>


