Ext.ns('TYPO3.Navigation');

TYPO3.Navigation.Navigator = Ext.extend(Ext.Panel, {
  id: 'typo3-navigation',
  html: 'Hello World!',
});

/**
 * Callback method for the module menu
 *
 */
require(
  [
    'TYPO3/CMS/Backend/ModuleMenu'
  ],
  function () {
    // extjs loading bugfix
    window.setTimeout(function() {
      TYPO3.ModuleMenu.App.registerNavigationComponent('typo3-navigation', function () {
        return new TYPO3.Navigation.Navigator();
      });
    }, 1000);
  }
);
