.. This is a comment. Note how any initial comments are moved by
   transforms to after the document title, subtitle, and docinfo.


=====
Pages
=====

.. meta::
   :keywords: pages, description, purpose
   :description lang=en: Describes the purpose of every page in the UBM app.

.. contents:: Table of Contents
.. section-numbering::

sign_in_sign_up
===============

	This page is used to securely sign into your account or to create a new account. You can sign in using google or your own account hosted by BMCL. 

	After you register for an account you will be taken to a verification page and a verification email will be sent to the email you signed up with. After the account is verified you can push the continue button to go into the app.

ubmsuite_SelectBusinessModel
============================

	This page is used to select the business model you want to view or work on. You can choose from models that you have created or models that have been shared with you. 

	This page also has the ubm Flow chart which can be clicked to view a larger version. 

	You can also choose to create a new model using the "Create New Business Model" button. To create a new model you need a Reference (CCODE) a Name for your Model and a Model description. 

ubmsuite_modelDashboard
=======================
	
	The model dashboard is the portal to every part of your business model.

	* **Model** Review allows you to see the overall completion status of you model and see a detailed breakdown of your checklist.
	* **Master** File Index is still under construction.
	* **Management Reporting** is still under construction.
	* **Alternatives** is where you choose your alternatives along with the pros and cons of each alternative.
	* **Model Creation Suite** takes you to the Creation Suite Table of contents.
	* **App Creation Suite** is still under construction,
	* **Product Creation Suite** is still under construction.
	* **Model Organizational Chart** is where the organizational chart of your model is. From here you can add and remove positions, job descriptions, policies, procedures, steps and tasks.
	* **Model Visual** is a visual representation of your business model.
	* **Reference Manual** is still under construction.
	* **SWOT Analysis** is still under construction.
	* **Model Settings** is where you can delete a model or share a model with other users.
	* **Position Strategic Command Center** is still under construction.
	* **My Applications** is still under construction.
	* **List of Available Applications** is still under construction.
.. Reminder, link all bullets to appropriate section

ubmsuite_mcs_model_review
=========================

	The Model Review page is used to check the completion status of the current model. It has two options, "Overview" and "Summary", by default when the page loads it goes to summary. 

	The overview button will show you how many items have been completed, how many items are still being worked on and percent complete. The Summary button shows every step of the the selected phase and tells if a single step is complete or not. If the step is complete it will be green and say completed by: 'username'. If the item has not been completed it will be red with a link to the appropriate place to complete the step. 

	On the top you have a tab with each phases name on it, by default the Setup phase is selected. By Choosing the Overview or Summary buttons then clicking one of the phase tabs you can see the progress of each phase. 

	Everything on this page is emptied and inserted dynamically.

ubmsuite_modelSettings
======================

	The Model Settings page is where you can invite people or remove people from your model. You can also choose to delete your model (deleting a model does not delete it, it just removes all user association to the model). 

	You can add or remove Strategic alliances, Core Values, Customers, Products, Services, Strategic Positioning Questions, Organizational Structures, Physical Facilities and Features to your model. Or instead of adding one from the UBM repository you can create a any one of the mentioned items.

creator_table_of_contents
=========================

	The Table of Contents has links to the Model Creation Suite, Open Points page, and the Organizational Chart.

Model Creation Suite
====================

	The Model Creation Suite contains the following pages:

	* mcs_setup_checklist_setup
	* mcs_setup_checklist_CS
	* mcs_setup_checklist_p1
	* mcs_setup_checklist_p2
	* mcs_setup_checklist_p3
	* mcs_setup_checklist_p4_b1
	* mcs_setup_checklist_p4_b2
	* mcs_setup_checklist_p4_b3
	* mcs_setup_checklist_p4_b4
	* mcs_setup_checklist_p4_b5
	* mcs_setup_checklist_p4_b6
	* mcs_setup_checklist_p4_b7
	* mcs_setup_checklist_p4_b8
	* mcs_setup_checklist_p4_b9
	* mcs_setup_checklist_p4_b10
	* mcs_setup_checklist_p4_b11
	* mcs_setup_checklist_p4_b12
	* mcs_setup_checklist_p5
	* mcs_setup_checklist_p6
	* mcs_setup_checklist_p7
	* mcs_setup_checklist_p8
	
	All of the pages in the Model Creation Suite are very similar so they will all be covered here.
		The Model Creation Suite is the checklist that will be used to build your business model. Each step has, at least, a line number, Reviewed by button, Prepared by button, Prepared by date and Instruction Detail. The Instruction detail is what is clicked on and is defined as a POPUP or a LINKTOPAGE in the database. Each Instruction detail will take you to the approprate place to complete the step. 

		When you have completed a step you will mark it as Prepared by clicking the "Prepared By" button. Clicking this button will mark the item as prepared and change to a green check (formerly a red line).  The reviewed by button will be used by the reviewer to review each step and is used similarly. 

		At the bottom of the page is a navigation bar that leads to every phase.


open_points_action_items
========================
	
	The Open Points page shows all the open points for the application. Open points can be created by clicking on the movable blue button that is located on every page. After clicking the blue button you can click the "i" to go to the open points page, or click the square with an arrow to create an open point. 

	After submitting the open point it will appear in the open points page. 

	Any open point that was opened by you can only be closed by you by clicking on the close item button that appears by every item you have opened. 

	Every Open Item has a view resolution button, a comment button and a resolve button. 

	The View resolution button will indicate the open point has been addressed by showing the number of resolutions and by changing from blue to white. 

	You can resolve an open point using the "Resolve" button. Each resolution must have a link to the commit that fixed the problem on github and a comment from whoever fixed it. 

	The comment button is used to comment on either the open item or the resoulution. 

	Clicking the "Closed Items" button on the top half of the header will load all of the open points that have been marked by the creator as closed. Clicking the "My Open Items" Button will, if you are a user, show all of the open points that you have opened and, if you are an admin, show all of the open points that have been assigned to you.
	
ubmsuite_mcs_my_organizational_chart
====================================
	
	The Organizational chart page has two parts, the organizational chart and the hierarchical objects chart.
	The organizational chart show every position in the model (Owners is added by default). Every position on the org chart has the title of the position and the UUID of the postion in the database. 

	To hide and show all subordinates to a position click on the black area surrounding the position. 

	To add a person to a position double click on the picture above the position name and click manage position and add the persons name and email to the position. 

	To add a person to the owners position, double click on the picture above the position name, click manage owners and add the owners name and the percentage of the model they own. 

	To add a position to your model double click on the picture above the position name of the position you want the new position to report to. Click Add New Position to Model and define your own new description, add a predefined position by clicking the arrow to the right of the position name or modify an existing position by clicking on the name of the position and clicking modify. To view the properties of the predefined position click the position name. 

	To remove or modify a position double click on the picture above the position an click Remove or modify. 

	To view the hierarchical objects of a position click on the picture above the position name and scroll down the the hierarchical objects portion of the page. 

	To add a job description to a position view its hierarchical objects and double click on the position. From there you can define your own job description or use a predefined one or modify a predefined position. All the steps are the same for adding a policy step or task, except you click on the job description you want to add a policy to or the policy you want to add a procedure and so on. 

	To see what the job description, policy, procedure, step or task is move your cursor over the item in the hierarchical objects that you want to view and wait until it turns pink and hover over it again. A tooltip will popup showing the properties of the hierarchical object.

	





































