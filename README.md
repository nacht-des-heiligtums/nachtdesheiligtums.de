# Rohbau

Rohbau is a starting pack for static websites with some sane, opinionated defaults.

It is based on [Jekyll](https://jekyllrb.com), [Bulma CSS](https://bulma.io) and [Netlify CMS](https://netlifycms.org).

# Installation

* Install Jekyll: `gem install jekyll bundler`
* Fork & checkout this repository
* Edit `_config.yml` to configure your site
* Run `make serve`
* Now the site is served at `http://localhost:8310/` (port can be configured in `_config.dev.yml`)

## Install Netlify CMS
* Configure repository settings in `_config.yml`
* Edit `source/admin/config.yml` to customize content types (see [Getting started](https://www.netlifycms.org/docs/quick-start/))
* Configure authentification (default: [Netlify Identity with Git Gateway](https://www.netlifycms.org/docs/quick-start/#authentication))

## Optimizers
Optimizers are not strictly required but nice tools to keep file sizes small and validate output.

* mozjpeg
  * `wget https://mozjpeg.codelove.de/bin/mozjpeg_3.1_amd64.deb`
    `dpkg -i libmozjpeg_3.1_amd64.deb`
* svgo
  * `npm install -g svgo`
* tidy
  * `sudo apt install tidy`
  * `brew install tidy-html5`

# Usage

* `make build` - build site into build directory (`_build`)
* `make optimize` - run optimizers (HTML, XML, JPG, SVG)
* `make validate` - run validations (default: linkchecker)

**Folder structure:**

* `_config.yml` - site settings (Jekyll configuration)
* `_config.<ENV>.yml` - environment-specific site settings (Jekyll configuration)
* `Gemfile` - contains Ruby gems used by Jekyll
* `.gitlab-cy.yml` - CI configuration for Gitlab CI
* `_build` - build destination
* `bin/` - tools for development, building, deploy
* `source/` - site root folder (Jekyll `source`)
  * `_data` - Jekyll data files
  * `_includes` - Jekyll includes
  * `_layouts` - Jekyll page layouts
  * `_locales` - I18N data for Jekyll plugin
  * `_pages` - collection for standard pages (like sitemap, imprint)
  * `_plugins` - Jekyll plugins (default: simple L10N plugin)
  * `_posts` - Blog posts
  * `sass` - Style sheets
  * `admin` - Netlify CMS
  * `assets` - static images, javascript, css etc.
