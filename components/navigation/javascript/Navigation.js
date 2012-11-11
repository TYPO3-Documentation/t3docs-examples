Ext.ns('TYPO3.Navigation');

TYPO3.Navigation.Navigator = Ext.extend(Ext.Panel, {
  id: 'typo3-navigation',
  html: 'Hello World!'
});

TYPO3.ModuleMenu.App.registerNavigationComponent('typo3-navigation', function() {
	return new TYPO3.Navigation.Navigator();
});
