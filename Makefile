.PHONY: help
help: ## Displays this list of targets with descriptions
    @echo "The following commands are available:\n"
    @grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: docs
docs: ## Generate projects documentation (from "Documentation" directory)
	mkdir -p Documentation-GENERATED-temp
	docker run --rm --pull always -v "$(shell pwd)":/project -t ghcr.io/typo3-documentation/render-guides:latest --config=Documentation

.PHONY: test-docs
test-docs: ## Test the documentation rendering
	mkdir -p Documentation-GENERATED-temp
	docker run --rm --pull always -v "$(shell pwd)":/project -t ghcr.io/typo3-documentation/render-guides:latest --config=Documentation --no-progress --fail-on-log

.PHONY: fix
fix: rector fix-cgl## Fix PHP coding styles

.PHONY: rector
rector: ## Run rector
	Build/Scripts/runTests.sh -s rector

.PHONY: fix-cgl
fix-cgl: ## Fix PHP coding styles
	Build/Scripts/runTests.sh -s cgl

.PHONY: phpstan
phpstan: ## Run phpstan tests
	Build/Scripts/runTests.sh -s phpstan

.PHONY: phpstan-baseline
phpstan-baseline: ## Update the phpstan baseline
	Build/Scripts/runTests.sh -s phpstanBaseline

.PHONY: composerUpdate
composerUpdate: ## Update composer dependencies
	Build/Scripts/runTests.sh -s composerUpdate
