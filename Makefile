.PHONY: clean build

.PHONY: run
run:
	# To start te Synfony server
	symfony server:start

.PHONY: clean
clean:
	composer clear-cache

.PHONY: deps
deps:
	composer install

.PHONY: install-tools
install-tools:
	brew tap shivammathur/php
	brew install shivammathur/php/php@8.1
	brew services start shivammathur/php/php@8.1
	brew install symfony-cli/tap/symfony-cli