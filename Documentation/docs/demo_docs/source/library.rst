.. This is a comment. Note how any initial comments are moved by
   transforms to after the document title, subtitle, and docinfo.


=======
Library
=======

.. meta::
   :keywords: javascript, css, library, functions
   :description lang=en: A Library that contains all of the JavaScript and CSS
   for the UBM app.

.. contents:: Table of Contents
.. section-numbering::

JavaScript
==========

activation.js
--------------

sendActivationEmail()
~~~~~~~~~~~~~~~~~~~~~

	Sends the activation email to the email address specified. This script is used in the verify account page.

agreement.js
--------------

agreeToLicenseAgreement()
~~~~~~~~~~~~~~~~~~~~~~~~~

	Submits a 1 when the user agrees to the license agreement on the setup phase. Sets the prepared by button to prepared.

alternative.js
--------------

newLowSum()
~~~~~~~~~~~

	Calculates the Sum of the Low Annual Expected ROI Costs and Benefits.

newHighSum()
~~~~~~~~~~~


	Calculates the Sum of the High Annual Expected ROI Costs and Benefits.

setActiveAlternativePro()
~~~~~~~~~~~~~~~~~~~~~~~~~


	Sets window.activeModelAlternativeProId equal to the activeModelAlternativeProId.

setActiveAlternativeCon()
~~~~~~~~~~~~~~~~~~~~~~~~~

	Sets window.activeModelAlternativeConId equal to the activeModelAlternativeConId.

setActiveAlternative()
~~~~~~~~~~~~~~~~~~~~~~


	Sets window.activeModelAlternativeId equal to activeModelAlternativeId.

	Calls:

	getActiveAlternativeListofPros()

	getActiveAlternativeListofCons()

	getActiveAlternativeListofRisks()

getMyModelsListofAlternatives()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	Gets the chosen models alternatives and appends them to the alternatives table.

getActiveAlternativeListofPros()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	Gets the chosen model list of pros and appends them to the pros table.

getActiveAlternativeListofCons()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	Gets the chosen model list of cons and appends them to the cons table.


createNewAlternative()
~~~~~~~~~~~~~~~~~~~~~~


	Creates a new alternative and adds it to the database.

createNewProforactiveModelAlternative()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	Creates a new pro for the chosen alternative and adds it to the database.

createNewConforactiveModelAlternative()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	Creates a new con for the chosen alternative and adds it to the database.

removeAlternativefromModel()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	Removes the chosen alternative from the chosen model.

saveAlternativeAnalysis()
~~~~~~~~~~~~~~~~~~~~~~~~~

	Displays a tost.

checkConnection.js
------------------

checkConnection()
~~~~~~~~~~~~~~~~~

	Checks the type of network the user is on.

getPosition()
~~~~~~~~~~~~~

	If the user has GPS this will get the users location.

checkEmail.js
-------------

checkEmail()
~~~~~~~~~~~~

	Checks if the email entered is a valid email address. (Obsolete)

corevalue.js
------------

setActiveCoreValueId(activeCoreValueId)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Takes in the active core value id and sets it as a window variable.

getMyModelsCoreValues()
~~~~~~~~~~~~~~~~~~~~~~~

	Gets the current models core values and appends them to the core values unordered list. Appends the create new core value and add new core value buttons.

getListofPossibleCoreValues()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Pulls all Core Values from the database for the add core values button.

addCoreValueToMyModel(coreValueId)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Takes in the coreValueId when the user chooses a core value from the UBM repository to add to the chosen model. The core value is added to the model.

createNewCoreValueAddtoMyModel()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Allows the user to create a new core value to add to the UBM repository. The core value is added to the ubm repository and the chosen model.

removeCorevalueFromMyModel()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Allows the user to remove a core value from the chosen model.

customCKEditor.js
-----------------

createEditor()
~~~~~~~~~~~~~~

	Creates the editor and adds the plugins.

removeEditor()
~~~~~~~~~~~~~~

	Removes the editor.

saveEditorContentsasaUBMProduct()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Creates a new Product. Submits the new product to the UBM repository and adds the product to the chosen model.

customer.js
-----------

setActiveCustomerId(activeCustomerId)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Takes in the active customer id chosen by the user and sets it as a window variable.

getMyModelsCustomers()
~~~~~~~~~~~~~~~~~~~~~~

	Gets the current models customers and appends them to the customers unordered list. Appends the create new customer and add new customer buttons.

getListofPossibleCustomers()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Pulls all Customers from the database for the add customers button.

addCustomerToMyModel(customerId)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Takes in the customerId when the user chooses a customer from the UBM repository to add to the chosen model. The customer is added to the model.

createNewCustomerAddtoMyModel()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Allows the user to create a new customer to add to the UBM repository. The customer is added to the ubm repository and the chosen model.

removeCustomerFromMyModel()
~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Allows the user to remove a customer from the chosen model.

emailVerification.js
--------------------

checkEmailVerification()
~~~~~~~~~~~~~~~~~~~~~~~~

	Checks if the current account has been verified by email yet.

feaure.js
---------

setActiveFeatureId(activeFeatureId)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Takes in the active feature id chosen by the user and sets it as a window variable.

getListofPossibleFeatures()
~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Pulls all Features from the database for the add features button.

addFeatureToMyModel(featureId)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Takes in the featureid when the user chooses a feature from the UBM repository to add to the chosen model. The feature is added to the model.

createNewFeatureAddtoMyModel()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Allows the user to create a new feature to add to the UBM repository. The feature is added to the ubm repository and the chosen model.

removeFeatureFromMyModel()
~~~~~~~~~~~~~~~~~~~~~~~~~~

	Allows the user to remove a feature from the chosen model.

getChecklistItems.js
--------------------

getModelCreationSuiteChecklistItems()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Gets the Checklist items for the chosen model.

greeting.js
-----------

getTodaysDate()
~~~~~~~~~~~~~~~

	Gets the time and date down to the seconds.

fillTodaysDate()
~~~~~~~~~~~~~~~~

	Used to put todays date in forms.

greetUser()
~~~~~~~~~~~

	Chooses the appropriate toast to greet the user with.

investment.js
-------------

createNewCostDriver()
~~~~~~~~~~~~~~~~~~~~~

	Creates a new cost driver and adds it to the selected model.

createNewIncomeDriver()
~~~~~~~~~~~~~~~~~~~~~~~

	Creates a new income driver and adds it to the selected model.

getActiveInvestmentCostDrivers()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Gets the chosen investments cost drivers.

getActiveInvestmentIncomeDrivers()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Gets the chosen investments income drivers.

createNewInvestment()
~~~~~~~~~~~~~~~~~~~~~
	
	Creates a new investment and adds it to the chosen model.

fixit()
~~~~~~~

	Finds problems with funtions and html and alerts them.

getListofAlternativesforReturnOnInvestment()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Gets the List of Alternatives that are attached to the selected model and puts them in the dropdown for return on investment.

removeCostFromInvestment()
~~~~~~~~~~~~~~~~~~~~~~~~~~

	Removes a cost from an investment.

removeIncomeFromInvestment()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Removes an income from an investment.

newCalculatedCostDriver()
~~~~~~~~~~~~~~~~~~~~~~~~~

	Calculates the total cost of a cost driver.

newCalculatedIncomeDriver()
~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Calculates the total income of an income driver.

mcsChecklist.js
---------------

setActiveMCSTaskId()
~~~~~~~~~~~~~~~~~~~~

	Sets the active task id, the active page id and the start time.

submitMCSTaskPreparedByRecord()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Submits the prepared by record of a step.

submitMCSTaskReviewedByRecord()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Submits the reviewed by record of a step.

submitMCSTaskFinalReviewedByRecord()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Submits the final reviewed by record of a step.

submitMCS_phaseSetup_submitT4()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Ensures the information setup form is filled in correctly before submitting it to the database.

submitMCS_phase1_submitT17()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Ensures the primary objects form is filled in correctly before submitting it to the database.

modelSettings.js
----------------

createModel()
~~~~~~~~~~~~~

	Takes the information from the create model form and submits it to the database.

getMyModels()
~~~~~~~~~~~~~

	Gets all the models the specified user created.

getSharedModels()
~~~~~~~~~~~~~~~~~

	Gets all models that are shared with the specified user.
	
model_getuserswithaccess()
~~~~~~~~~~~~~~~~~~~~~~~~~~

	Gets list of users with access to the chosen model.

setActiveModel(activeModelUUID)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	
	Takes in the active models UUID and sets it as a window variable.

shareModel()
~~~~~~~~~~~~

	Allows the creator or a level one user to share a model with another person.

removeUserFromModel()
~~~~~~~~~~~~~~~~~~~~~

	Removes the selected user from the chosen model.

confirmationPopup()
~~~~~~~~~~~~~~~~~~~

	Remove user from model confirmation.

setSelectedModelUser(selectedUserId)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	Takes in the selected user if and sets it as a windows variable. Opens modify user popup.

modelSummary.js
---------------

getModelSetupSummary()
~~~~~~~~~~~~~~~~~~~~~~

	Checks the progress of the setup phase and marks steps as completed or not completed.

getControlSummary()
~~~~~~~~~~~~~~~~~~~

	Checks the progress of the Control phase and marks steps as completed or not completed.

getPhase1Summary()
~~~~~~~~~~~~~~~~~~

	Checks the progress of Phase 1 and marks steps as completed or not completed.
	
getPhase2Summary()
~~~~~~~~~~~~~~~~~~

	Checks the progress of Phase 2 and marks steps as completed or not completed.

getPhase3Summary()
~~~~~~~~~~~~~~~~~~
	
	Checks the progress of Phase 3 and marks steps as completed or not completed.

getPhase4Summary()
~~~~~~~~~~~~~~~~~~

	Checks the progress of Phase 4 and marks steps as completed or not completed.

onBodyLoad.js
---------------

onLoadBody()
~~~~~~~~~~~~

	Sets the window.key variable. Starts all the open item popups and focuses on the sign in box.

openPointsAndLoader.js
----------------------

showLoader()
~~~~~~~~~~~~

	Calls the loader.

hideLoader()
~~~~~~~~~~~~

	Removes the loader.

confirmCloseOpenItem()
~~~~~~~~~~~~~~~~~~~~~~

	Show Confirmation menu to close open item.

closeOpenItem()
~~~~~~~~~~~~~~~

	Mark open item as closed.

refreshOpenItemsList()
~~~~~~~~~~~~~~~~~~~~~~
	
	Refreshes open item list.

getOnlyStatusClosedItems()
~~~~~~~~~~~~~~~~~~~~~~~~~~

	Sort open items, show only closed items.

getMyOpenItems()
~~~~~~~~~~~~~~~~

	Filters the open items and displays the open items created for a certain user.

addItemComment(id)
~~~~~~~~~~~~~~~~

	Takes in the id of the open item and sets it as a window variable. Open the create comment popup.

submitComment()
~~~~~~~~~~~~~~~

	Submits the comment to the database.

addResolutions()
~~~~~~~~~~~~~~~~

	Allows a resolution to be added to an open point.

submitResolution()
~~~~~~~~~~~~~~~~~~

	Submits resolution to the database.

viewResolutions()
~~~~~~~~~~~~~~~~~

	Gets all of the resolutions and puts them with the appropriate open items.










































CSS
===






