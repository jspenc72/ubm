<?php
// Active Model UUID
$activeModelUUID = $_GET['activeModelUUID'];
//Application Authentication Variables
 $aname = $_GET['appname'];				//Name of the application using the API
 $key = $_GET['key'];					//Application Security Key issued by BMCL
//UBM Single Sign on Authentication
 $username = $_GET['username'];
 $usrpasswd = $_GET['password']; 
 $usrname = 	$_GET['username'];
 $usremail = $_GET['email'];

//UBM User Application Preferences
 $carrier = $_GET['carrier']; 			//Wireless carrier, e.g. Verizon, Sprint, AT&T
 $phoneNumber = $_GET['phoneNumber'];	//User phone phone number
//UBM Geolocation Variables
 $lat = $_GET['lat'];					//Latitude
 $lng = $_GET['lng'];					//Longitude
//UBM Application Page Referencing Variables
 $pageid = $_GET['pageid'];				//The page ID that is displayed to the users at the top right corner of the app 

//UBM Change Request Variables Create New Feedback
 $reviewermemberid = $_GET['reviewermemberid'];
 $resolutionexplanation = $_GET['resolutionexplanation']; 
 $resolution = $_GET['resolution']; 
 $ubmchangerequestid = $_GET['ubmchangerequestid'];    
 
//UBM Change Request Variables Create New Request
 $ccode = $_GET['ccode']; 
 $datesubmitted = $_GET['datesubmitted']; 
 $ubmversion = $_GET['ubmversion']; 
 $contactphone = $_GET['contactphone'];
 $contactemail = $_GET['contactemail']; 
 $ubmrefmodel = $_GET['ubmrefmodel']; 
 $bmrefmodel = $_GET['bmrefmodel']; 
 $description = $_GET['description']; 
 $status = $_GET['status'];  
//UBM Change Request Variables Select all Feedback
 $openitemid = $_GET['openitemid'];
//UBM MCS add user to model
 $memberRole = $_GET['memberRole'];
 $inviteUsername = $_GET['inviteUsername'];
 $inviteEmail = $_GET['inviteEmail']; 
//UBM API Variables
 $RQType = $_GET['RQType'];				//Request type INSERT, UPDATE, DELETE, CREATE This may no longer be necessary because the name of the php script that is accessed is stored in the log.


//UBM MCS Model Variables
$activeModelId = $_GET['activeModelId'];

//UBM MCS Create Model Variables
$reference = $_GET['reference'];

$descritpion = $_GET['description'];
$creator_id= $_GET['creator_id'];
//Non Heirarchy Object Variables
	//UBM MCS Model Add Alternative
$alternativeDescription = $_GET['alternativeDescription'];
$alternativeDecision = $_GET['alternativeDecision'];
	//UBM MCS Model Add CoreValue
$activeCoreValueId = $_GET['activeCoreValueId'];
	//UBM MCS Model Add Customer
$activeCustomerId = $_GET['activeCustomerId'];
	//UBM MCS Model Add Feature
$activeFeatureId = $_GET['activeFeatureId'];
	//UBM MCS Model Add JobDescription
$activeJobDescriptionId = $_GET['activeJobDescriptionId'];
$activeJobDescriptionUUID = $_GET['activeJobDescriptionUUID'];
	//UBM MCS Model Add OrganizationalStructure
$organizationalStructureId = $_GET['organizationalStructureId'];
	//UBM MCS Model Add PhysicalFacility
$activePhysicalFacilityId = $_GET['activePhysicalFacilityId'];
	//UBM MCS Model Add Policy
$activePolicyId = $_GET['activePolicyId'];
	//UBM MCS Model Add Position
$activeModelId = $_GET['activeModelId'];
$activePositionId = $_GET['activePositionId'];
$positionReportsTo = $_GET['positionReportsTo'];
	//UBM MCS Model Add Procedure
$activeProcedureId = $_GET['activeProcedureId'];
	//UBM MCS Model Add Product
$activeProductId = $_GET['activeProductId'];
	//UBM MCS Model Add RequestedApplication
$activeRequestedApplicationId = $_GET['activeRequestedApplicationId'];
	//UBM MCS Model Add Service
$activeServiceId = $_GET['activeServiceId'];
	//UBM MCS Model Add Step
$activeStepId = $_GET['activeStepId'];
	//UBM MCS Model Add StrategicAlliance
$activeStrategicAllianceId = $_GET['activeStrategicAllianceId'];
	//UBM MCS Model Add StrategicPositioning
$activeStrategicPositioningId = $_GET['activeStrategicPositioningId'];
	//UBM MCS Model Add SwotAnalysis
$activeSwotAnalysisVariableId = $_GET['activeSwotAnalysisVariableId'];
	//UBM MCS Model Add Task
$activeTaskId = $_GET['activeTaskId'];						
//Heirarchy Object Variables
	//UBM MCS Model Add Policy
	//UBM MCS Model Add Position
	//UBM MCS Model Create Position
$activeModelId = $_GET['activeModelId'];
$positionDescription = $_GET['positionDescription'];
$positionSummary = $_GET['positionSummary'];
$positionPayRangeLow = $_GET['positionPayRangeLow'];
$positionPayRangeHigh = $_GET['positionPayRangeHigh'];
$positionTitle = $_GET['positionTitle'];
$positionReportsTo = $_GET['positionReportsTo'];
$positionParent = $_GET['positionParent'];
	//UBM MCS Model Create JobDescription
$activeModelId = $_GET['activeModelId'];
$objective = $_GET['objective'];

$dutiesAndResponsibilities = $_GET['dutiesAndResponsibilities'];
$positionId = $_GET['positionId'];
$qualifications = $_GET['qualifications'];
$ageRequirement = $_GET['ageRequirement'];
$educationRequirement = $_GET['educationRequirement'];
$physicalDemand = $_GET['physicalDemand'];
$workEnvironment = $_GET['workEnviroment'];
	//UBM MCS Model Create Policy
$activeModelId = $_GET['activeModelId'];
$description = $_GET['description'];

$purpose = $_GET['purpose'];
$scope = $_GET['scope'];
$type = $_GET['type'];
$jobDescriptionId = $_GET['jobDescriptionId'];
	//UBM MCS Model Create Procedure
$activeModelId = $_GET['activeModelId'];
$description = $_GET['description'];

$purpose = $_GET['purpose'];
$scope = $_GET['scope'];
$effectiveDate = $_GET['effectiveDate'];
$policyId = $_GET['policyId'];
	//UBM MCS Model Create Step
$activeModelId = $_GET['activeModelId'];

$description = $_GET['description'];
$stepNumber = $_GET['stepNumber'];
$instruction = $_GET['instruction'];
$procedureId = $_GET['procedureId'];
	//UBM MCS Model Create Task
$activeModelId = $_GET['activeModelId'];
$modelTitle = $_GET['modelTitle'];
$taskNumber = $_GET['taskNumber'];
$reference = $_GET['reference'];
$instruction = $_GET['instruction'];
$stepId = $_GET['stepId'];
	//UBM MCS Model Remove Position
$activeModelId = $_GET['activeModelId'];
$activePositionId = $_GET['activePositionId'];
$activeJobDescriptionId = $_GET['activeJobDescriptionId'];
$activePolicyId = $_GET['activePolicyId'];
$activeProcedureId = $_GET['activeProcedureId'];
$activeStepId = $_GET['activeStepId'];
$activeTaskId = $_GET['activeTaskId'];
	//UBM MCS Model Remove JobDescription
$activeModelId = $_GET['activeModelId'];
$activePositionId = $_GET['activePositionId'];
$activeJobDescriptionId = $_GET['activeJobDescriptionId'];
$activePolicyId = $_GET['activePolicyId'];
$activeProcedureId = $_GET['activeProcedureId'];
$activeStepId = $_GET['activeStepId'];
$activeTaskId = $_GET['activeTaskId'];
	//UBM MCS Model Remove Policy
$activeModelId = $_GET['activeModelId'];
$activePositionId = $_GET['activePositionId'];
$activeJobDescriptionId = $_GET['activeJobDescriptionId'];
$activePolicyId = $_GET['activePolicyId'];
$activeProcedureId = $_GET['activeProcedureId'];
$activeStepId = $_GET['activeStepId'];
$activeTaskId = $_GET['activeTaskId'];
	//UBM MCS Model Remove Procedure
$activeModelId = $_GET['activeModelId'];
$activePositionId = $_GET['activePositionId'];
$activeJobDescriptionId = $_GET['activeJobDescriptionId'];
$activePolicyId = $_GET['activePolicyId'];
$activeProcedureId = $_GET['activeProcedureId'];
$activeStepId = $_GET['activeStepId'];
$activeTaskId = $_GET['activeTaskId'];
	//UBM MCS Model Remove Step
$activeModelId = $_GET['activeModelId'];
$activePositionId = $_GET['activePositionId'];
$activeJobDescriptionId = $_GET['activeJobDescriptionId'];
$activePolicyId = $_GET['activePolicyId'];
$activeProcedureId = $_GET['activeProcedureId'];
$activeStepId = $_GET['activeStepId'];
$activeTaskId = $_GET['activeTaskId'];
	//UBM MCS Model Remove Task
$activeModelId = $_GET['activeModelId'];
$activePositionId = $_GET['activePositionId'];
$activeJobDescriptionId = $_GET['activeJobDescriptionId'];
$activePolicyId = $_GET['activePolicyId'];
$activeProcedureId = $_GET['activeProcedureId'];
$activeStepId = $_GET['activeStepId'];
$activeTaskId = $_GET['activeTaskId'];

//UBM MODELCREATION SUITE CHECKLIST Step 4
 $activeModelId = $_GET['activeModelId']; 
 $modelOwnerLegalEntity = $_GET['modelOwnerLegalEntity']; 
 $modelOwnerCCODE = $_GET['modelOwnerCCODE']; 
 $modelContactName = $_GET['modelContactName']; 
 $modelContactPhone = $_GET['modelContactPhone']; 
 $modelContactEmail = $_GET['modelContactEmail']; 
 $modelPurpose = $_GET['modelPurpose']; 
 $modelScope = $_GET['modelScope']; 
 $catBusiness = $_GET['catBusiness']; 
 $catEducation = $_GET['catEducation']; 
 $catFamily = $_GET['catFamily']; 
 $catHealth = $_GET['catHealth']; 
 $catMedical = $_GET['catMedical']; 
 $catProductivity = $_GET['catProductivity']; 
 $catUtility = $_GET['catUtility']; 
 $catChurch = $_GET['catChurch']; 
 $catCoop = $_GET['catCoop']; 
 $catOther = $_GET['catOther']; 
 //UBM MODELCREATION SUITE CHECKLIST Step 17
 $activeModelId = $_GET['activeModelId']; 
 $conceptualDefinition = $_GET['conceptualDefinition']; 
 $missionStatement = $_GET['missionStatement']; 
 $visionStatement = $_GET['visionStatement']; 
 
//UBM MODELCREATION SUITE CHECKLIST SUBMIT PREPARED BY
 $taskId = $_GET['taskId'];
 $startTime = $_GET['startTime'];
 
 //User Register
 
 //UBM MODELCREATION SUITE ORG CHART
 $activeModelOwnersUUID = $_GET['activeModelOwnersUUID'];
 
 // Get Users With Access
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $username = $_GET['username'];
 $usrpasswd = $_GET['password'];
 $activeModelId = $_GET['activeModelId'];
 //Remove User From Model
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $username = $_GET['username'];
 $usrpasswd = $_GET['password'];
 $selectedUser = $_GET['selectedUserId'];
 //Remove Strategic Alliance
 $activeModelId = $_GET['activeModelId'];
 $activeStrategicAllianceId = $_GET['activeStrategicAllianceId'];
 
 //Remove Core Value
 $activeModelId = $_GET['activeModelId'];
 $activeCoreValueId = $_GET['activeCoreValueId'];
 
 //Remove Customer
 $activeModelId = $_GET['activeModelId'];
 $activeCustomerId = $_GET['activeCustomerId'];
 
 //Remove Product
 $activeModelId = $_GET['activeModelId'];
 $activeProductId = $_GET['activeProductId'];
 //Remove Service 
 $activeModelId = $_GET['activeModelId'];
 $activeServiceId = $_GET['activeServiceId'];
 
 //Create Product
$productTitle = $_GET['productTitle'];
$activeModelId = $_GET['activeModelId'];

//Create Product
$activeModelId = $_GET['activeModelId'];
$alternativeDescription = $_GET['alternativeDescription'];
$alternativeDecision = $_GET['alternativeDecision'];
 
 //create core value
 $title = $_GET['coreValueTitle'];
$summary = $_GET['coreValueSummary'];
$activeModelUUID = $_GET['activeModelUUID'];

// Create Customer
$name = $_GET['customerName'];
$activeModelId = $_GET['activeModelId'];
//Create Feature
$featureDescription = $_GET['featureDescription'];
$featureTitle = $_GET['featureTitle'];
$activeModelId = $_GET['activeModelId'];
//Create Physical Facility
$physicalFacilityTitle = $_GET['physicalFacilityTitle'];
$physicalFacilityAssociatedCost = $_GET['physicalFacilityAssociatedCost'];
$activeModelId = $_GET['activeModelId'];
 
// Create Services
$service = $_GET['serviceTitle'];
$activeModelId = $_GET['activeModelId'];
 
 // Create Strategic Alliance
 $strategicAllianceComment = $_GET['strategicAllianceComment'];
$strategicAllianceDescription = $_GET['strategicAllianceDescription'];
$activeModelId = $_GET['activeModelId'];
// Create Strategic positioning questions
$strategicPosistion = $_GET['strategicPosistionQuestion'];
$activeModelId = $_GET['activeModelId'];
// Add alternative
$activeAlternativeId = $_GET['activeAlternativeId'];

//Remove Alternative
$activeModelId = $_GET['activeModelId'];
$activeAlternativeId = $_GET['activeAlternativeId'];

//Remove Feature
$activeModelId = $_GET['activeModelId'];
$activeFeatureId = $_GET['activeFeatureId'];
//Remove Physical Facility
$activeModelId = $_GET['activeModelId'];
$activePhysicalFacilityId = $_GET['activePhysicalFacilityId'];

//Remove StrategicPosistioning
$activeModelId = $_GET['activeModelId'];
$activeStrategicPositioningId = $_GET['activeStrategicPositioningId'];
//remove organizational Structure
$activeModelUUID = $_GET['activeModelUUID'];
$activeOrganizationalStructureId = $_GET['activeOrganizationalStructureId'];
//Remove Physical Facility
$activePhysicalFacilitiesId = $_GET['activePhysicalFacilityId'];

//Create Organizational Structure
$OrganizationalStructureTitle = $_GET['organizationalStructureTitle'];
$organizationalStructureTitleReportsTo = $_GET['organizationalStructureTitleReportsTo'];
$activeModelId = $_GET['activeModelId'];

//Get risks
$activeModelAlternativeId = $_GET['activeModelAlternativeId'];
//Get Investments
$activeModelAlternativeId = $_GET['activeModelAlternativeId'];
// Count Phases
$activePhaseId = $_GET['activePhaseId'];
//Get Child Elements
$activeModelId = $_GET['activeModelId'];
$activeObjectUUID = $_GET['activeObjectUUID'];

//updateSubtree
$fromTargetObject = $_GET['fromTargetObject'];
$toTargetObject = $_GET['toTargetObject'];
$SelectedAction = $_GET['SelectedAction'];

// ubms add
$activePolicyUUID = $_GET['activePolicyUUID'];
$activeProcedureUUID = $_GET['activeProcedureUUID'];
$activeStepUUID = $_GET['activeStepUUID'];
$activePositionUUID = $_GET['activePositionUUID'];

// ubms remove
$activeAncestorUUID = $_GET['activeAncestorUUID'];
$activeDescendantUUID = $_GET['activeDescendantUUID'];

//object detail
$activeUUID = $_GET['activeUUID'];

//create alternative pro
$activeModelId = $_GET['activeModelId'];
$activeModelAlternativeId = $_GET['activeModelAlternativeId'];
$alternativeProDescription = $_GET['alternativeProDescription'];
$alternativeProROIRef = $_GET['alternativeProROIRef'];
$alternativeProHighBenefit = $_GET['alternativeProHighBenefit'];
$alternativeProLowBenefit = $_GET['alternativeProLowBenefit'];

//create alternative con
$activeModelId = $_GET['activeModelId'];
$activeModelAlternativeId = $_GET['activeModelAlternativeId'];
$alternativeConDescription = $_GET['alternativeConDescription'];
$alternativeConROIRef = $_GET['alternativeConROIRef'];
$alternativeConHighCost = $_GET['alternativeConHighCost'];
$alternativeConLowCost = $_GET['alternativeConLowCost'];

//all alternative stuff that has not been added
$activeAlternative = $_GET['activeModelAlternativeId'];
$activeAlternativeRisk = $_GET['activeModelAlternativeRiskId'];
$activeAlternativeId = $_GET['activeAlternativeId'];
$description = $_GET['description'];
$title = $_GET['title'];
$type = $_GET['type'];
$riskDescription = $_GET['riskDescription'];
$riskCategory = $_GET['riskCategory'];
$activeModelAlternativeId = $_GET['activeModelAlternativeId'];
$activeModelId = $_GET['activeModelId'];
$activeModelAlternativeId = $_GET['activeModelAlternativeId'];
$activeAlternativeId = $_GET['activeAlternativeId'];
$activeInvestmentId = $_GET['activeInvestmentId'];
$activeModelId = $_GET['activeModelId'];
$activeAlternativeId = $_GET['activeAlternativeId'];
$activeRiskId = $_GET['activeRiskId'];

//all investment stuff that has not been added
$activeInvestmentId = $_GET['activeInvestmentId'];
$costPerUnit = $_GET['costPerUnit'];
$description = $_GET['description'];
$numberOfUnits = $_GET['numberOfUnits'];
$totalCost = $_GET['totalCost'];
$activeModelInvestmentId = $_GET['activeModelInvestmentId'];
$activeModelInvestmentId = $_GET['activeModelInvestmentId'];
$activeInvestmentId = $_GET['activeInvestmentId'];
$activeCostDriverId = $_GET['activeCostDriverId'];
$activeInvestmentId = $_GET['activeInvestmentId'];
$activeIncomeDriverId = $_GET['activeIncomeDriverId'];
$activeInvestmentId = $_GET['activeInvestmentId'];
$incomePerUnit = $_GET['incomePerUnit'];
$description = $_GET['description'];
$numberOfUnits = $_GET['numberOfUnits'];
$totalIncome = $_GET['totalIncome'];
$activeModelAlternativeId = $_GET['activeModelAlternativeId'];

//alternative add risk
$activeAlternative = $_GET['activeModelAlternativeId'];
$activeAlternativeRisk = $_GET['activeModelAlternativeRiskId'];
$investmentTitle = $_GET['investmentTitle'];

//Add Owner Name

$activeOwnerUUID = $_GET['activeOwnerUUID'];
$percentOwned = $_GET['percentOwned'];
$ownerName = $_GET['ownerName'];
$ownerNameId = $_GET['ownerNameId'];
$email = $_GET['email'];
$positionName = $_GET['positionName'];
$activePositionUUID = $_GET['activePositionUUID'];
$positionNameId = $_GET['positionNameId'];

$email = $_GET['email'];
$name = $_GET['name'];
$positionNameId = $_GET['positionNameId'];

$email = $_GET['email'];
$hash = $_GET['activationCode'];
$password = $_GET['password'];

//Product Creation Suite
$productSource = $_GET['productSource'];
//get current view
$activePositionId = $_GET['activePositionId'];
$activeJobDescriptionId = $_GET['activeJobDescriptionId'];
$activePolicyId = $_GET['activePolicyId'];
$activeProcedureId = $_GET['activeProcedureId'];
// Change Password
$newPassword = $_GET['password'];
$activeInvestment = $_GET['activeInvestment'];
$activeModelInvestmentId = $_GET['activeModelInvestmentId'];
$activeInvestmentId = $_GET['activeInvestmentId'];
$activeRiskId = $_GET['activeRiskId'];

//Submit Open Item
 $OpenItem_formref = $_GET['formref'];
 $OpenItem_priority = $_GET['priority'];
 $OpenItem_actionrequired = $_GET['actionrequired'];
 $OpenItem_assignedto = $_GET['assignedto'];
 $OpenItem_duedate = $_GET['duedate'];
 $username = $_GET['username'];

// agreements
$licenseAgreementSetup = $_GET['licenseAgreementSetup'];
$termsOfService = $_GET['termsOfService'];
$licenseAgreementSignIn = $_GET['licenseAgreementSignIn'];

//ubms reg
$aname = $_GET['appname'];
$RQType = $_GET['RQType'];
$usremail = $_GET['email'];
$usrpasswd = $_GET['password']; 
$usrname = $_GET['username']; 
$licenseAgreement = $_GET['licenseAgreement']; 
$termsOfService = $_GET['termsOfService']; 

//getwalkthroughstatus
$pageName = $_GET['pageName']; 
$actionRequired = $_GET['actionRequired']; 

//edit model information
$modelTitle = $_GET['modelTitle']; 
$modelReference = $_GET['modelReference']; 
$modelDescription = $_GET['modelDescription']; 
$stepOrder = $_GET['stepOrder']; 
$taskOrder = $_GET['taskOrder']; 