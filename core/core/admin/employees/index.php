<?php

use Classes\PermissionManager;
use Dependents\Common\Model\EmployeeDependent;
use EmergencyContacts\Common\Model\EmergencyContact;
use Employees\Common\Model\Employee;
use Qualifications\Common\Model\EmployeeCertification;
use Qualifications\Common\Model\EmployeeEducation;
use Qualifications\Common\Model\EmployeeLanguage;
use Qualifications\Common\Model\EmployeeSkill;

$moduleName = 'employees';
$moduleGroup = 'admin';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
$fieldNameMap = \Classes\BaseService::getInstance()->getFieldNameMappings("Employee");
$customFields = \Classes\BaseService::getInstance()->getCustomFields("Employee");
?><div class="span9">

	<ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
        <li class="active"><a id="tabEmployee" href="#tabPageEmployee"><?=t('Employees')?></a></li>
		<li><a id="tabEmployeeSkill" href="#tabPageEmployeeSkill"><?=t('Skills')?></a></li>
		<li><a id="tabEmployeeEducation" href="#tabPageEmployeeEducation"><?=t('Education')?></a></li>
		<li><a id="tabEmployeeCertification" href="#tabPageEmployeeCertification"><?=t('Certifications')?></a></li>
		<li><a id="tabEmployeeLanguage" href="#tabPageEmployeeLanguage"><?=t('Languages')?></a></li>
		<li><a id="tabEmployeeDependent" href="#tabPageEmployeeDependent"><?=t('Dependents')?></a></li>
		<li><a id="tabEmergencyContact" href="#tabPageEmergencyContact"><?=t('Contacts')?></a></li>
        <li><a id="tabTerminatedEmployee" href="#tabPageTerminatedEmployee"><?=t('Deactivated')?></a></li>
        <li><a id="tabArchivedEmployee" href="#tabPageArchivedEmployee"><?=t('Archived')?></a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="tabPageEmployee">
			<div id="EmployeeTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="EmployeeForm"></div>
            <div id="EmployeeFilterForm"></div>
		</div>
		<div class="tab-pane" id="tabPageEmployeeSkill">
			<div id="EmployeeSkillTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
			<div id="EmployeeSkillForm"></div>
			<div id="EmployeeSkillFilterForm"></div>
		</div>
		<div class="tab-pane" id="tabPageEmployeeEducation">
			<div id="EmployeeEducationTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="EmployeeEducationForm"></div>
            <div id="EmployeeEducationFilterForm"></div>
		</div>
		<div class="tab-pane" id="tabPageEmployeeCertification">
			<div id="EmployeeCertificationTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="EmployeeCertificationForm"></div>
            <div id="EmployeeCertificationFilterForm"></div>
		</div>
		<div class="tab-pane" id="tabPageEmployeeLanguage">
			<div id="EmployeeLanguageTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="EmployeeLanguageForm"></div>
            <div id="EmployeeLanguageFilterForm"></div>
		</div>
		<div class="tab-pane" id="tabPageEmployeeDependent">
			<div id="EmployeeDependentTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="EmployeeDependentForm"></div>
            <div id="EmployeeDependentFilterForm"></div>
		</div>
		<div class="tab-pane" id="tabPageEmergencyContact">
			<div id="EmergencyContactTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="EmergencyContactForm"></div>
            <div id="EmergencyContactFilterForm"></div>
		</div>

		<div class="tab-pane" id="tabPageArchivedEmployee">
			<div id="ArchivedEmployeeTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="ArchivedEmployeeForm"></div>
            <div id="ArchivedEmployeeFilterForm"></div>
		</div>
		<div class="tab-pane" id="tabPageTerminatedEmployee">
			<div id="TerminatedEmployeeTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="TerminatedEmployeeForm"></div>
            <div id="TerminatedEmployeeFilterForm"></div>
		</div>

	</div>
</div>
<div id="dataGroup"></div>
<?php
$moduleData = [
    'user_level' => $user->user_level,
    'customFields' => $customFields,
    'permissions' => [
        'Employee' => PermissionManager::checkGeneralAccess(new Employee()),
        'EmployeeSkill' => PermissionManager::checkGeneralAccess(new EmployeeSkill()),
        'EmployeeEducation' => PermissionManager::checkGeneralAccess(new EmployeeEducation()),
        'EmployeeCertification' => PermissionManager::checkGeneralAccess(new EmployeeCertification()),
        'EmployeeLanguage' => PermissionManager::checkGeneralAccess(new EmployeeLanguage()),
        'EmployeeDependent' => PermissionManager::checkGeneralAccess(new EmployeeDependent()),
        'EmergencyContact' => PermissionManager::checkGeneralAccess(new EmergencyContact()),
    ]];
?>
<script>
var modJsList = [];
<?php if($user->user_level != "Admin"){ ?>
modJsList['tabEmployee'] = new EmployeeAdapter('Employee','Employee',{"status":"Active"});
modJsList['tabEmployee'].setShowAddNew(false);
modJsList['tabEmployee'].setShowDelete(false);
<?php }else{ ?>
modJsList['tabEmployee'] = new EmployeeAdapter('Employee','Employee',{"status":"Active"});
<?php } ?>
modJsList['tabEmployee'].setObjectTypeName('Employee');
modJsList['tabEmployee'].setModalType(EmployeeAdapter.MODAL_TYPE_STEPS);
modJsList['tabEmployee'].setDataPipe(new IceDataPipe(modJsList['tabEmployee']));
modJsList['tabEmployee'].setAccess(<?=json_encode($moduleData['permissions']['Employee'])?>);
modJsList['tabEmployee'].enableLocalStorage();
$(document).ready(() => modJsList['tabEmployee'].initForm());

modJsList['tabEmployee'].setRemoteTable(true);
modJsList['tabEmployee'].setFieldNameMap(<?=json_encode($fieldNameMap)?>);
modJsList['tabEmployee'].setCustomFields(<?=json_encode($customFields)?>);

modJsList['tabEmployeeSkill'] = new EmployeeSkillAdapter('EmployeeSkill');
modJsList['tabEmployeeSkill'].setRemoteTable(true);
modJsList['tabEmployeeSkill'].setObjectTypeName('Employee Skill');
modJsList['tabEmployeeSkill'].setDataPipe(new IceDataPipe(modJsList['tabEmployeeSkill']));
modJsList['tabEmployeeSkill'].setAccess(<?=json_encode($moduleData['permissions']['EmployeeSkill'])?>);

modJsList['tabEmployeeEducation'] = new EmployeeEducationAdapter('EmployeeEducation');
modJsList['tabEmployeeEducation'].setRemoteTable(true);
modJsList['tabEmployeeEducation'].setObjectTypeName('Employee Education');
modJsList['tabEmployeeEducation'].setDataPipe(new IceDataPipe(modJsList['tabEmployeeEducation']));
modJsList['tabEmployeeEducation'].setAccess(<?=json_encode($moduleData['permissions']['EmployeeEducation'])?>);

modJsList['tabEmployeeCertification'] = new EmployeeCertificationAdapter('EmployeeCertification');
modJsList['tabEmployeeCertification'].setRemoteTable(true);
modJsList['tabEmployeeCertification'].setObjectTypeName('Employee Certification');
modJsList['tabEmployeeCertification'].setDataPipe(new IceDataPipe(modJsList['tabEmployeeCertification']));
modJsList['tabEmployeeCertification'].setAccess(<?=json_encode($moduleData['permissions']['EmployeeCertification'])?>);

modJsList['tabEmployeeLanguage'] = new EmployeeLanguageAdapter('EmployeeLanguage');
modJsList['tabEmployeeLanguage'].setRemoteTable(true);
modJsList['tabEmployeeLanguage'].setObjectTypeName('Employee Language');
modJsList['tabEmployeeLanguage'].setDataPipe(new IceDataPipe(modJsList['tabEmployeeLanguage']));
modJsList['tabEmployeeLanguage'].setAccess(<?=json_encode($moduleData['permissions']['EmployeeLanguage'])?>);

modJsList['tabEmployeeDependent'] = new EmployeeDependentAdapter('EmployeeDependent');
modJsList['tabEmployeeDependent'].setRemoteTable(true);
modJsList['tabEmployeeDependent'].setObjectTypeName('Employee Dependent');
modJsList['tabEmployeeDependent'].setDataPipe(new IceDataPipe(modJsList['tabEmployeeDependent']));
modJsList['tabEmployeeDependent'].setAccess(<?=json_encode($moduleData['permissions']['EmployeeDependent'])?>);

modJsList['tabEmergencyContact'] = new EmergencyContactAdapter('EmergencyContact');
modJsList['tabEmergencyContact'].setRemoteTable(true);
modJsList['tabEmergencyContact'].setObjectTypeName('Emergency Contact');
modJsList['tabEmergencyContact'].setDataPipe(new IceDataPipe(modJsList['tabEmergencyContact']));
modJsList['tabEmergencyContact'].setAccess(<?=json_encode($moduleData['permissions']['EmergencyContact'])?>);

//modJsList['tabEmployeeImmigration'] = new EmployeeImmigrationAdapter('EmployeeImmigration');
//modJsList['tabEmployeeImmigration'].setRemoteTable(true);
//modJsList['tabEmployeeImmigration'].setObjectTypeName('Employee Dependent');
//modJsList['tabEmployeeImmigration'].setDataPipe(new IceDataPipe(modJsList['tabEmployeeDependent']));
//modJsList['tabEmployeeImmigration'].setAccess(<?//=json_encode($moduleData['permissions']['EmployeeDependent'])?>//);

modJsList['tabArchivedEmployee'] = new ArchivedEmployeeAdapter('ArchivedEmployee');
modJsList['tabArchivedEmployee'].setRemoteTable(true);
modJsList['tabArchivedEmployee'].setShowAddNew(false);
modJsList['tabArchivedEmployee'].setShowEdit(false);
modJsList['tabArchivedEmployee'].setObjectTypeName('Archived Employee');
modJsList['tabArchivedEmployee'].setDataPipe(new IceDataPipe(modJsList['tabArchivedEmployee']));
modJsList['tabArchivedEmployee'].setAccess(<?=json_encode($moduleData['permissions']['Employee'])?>);

modJsList['tabTerminatedEmployee'] = new TerminatedEmployeeAdapter('Employee','TerminatedEmployee',{"status":"Terminated"});
modJsList['tabTerminatedEmployee'].setRemoteTable(true);
modJsList['tabTerminatedEmployee'].setShowAddNew(false);
modJsList['tabTerminatedEmployee'].setShowEdit(false);
modJsList['tabTerminatedEmployee'].setObjectTypeName('Deactivated Employees');
modJsList['tabTerminatedEmployee'].setDataPipe(new IceDataPipe(modJsList['tabTerminatedEmployee']));
modJsList['tabTerminatedEmployee'].setAccess(<?=json_encode($moduleData['permissions']['Employee'])?>);


var modJs = modJsList['tabEmployee'];

</script>
<div class="modal" id="createUserModel" tabindex="-1" role="dialog" aria-labelledby="messageModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><li class="fa fa-times"/></button>
                <h3 style="font-size: 17px;"><?=t('Employee Saved Successfully')?></h3>
            </div>
            <div class="modal-body">
				<?=t('Employee needs a User to login to DoomeyeHRM. Do you want to create a user for this employee now?')?> <br/><br/><?=t('You can do this later through Users module if required.')?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="modJs.createUser();">Yes</button>
                <button class="btn" onclick="modJs.closeCreateUser();">No</button>
            </div>
        </div>
    </div>
</div>


<?php include APP_BASE_PATH.'footer.php';?>
