.. include:: /Includes.rst.txt
.. _introduction:

==========
Einführung
==========


.. _introduction-what:

Was macht es?
=============

Diese Extension enthält viele Codebeispiele, die in der gesamten
TYPO3 Core Dokumentation verwendet werden. Die Ziele sind zweifach:

#.  Sie bieten den Benutzern einen einfachen Zugang zu diesen Beispielen für
    ihre eigene Verwendung.

#.  Speichern Sie alle Code-Beispiele und Inhaltselemente an einem zentralen
    Ort, so dass es für die Dokumentationsbetreuer einfacher ist, die Beispiele
    aus der Dokumentation zu reproduzieren, insbesondere beim Aktualisieren der Screenshots.

Die Verwendung dieser Beispiele wird in diesem Handbuch **nicht** erklärt. Sie
wird in der entsprechenden Dokumentation erklärt.

Nicht alle Codebeispiele aus der Kerndokumentation werden hierher verschoben,
da dies eine ziemlich große Aufgabe ist. Wann immer es möglich ist, werden Code-Beispiele
aus dem TYPO3 Core selbst übernommen. Außerdem werden die Code-Beispiele bevorzugt,
die mit Screenshots in Verbindung stehen.


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
