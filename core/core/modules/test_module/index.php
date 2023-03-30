<?php
/*
 Copyright (c) 2018 [Glacies UG, Berlin, Germany] (http://glacies.de)
 Developer: Thilina Hasantha (http://lk.linkedin.com/in/thilinah | https://github.com/thilinah)
 */

$moduleName = 'test_module';
$moduleGroup = 'modules';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
?><div class="span9">

	<ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
		<li class="active"><a id="tabEmployeeSalary" href="#tabPageEmployeeSalary"><?=t('Salary')?></a></li>
		<li><a id="tabTestTab" href="#tabPageTestTab"><?=t('TestTab')?></a></li>
	</ul>
	

	<div class="tab-content">
		<div class="tab-pane active" id="tabPageEmployeeSalary">
			<div id="EmployeeSalary" class="reviewBlock" data-content="List" style="padding-left:5px;">

			</div>
			<div id="EmployeeSalaryForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">

			</div>
		</div>

		<div class="tab-pane" id="tabPageTestTab">
			<p  class="reviewBlock">123</p>

		</div>
	</div>

</div>
<script>
var modJsList = new Array();

modJsList['tabEmployeeSalary'] = new EmployeeSalaryAdapter('EmployeeSalary');

<?php if(isset($modulePermissions['perm']['Add Salary']) && $modulePermissions['perm']['Add Salary'] == "No"){?>
modJsList['tabEmployeeSalary'].setShowAddNew(true);
<?php }?>
<?php if(isset($modulePermissions['perm']['Delete Salary']) && $modulePermissions['perm']['Delete Salary'] == "No"){?>
modJsList['tabEmployeeSalary'].setShowDelete(true);
<?php }?>
<?php if(isset($modulePermissions['perm']['Edit Salary']) && $modulePermissions['perm']['Edit Salary'] == "No"){?>
modJsList['tabEmployeeSalary'].setShowEdit(true);
<?php }?>

var modJs = modJsList['tabEmployeeSalary'];

</script>
<?php include APP_BASE_PATH.'footer.php';?>
