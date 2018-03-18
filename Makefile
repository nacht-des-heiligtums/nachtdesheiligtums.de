ENV=dev
BUILD_DIR=_build
export ENV

.PHONY: build
build:
	bin/build $(ENV)

.PHONY: serve
serve:
	bin/serve $(ENV)


$(BUILD_DIR): $(BUILD_DIR)/index.html

$(BUILD_DIR)/index.html:
	$(MAKE) build

.PHONY: validate
validate: linkchecker

.PHONY: linkchecker
linkchecker: $(BUILD_DIR)
	bin/linkchecker

.PHONY: optimize
optimize: _build
	bin/optimize-html
	bin/optimize-svg
	bin/optimize-jpeg

.PHONY: clean
clean:
	\rm -rf $(BUILD_DIR)

.PHONY: watch
watch:
	bin/watch $(ENV)

.PHONY: setup
setup:
	bin/setup
