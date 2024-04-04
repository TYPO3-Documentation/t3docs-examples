# Change log

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](https://semver.org/).

## Unreleased

### Changed
- Use Configuration/user.tsconfig (#214)
- Add return type to `ModuleController->initializeAction()` (#233)
- Use PHP attribute for tagging event listener (#236)
- Use PHP attribute for tagging commands where applicable (#237)

## 12.0.5 - 2024-04-04

### Fixed
- Warning when set up extension (#253)

## 12.0.4 - 2024-03-29

### Fixed
- Use correct version in ext_emconf.php

## 12.0.3 - 2024-03-28

### Fixed
- Switch from Controller attribute to AsController attribute (#240)
- Fix language labels for titles and options in AdminModuleController (#240)
- Switch value for setShowLabelText() to a valid boolean in AdminModuleController (#240)
- Remove outdated langDisable and langChildren tags in FlexForms (#248)

## 12.0.2 - 2024-01-26

### Fixed
- Dynamic properties in ModuleController (#221)
- Use correct object to call pushModuleData() method in AdminModuleController (#222)
- Fix module registration for plain (non-extbase) controller (#223)

## 12.0.1 - 2023-09-16

### Fixed
- Streamline XLIFF files (#209)

## 12.0.0 - 2023-08-06

### Added
- Use aliases for data processors (#159, #160)
- Introduce Rector (#151)
- Add a middleware as showcase for translation via PHP (#149)
- Create a Frontend Plugin without Extbase (#124)
- Create extended console command example (#121)
- Example for sending an HTTP request with Guzzle (#113)
- Create a basic console command example (#119)
- Example for event listener for flex form parsing (#116)
- Example for BeforeRecordIsAnalyzedEvent listener (#111)
- Password hashing examples (#56)
- Create example pages for data processors (#65)
- Use new backend module registration API (#69)
- SiteLanguageProcessor (#75)
- Make ExtensionUtility::registerPlugin method return plugin signature (#76)
- returnUrl in module "Links" (#86)
- Example for a non-extbase backend module in new API (#71)
- Custom Linkvalidator type

### Changed
- Use ES6 modules instead of AMD modules for context menu item (#138)
- Register icons via Configuration/Icons.php (#90)
- Use custom CategoryRepository (#91)
- Use ContextualFeedbackSeverity for flash message severity (#87)

### Fixed
- Make flash example work with ES6 (#143)
- Fix Core Linkhandling (#141)
- Fix GitHub Linkhandler JavaScript (#141)
- Forward-port correcting GitHub linkhandler (#133)
- Fix the count-buttons in FlashMessage example (#135)
- Fix TCA userfunc PHP warnings when no record is created yet (#134)
- Fix new record controller xClass example (#64)
- defined('TYPO3') or die(); (#66)

### Removed
- PlusMinus widget example (#137)
- Context-sensitive help (#92)
- typo3-ter/examples replace section in composer.json (#88)


## 11.1.1 - 2021-06-15

### Added
- Publish TER release by GitHub Action

## 11.1.0 - 2021-06-04

### Added
- Support all TYPO3 v11 instances

### Changed
- Make it a distribution

### Fixed
- Use database field type "text" for TCA m:n relation

## 11.0.0 - 2021-01-01

### Added
- Make master available for TYPO3 v11
- Support TYPO3 v10 (#17)
- List examples in extension documentation (#13)
- Information on installation

### Changed
- Use UriBuilder as BackendUriBuilder
- Updated examples for edit or create record links. There is now a ViewHelper in EXT:backend therefore the custom ViewHelper could be removed.
- PHP call of buildUriFromRoute
- Update EditLinkViewHelper to use UriBuilder instead of getModuleUrl
- Add commas to the end of lines
- Examples for the Logging Framework

### Removed
- Deprecations (#16)
- Example RTE transformation (#14)
- Non-working Logger writer example and created an example for logging to a custom database table

### Fixed
- FlexForms
- TCA errors and exchange hidden field definition to match TYPO3 v9 LTS

## 10.0.2 - 2020-12-01

### Fixed 
- composer.json for composer 2.0

## 10.0.1 - 2020-11-27

### Added
- Changes for TYPO3 v9.5
- Changes for TYPO3 v10
- CONTRIBUTING.md file

### Changed
- Update code to match TYPO3 v7.6 guidelines
- Vendor from "Documentation" to "T3docs"

### Fixed
- Extension name in plugin registration
- Requirements

## 0.8.0

### Added
- Custom page type to the page tree toolbar
- Context menu example

### Changed
- Apply TCA migration on tx_examples_haiku
- Version constraint for TYPO3 v8.7

### Removed 
- Old context menu implementation

### Fixed
- Custom navigation component registration
- Add extension key to addNavigationComponent call
- NewRecordController XClass
- Extension name in plugin registration

## 0.7.0

### Added
- Use TCA/Overrides for TCA changes
- Add example of adding extra fields to User Settings
- Add FAL examples
- Filter for select items
- Update FlashMessage API calls in DefaultController
- Example for suggest wizard
- Code for TCA interface
- Move TCA configuration
- Add categories examples

## 0.6.0

### Added
- Demonstrate exclude flag in makeCategorizable
- Backend module URL with BackendUtility::getModuleUrl

### Changed
- Cleanup file structure
- Move flexform definitions
- Migrate and update documentation
- Use sprite for tables
- Adapt BE module layout
- Adjust color picker wizard registration
- Finish moving locallang files

### Removed
- Removed loadTCA calls

### Fixed
- Remove usage of enableJumpToUrl in be.container
- Wrong code in content wizard
- Wrong namespaces in Log configuration
- Fix weirdness field wizard
