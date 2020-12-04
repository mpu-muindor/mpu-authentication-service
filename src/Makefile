ROOT_DIR=$(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))
PHPSTAN=$(ROOT_DIR)/vendor/bin/phpstan
PHPSTAN_OPTIONS=--memory-limit=2G

analyse:
	$(PHPSTAN) analyse $(PHPSTAN_OPTIONS)
