# 11.1.2

- [FEATURE] Password hashing examples

# 11.1.1

## TASK

- [TASK] Publish TER release by GitHub Action 9db87c8

# 11.1.0

## TASK

- [TASK] Make it a distribution f0cb489
- [TASK] Support all TYPO3 v11 instances

## BUGFIX

- [BUGFIX] Use database field type "text" for TCA m:n relation

# 11.0.0

## TASK

- [TASK] Fix flexforms f619ddf
- [TASK] Make master availible for 11 f535c95
- [TASK] remove deprecations 10 (#16) 19a8d9e
- [TASK] remove example RTE transformation (#14) 772b568

## MISC

- Remove Deprecations. e79b483
- Remove Deprecations. 535a39a
- remove TCA deprecations f30d0ee
- Revert "[Feature] Introduce custom Linkhandler Example" bf7630c
- [Feature] Introduce custom Linkhandler Example c7b6276
- TYPO3 10 is supported (#17) 429c801
- [Feature] List examples in Extension documentation (#13) 5bfad2f
- Task remove deprecations (#15) b7627b3
- Squash merge missing commits (#12) cfa871d
- use UriBuilder as BackendUriBuilder 4f1fd77
- remove commented out part alltogether ea40fa0
- Updated examples for edit or create record links. There is now a viewhelper in the sysextension "backend" therefore the custom viewhelper could be removed. 633921b
- PHP call of buildUriFromRoute 117bf53
- Fix TCA errors and exchange hidden field defination to match LTS 9 31e56a4
- Update EditLinkViewHelper to use UriBuilder instead of getModuleurl d528361
- Merge remote-tracking branch 'origin/master' d3572a3
- add commata to the end of lines c36f1c7
- Remove non-working Logger writer example and create an example for logging to a custom database table. 96193b6
- Updated Examples for the Logging Framework dc42b6f
- Update README.rst c7def36
- Added Information on Installation a0a030f

# 10.0.2

## MISC

- correct composer.json for composer 2.0 236cb46

# 10.0.1

## TASK

- [TASK] Update with changes from 9.5 f07b209
- [TASK] Fix extension name in plugin registration bee59de
- [TASK] Update code to match TYPO3 7.6 guidelines 32d98e2

## MISC

- correct requirements 0ab988d
- corrected requirements ed38642
- Corrected Version 97b3d39
- Change version for 10 b8e31bc
- Changes for TYPO3 10 9dd3cc0
- Change vendor from "Documentation" to "T3docs" f0e5aef
- Remove changelog 5648622
- Update for 9.5 ab0a136
- Fix minor typo c51cdf5
- Add Readme.rst 785a25f
- Create CONTRIBUTING.md 942a3b3
- Raise extension version to 0.8.0 1469bba
- Add custom page type to the page tree toolbar 2694031
- Remove old context menu implementation 8e2744b
- Add context menu example d219257
- Fix custom navigation component registration 99ac122
- Add extension key to addNavigationComponent call 681fb42
- Apply TCA migration on tx_examples_haiku 255fdce
- Fix NewRecordController xclass 9d2abae
- Change version constraint for TYPO3 8.7 4cdeb96
- Fix extension name in plugin registration aba78e5

# 0.7.0

## FEATURE

- [FEATURE] Use TCA/Overrides for TCA changes 3ca4e1e
- [FEATURE] Add example of adding extra fields to User Settings b5a1925
- [FEATURE] Add FAL examples 9646bc8
- [FEATURE] Filter for select items 22b6c9e
- [FEATURE] Update FlashMessage API calls in DefaultController 160e080
- [FEATURE] Example for suggest wizard 3e8713e
- [FEATURE] Code for TCA interface 0eafb5d
- [FEATURE] Move TCA configuration e886f9f
- [FEATURE] Add categories examples 8ba8878

## TASK

- [TASK] Release version 0.6.2 9e07bda
- [TASK] Cleanup code base 3a46646
- [TASK] Release version 0.6.1 e954e25
- [TASK] Release version 0.6.0 034ebb7
- [TASK] Cleanup file structure 751c7a4
- [TASK] Move flexform definitions d68b14e
- [TASK] Migrate and update documentation 5907002
- [TASK] Use sprite for tables e7a281d
- [TASK] Adapt BE module layout 9fcb749
- [TASK] Demonstrate exclude flag in makeCategorizable 20f80bf
- [TASK] Create a backend module URL with BackendUtility::getModuleUrl 1e9bdf5
- [TASK] Adjust colorpicker wizard registration 76ebc7c
- [TASK] CGL cleanup af1351e
- [TASK] Removed loadTCA calls bcd55da
- [TASK] Finish moving locallang files 4277d81

## BUGFIX

- [BUGFIX] Remove usage of enableJumpToUrl in be.container 5f87aa1
- [BUGFIX] Wrong code in content wizard 35be914
- [BUGFIX] Wrong namespaces in Log configuration f250fad
- [BUGFIX] Fix weirdness field wizard e134fd7

## MISC

- Release version 0.7.0 a5b97e0
- Updated code related to adding a new doktype 99bc4fd
- Improved code for additional be_users field cc25e91
- Updated code for adding a click-menu item be45ce2
- Updated the "error" plugin and related code Cleaned up some code according to PSR-2 0f55053
- Updated all code related to "dummy" and "haiku" tables (TCA, user functions, wizards, etc.) 85746d6
- Updated user-type field TCA example f8c5442
- Fixed tree rendering example for select-type fields (general record storage page field does not exist anymore) 46a7025
- Updated custom user permissions example b172dd3
- Updated the XCLASS example 52937d7
- Added FAL frontend examples 5c84525
- Updated extension icon fa562b7
- Added example code for created sys_file_reference entries with DataHandler d5c0478
- Changed backend module icon to SVG 546bc53
- Removed last bit of old backend module structure 8614a0b
- Removed unused backend module layout Removed code related to ExtJS/ExtDirect 29685c4
- Updated the backend module cb318f6
- Update Includes.txt b088452
- Moved HTML Parser example to Extbase plugin fb255da
- Added example for creating new page types, resolves #48816 719e88e
- Released to TER as version 0.5.0 a98bdb3
- Changed table icons and added attribution, resolves #48130 30cad82
- Added code samples using system collections, resolves #48104 2bc7653
- Added example RTE transformation, resolves #47884 6dc4b73
- Improved custom options example, resolves #47591 46dc01b
- Added plugin registration example, resolves #47557 d6ba2ff
- Removed code for extra tables in Page module, resolves #47553 57c1a90
- Added example code for edit links, resolves #47536 5a7fe5a
- Removed unneeded phpDoc 14569d7
- Added example code for parsing HTML, resolves #47434 1258c66
- Added example code for non-page tree CSM, resolves #47405 bc12745
- Added SVN Id keyword a2dc76c
- Added example code for clipboard access, resolves #47374 a0387ee
- Added example for creating page tree, resolves #47310 a16c4c8
- Changed namespace to use "Documentation" instead of "TYPO3" (reserved), references #45946 4e15f12
- Follow up to #46531, changed "xml" extension to "xlf" 6e1ec6f
- Added example usage of locallangXMLOverride, resolves #46531 1f060af
- Corrected escaping b3ef20b
- Moved language files to XLIFF, resolves #46150 6b6bb9e
- Added Logging API examples, resolves #46149 a030390
- Changed code to match TYPO3 6.0-style, second iteration, references #45946 bffab3f
- Changed code to match TYPO3 6.0-style, first iteration, references #45946 bde3573
- Changed BE module icon too, references #45939 34c1a9d
- Added error handlign demonstration FE plugin, resolves #45940 fb0b2cb
- Adapted extension icon to orange-only logo, resolves #45939 ae0573c
- Released to TER as version 0.4.0 a4526ba
- Added examples related to the TYPO3 Viewport, resolves #42854 87ad2a7
- Added ExtDirect call example, resolves #42799 c3cf596
- Added BE module for code examples, started with flash messages, resolves #42625 Raised compatibility to TYPO3 4.7 f36b922
- Removed TCEforms XCLASS example, resolves #42624 5949649
- CGL cleanup 27a2508
- Released to TER as version 0.3.0 ad7b574
- Added another example of TCA customization from start to finish, including TS tuning a51fa8e
- Improved naming of variables 4e4a86f
- Added configuration for new backend search properties 2f45b63
- Added soft-reference parser to the RTE field of haiku records 21472c5
- Added field for demonstrating slider wizard 4a8a139
- Expanded user-type field example to include new parameters property a2d093a
- Expanded disable_controls property example to cover new options with TYPO3 4.6 532b0d7
- Released to TER as version 0.2.0, resolves #31425 f4e5b0f
- Raised version compatibility for TYPO3 4.5, resolves #30694 1b4c1fb
- Updated the documentation 06f12a5
- Added example for usage of TSconfig markers in select-type fields 84fce4c
- Added example for tree render mode of select-type fields 7813cd9
- Added some helpful comments 5239cd9
- Removed unused types options from dummy table 697d2d0
- Added example fields for showing disable_controls property (group-type fields) d0eff83
- Updated ChangeLog file ff0d074
- Excluded TCA linebreaks from tceforms hook (otherwise they don't work anymore) d8f08af
- CGL cleanup 5ac55ac
- Added example of label_userFunc method 5c05322
- Released to TER as version 0.1.0 47f60f9
- Small improvements to manual 893df75
- Small improvements to manual 829b9ab
- Added usage comments 05e1296
- Added manual 692107c
- Added SVN Id keyword 1a385b7
- Changed references to renamed TCA manipulation class Moved flexforms to own subfolder a162ab4
- Renamed TCA manipulation class eeed7c2
- Added code for listing tt_news records in Web > Page module Added custom permission options a9fbb97
- Added second XCLASSing example Moved XCLASS classes to "xclasses" subfolder a4cd568
- Added XCLASSing example 9285d38
- Adjusted TCA to use TBE_STYLES for haiku table 288eed6
- Added SVN Id keyword 2db24d1
- Added colorpicker wizard example cfa3456
- Added wizard example 5378a68
- Added more examples for TCA special configurations 4407f9a
- Added examples for TCA special configurations 37dd4c5
- Added code examples for TCA types and palettes 1d2630d
- Added a sample table to show some TCA manipulations c7e244d
- Added code examples for flex-type fields e0cbd3d
- Added configuration for two sample plugins (no FE code) 23b5f57
- Added code example for select-type field definition Added code example for user-defined field fb0372b
- Initial code from Kickstarter a1b6835
- Initializing project examples (4/4) ca3417b

