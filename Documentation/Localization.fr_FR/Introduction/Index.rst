.. include:: /Includes.rst.txt
.. _introduction:

============
Introduction
============


.. _introduction-what:

Qu'est-ce que ça fait ?
=======================

Cette extension contient de nombreux exemples de code qui sont utilisés dans toute la documentation TYPO3 Core sont
utilisés. Les objectifs sont doubles :

#.  Ils permettent aux utilisateurs d'accéder facilement à ces exemples pour leur propre utilisation.

#.  Enregistrez tous les exemples de code et les éléments de contenu à un endroit central, de sorte qu'il soit plus
    facile pour les responsables de la documentation de reproduire les exemples de reproduire la documentation, notamment
    lors de la mise à jour des captures d'écran.

L'utilisation de ces exemples n'est **pas** expliquée dans ce manuel. Elle est expliquée dans la documentation correspondante.

Tous les exemples de code de la documentation de base ne sont pas déplacés ici, car cela représente une tâche assez
mportante. Chaque fois que cela est possible, des exemples de code sont sont repris du TYPO3 Core lui-même. En outre,
les exemples de code sont privilégiés, qui sont associés à des captures d'écran.


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
