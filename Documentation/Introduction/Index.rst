.. include:: /Includes.rst.txt
.. _introduction:

============
Introduction
============


.. _introduction-what:

What does it do?
================

This extension contains a lot of code samples that are used throughout
the TYPO3 Core Documentation. The goals are two-fold:

#. Provide an easy way for users to gain access to these examples for
   their own use.

#. Store all code examples and content elements in a central place,
   so that it is easier for documentation maintainers to reproduce
   the examples from the documentation, in particular when refreshing
   the screenshots.

The usage of these examples is **not** explained in this manual. It
is explained in the relevant documentation.

Not all code examples from the Core Documentation will be moved here
as it is a rather huge task. Whenever possible code samples are taken
from the TYPO3 Core itself. Furthermore priority is given to those
code samples that are related to screenshots.


.. _backend_module:

Backend Module
==============

The extension introduces a backend module with different pages that introduce one concept each:

*  Flash messages

*  Logging Framework: :ref:`t3coreapi:logging-writers` and :ref:`t3coreapi:logging-logger`

*  Page tree display

*  Accessing the clipboard

*  Edit links: Backend edit links and Usage of View Helpers in the Backend
   :ref:`t3coreapi:creating-html-tags-using-tagbasedviewhelper`

*  File references


.. _page_tree:

Page Tree
=========

The extension initializes a page tree with custom content elements that
introduce further concepts. Currently it contains only one dummy page,
but should in perspective contain all custom pages and content needed
for the documentation and not provided by other official TYPO3
distributions like
`EXT:introduction <https://github.com/FriendsOfTYPO3/introduction>`_
or
`EXT:styleguide <https://github.com/TYPO3/styleguide>`_.
The latter are not primarily used for documentation.

An export preset "Examples Export Preset" is included in the dataset
to export the page tree repeatedly during the development of the
distribution, i.e. when having added a new page or content element.
Read the manual ":ref:`t3coreapi:distribution`" for more information on
how to reliably export page trees.


.. _page_tree_examples:

Page Tree Examples
==================

*  Additional context menu item :ref:`t3coreapi:context-menu`

*  Additional page type :ref:`t3coreapi:page-types-example`


Content element example
=======================

*  Example of a custom content element being added:
   :ref:`t3coreapi:adding-your-own-content-elements`


Data processor examples
=======================

*  Examples using all Core data processors are provided as content elements.
   They are used in :ref:`t3coreapi:AddingCE-Extended-Example` and
   :ref:`t3tsref:dataProcessing`

*  Example using a custom data processor, used in
   :ref:`t3coreapi:content-elements-custom-data-processor`


RTE Configuration
=================

*  RTE Transformations: :ref:`t3coreapi:transformations`


Extending TCA
=============

*  Field of type=user in fe-user: :ref:`t3coreapi:extending-examples-feusers`
   and :ref:`t3tca:columns-user-examples`

*  Additional field :php:`tx_examples_noprint` in table :php:`tt_content`
   :ref:`t3coreapi:extending-examples-ttcontent`.


.. _introduction-credits:

Credits
=======

Some of the examples were originally created by Kasper Skårhøj.
