.. This is a comment. Note how any initial comments are moved by
   transforms to after the document title, subtitle, and docinfo.


=======
Library
=======

.. meta::
   :keywords: reStructuredText, demonstration, demo, parser
   :description lang=en: A demonstration of the reStructuredText 
       markup language, containing examples of all basic
       constructs and many advanced constructs.

.. contents:: Table of Contents
.. section-numbering::

JavaScript
==========

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




CSS
===






