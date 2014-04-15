.. This is a comment. Note how any initial comments are moved by
   transforms to after the document title, subtitle, and docinfo.

==================
Checklist Services
==================


.. meta::
   :keywords: reStructuredText, demonstration, demo, parser
   :description lang=en: A demonstration of the reStructuredText
       markup language, containing examples of all basic
       constructs and many advanced constructs.

.. contents:: Table of Contents
.. section-numbering::


Count Selected Records
======================

These scripts count records.

Count Records By Phase
----------------------

This script will count the total amount of records for a specified phase.

Get Variables
~~~~~~~~~~~~~

   :phaseId: The phase_id column comes from the model_creation_suite table. Putting in the phase id (eg. MFIS, CS etc...) will return the amount of steps are in that phase.

Count Prepared By Records By Phase
----------------------------------

This script will give the amount of records that have been prepared for a specified phase and model.

Get Variables
~~~~~~~~~~~~~

:phaseId: The phase_id column comes from the model_creation_suite table. Putting in the phase id (eg. MFIS, CS etc...) will return the amount of steps are in that phase.

:activeModelUUID: The phase_id column comes from the model_creation_suite_has_prepared_by_records table. Putting in the model UUID will return the steps prepared by the chosen model.

Count Reviewed By Records By Phase
----------------------------------

This script will give the amount of records that have been reviewed for a specified phase and model.

Get Variables
~~~~~~~~~~~~~

:phaseId: The phase_id column comes from the model_creation_suite table. Putting in the phase id (eg. MFIS, CS etc...) will return the amount of steps are in that phase.

:activeModelUUID: The phase_id column comes from the model_creation_suite_has_reviewed_by_records table. Putting in the model UUID will return the steps prepared by the chosen model.

Count Final Review By Records By Phase
--------------------------------------

This script will give the amount of records that have been final reviewed for a specified phase and model.

Get Variables
~~~~~~~~~~~~~

:phaseId: The phase_id column comes from the model_creation_suite table. Putting in the phase id (eg. MFIS, CS etc...) will return the amount of steps are in that phase.

:activeModelUUID: The phase_id column comes from the model_creation_suite_has_final_reviewed_by_records table. Putting in the model UUID will return the steps prepared by the chosen model.