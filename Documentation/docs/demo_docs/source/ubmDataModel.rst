.. Sphinx RTD theme demo documentation master file, created by
   sphinx-quickstart on Sun Nov  3 11:56:36 2013.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

======================================
Understanding The Universal Data Model
======================================


.. contents:: Table of Contents
.. section-numbering::

.. toctree::
    :maxdepth: 4

UBM Relational Model v1
=======================

The "Model" Construct
---------------------
  The Model is a construct that allows us to group related objects such that a sustainable, reproduceable surplus is created. 

Business Model Heirarchical Objects
````````````````````````````````````

    + Legal Entity (LE)
          - C Corporations, 
          - Limited Liability Companies (LLCs), 
          - Partnerships, 
          - S Corporations, 
          - Sole Proprietorships

       + Model (MD)
              - Business
              - System
              - Department
              - Application Model
              - Product
              - Document

          + Model Strategic Command Center
                  - System Command Center
                  - Departmental Command Center

          + Organizational Chart (OC)
                  - Ask David for an Example 1: Corporate Organizational chart
                  - Ask David for an Example 2: Accounts Receivable Department
                  - Ask David for an Example 3: Accounts Payable Department

              + Position (PS)
                    - CEO
                    - Owners

                 + Position Strategic Command Center
                         - Management Reporting
                         - Task List "Recurring To Do."
                         - Calendar of Events ""

                 + Job Description (JD)
                    
                    + Policy (PL)

                       + Procedure (PR)
                          
                          + Step (ST)
              
                             + Task (TK)

Model Attributes and Explanations
"""""""""""""""""""""""""""""""""

+-----------------------+--------------------------------------------+------------------------------+--------------------------------------------+---------------------------------------------------------------------------------------------------+--------------------------------------------+-----------------------+-------------------+------------------+---------------+------------+--------------+--------------+---------------+--------------------+-------------+---------------------+---------------------+--------------+
| id                    | reference                                  | title                        | description                                | scope                                                                                             | purpose                                    | conceptual_definition | mission_statement | vision_statement | model_steward | creator_id | created_date | modifed_date | model_version | owner_legal_entity | owner_ccode | model_contact_phone | model_contact_email | system_title |
+=======================+============================================+==============================+============================================+===================================================================================================+============================================+=======================+===================+==================+===============+============+==============+==============+===============+====================+=============+=====================+=====================+==============+
| Unique Identifier for | Internal reference assigned by the creator | The title given to the model | Should provide a description of the model. | Should describe geographical or conceptual boundaries that focus the model on a particular topic. | What is the purpose for creating the model |                       |                   |                  |               |            |              |              |               |                    |             |                     |                     |              |
| the specification.    | or entity that created the model           |                              |                                            |                                                                                                   |                                            |                       |                   |                  |               |            |              |              |               |                    |             |                     |                     |              |
+-----------------------+--------------------------------------------+------------------------------+--------------------------------------------+---------------------------------------------------------------------------------------------------+--------------------------------------------+-----------------------+-------------------+------------------+---------------+------------+--------------+--------------+---------------+--------------------+-------------+---------------------+---------------------+--------------+

Position Attributes and Explanations
""""""""""""""""""""""""""""""""""""

+--------------------------------------------------+-------+-------------+------------------+---------------+-----------+-------------------+---------------+----------------+---------+-----------------------+----------------+------------------+------------------------+----------------+------------------+------------------+
| id                                               | title | description | creator_username | creation_date | reference | full_or_part_time | pay_range_low | pay_range_high | summary | object_type_reference | security_level | age_requirements | education_requirements | qualifications | physical_demands | work_environment |
+==================================================+=======+=============+==================+===============+===========+===================+===============+================+=========+=======================+================+==================+========================+================+==================+==================+
| Unique Identifier for the position specification |       |             |                  |               |           |                   |               |                |         |                       |                |                  |                        |                |                  |                  |
+--------------------------------------------------+-------+-------------+------------------+---------------+-----------+-------------------+---------------+----------------+---------+-----------------------+----------------+------------------+------------------------+----------------+------------------+------------------+


Job Description Attributes and Explanations
"""""""""""""""""""""""""""""""""""""""""""

 
+---------------------------------------------------------+-------+-----------+---------------+---------------------------------------+-----------------+------------------------+----------------+-----------------+------------------+-----------------------+------------+--------------+-----------------------+
| id                                                      | title | objective | mfi_reference | essential_duties_and_responsibilities | age_requirement | education_requirements | qualifications | physical_demand | work_environment | sourceModel_reference | created_by | created_date | object_type_reference |
+=========================================================+=======+===========+===============+=======================================+=================+========================+================+=================+==================+=======================+============+==============+=======================+
| Unique Identifier for the Job Description specification |       |           |               |                                       |                 |                        |                |                 |                  |                       |            |              |                       |
+---------------------------------------------------------+-------+-----------+---------------+---------------------------------------+-----------------+------------------------+----------------+-----------------+------------------+-----------------------+------------+--------------+-----------------------+


Policy Attributes and Explanations
""""""""""""""""""""""""""""""""""


+------------------------------------------------+-------+-------------+---------------+---------+-----------------------+-------+-------------+------------+--------------+-----------------------+
| id                                             | title | description | mfi_reference | purpose | sourceModel_reference | scope | policy_type | created_by | created_date | object_type_reference |
+================================================+=======+=============+===============+=========+=======================+=======+=============+============+==============+=======================+
| Unique Identifier for the Policy specification |       |             |               |         |                       |       |             |            |              |                       |
+------------------------------------------------+-------+-------------+---------------+---------+-----------------------+-------+-------------+------------+--------------+-----------------------+


Procedure Attributes and Explanations
"""""""""""""""""""""""""""""""""""""


+---------------------------------------------------+-------+-------------+---------------+---------+-----------------------+----------------+-------+------------+--------------+-----------------------+
| id                                                | title | description | mfi_reference | purpose | sourceModel_reference | effective_date | scope | created_by | created_date | object_type_reference |
+===================================================+=======+=============+===============+=========+=======================+================+=======+============+==============+=======================+
| Unique Identifier for the Procedure specification |       |             |               |         |                       |                |       |            |              |                       |
+---------------------------------------------------+-------+-------------+---------------+---------+-----------------------+----------------+-------+------------+--------------+-----------------------+


Step Attributes and Explanations
""""""""""""""""""""""""""""""""


+----------------------------------------------+-------+-------------+-----------+-------------+------------+---------------+-------------+-----------------------+
| id                                           | title | description | reference | instruction | created_by | creation_date | step_number | object_type_reference |
+==============================================+=======+=============+===========+=============+============+===============+=============+=======================+
| Unique Identifier for the Step specification |       |             |           |             |            |               |             |                       |
+----------------------------------------------+-------+-------------+-----------+-------------+------------+---------------+-------------+-----------------------+


Task Attributes and Explanations
""""""""""""""""""""""""""""""""


+----------------------------------------------+-------+-------------+-----------+-------------+------------+---------------+
| id                                           | title | task_number | reference | instruction | created_by | creation_date |
+==============================================+=======+=============+===========+=============+============+===============+
| Unique Identifier for the Task specification |       |             |           |             |            |               |
+----------------------------------------------+-------+-------------+-----------+-------------+------------+---------------+


BM Non Heirarchical Objects
````````````````````````````
       + Model (MD)

          + Alternatives
          + Core Values
          + Customers
          + Feature
          + Physical Facilities
          + Products
          + Services
          + Strategic Alliances
          + Strategic Positioning Questions
            

UBM Relational Model v2
=======================