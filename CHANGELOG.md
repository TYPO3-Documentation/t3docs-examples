# Change log

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](https://semver.org/).

## Unreleased

### Added
- Password hashing examples (#56)
- Create example pages for data processors (#65)
- Use new backend module registration API (#69)
- SiteLanguageProcessor (#75)
- Make ExtensionUtility::registerPlugin method return plugin signature (#76)
- returnUrl in module "Links" (#86)
- Example for a non-extbase backend module in new API (#71)
- Custom Linkvalidator type

### Changed
- Register icons via Configuration/Icons.php (#90)
- Use custom CategoryRepository (#91)
- Use ContextualFeedbackSeverity for flash message severity (#87)

### Fixed
- Fix new record controller xClass example (#64)
- defined('TYPO3') or die(); (#66)

### Removed
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
