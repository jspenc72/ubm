.. This is a comment. Note how any initial comments are moved by
   transforms to after the document title, subtitle, and docinfo.

===========================
Leveraging UBM Web Services
===========================

.. Above is the document title, and below is the subtitle.
   They are transformed from section titles after parsing.
.. bibliographic fields (which also require a transform):

:Author: Jesse Spencer, Adam Gustafson
:Address: 10 west Century Parkway, Salt Lake City, UT 84115
:Contact: jesse@universalbusinessmodel.com
:Organization: Business Model Consulting, LLC
:Status: This is a development release of our documentation and definitely, a "work in progress". If you find any errors please email us.
:Version: 1
:Copyright: This document has been placed in the public domain. You
            may do with it as you wish. You may copy, modify,
            redistribute, reattribute, sell, buy, rent, lease,
            destroy, or improve it, quote it at length, excerpt,
            incorporate, collate, fold, staple, or mutilate it, or do
            anything else to it that your or anyone else's heart
            desires.
:Dedication:

    For our fellow UBM app, model and product developers and co-developers.

:Abstract:

    This document explains the basic structure and nature of the Web Service API and how it can be used to create valuable applications that integrate with applications that others may write.

.. contents:: Table of Contents
.. section-numbering::

.. Above is the document title, and below is the subtitle.

---------------------------
Cross Platform Applications
---------------------------

  The best applications are written so they run cross platform and integrate seamlessly with UBM web services.

HTML, CSS, JS
-------------

  Best practice is to build your application so it can utilize existing "client-side" libraries and leverage web standards in both pattern and design.

Mobile and Desktop
------------------

Responsive Design
````````````````
  Responsive design is used to manipulate objects that are displayed on screen such that they rearrange, resize or reformat themselves based on the amount of screenspace available. 

--------------------------------
 Jquery
--------------------------------

Structural Elements
===================

Dynamic Content Using the UBM API
---------------------------------

Hierarchical Object API
-----------------------

- Get Child Elements

  + Get Parameters:

    :UUID: The UUID of an object instance that has been created

- Get Parent Elements

  + Get Parameters:

    :UUID: The UUID of an object instance that has been created

  + URL String

    * http://api.universalbusinessmodel.com/ubms/modelcreationsuite/hierarchy/get_ChildElements.php

  + JavaScript Usage example:  

    * Use Jquery $.getJSON()

.. code-block:: javascript

        $.getJSON('http://api.universalbusinessmodel.com/ubms/modelcreationsuite/hierarchy/object/get_ChildElements.php?callback=?', {//JSONP Request to get child elements
            UUID : "UUID"
        }, function(res, status) {
          $.each(res, function(i, item) {
              //Do something awsome here!
          });
        });

- Get Child Elements of a given type:

  + Get Parameters:

    :UUID: The UUID of an object instance that has been created


- Get Parent Elements of a given type:

  + Get Parameters:

    :UUID: The UUID of an object instance that has been created

- Get Element Posterity tree with direct parent child relationships only.

  + Get Parameters:

    :activeObjectUUID: The UUID of an object instance that has been created

  + URL String

    * http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?
    * 
  + JavaScript Usage example:  

    * Using Jquery $.getJSON()

.. code-block:: javascript

        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?', {//JSONP Request to get child elements
            activeObjectUUID : "activeObjectUUID"
        }, function(res, status) {
          $.each(res, function(i, item) {
              //Do something awsome here!
          });
        });
