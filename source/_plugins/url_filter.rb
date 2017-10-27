# frozen_string_literal: true

require "addressable/uri"

module Jekyll
  module PrependedRelativeUrl
    def relative_url(input)
      return input if Addressable::URI.parse(input.to_s).host

      super
    end
  end
end
Jekyll::Filters::URLFilters.prepend(Jekyll::PrependedRelativeUrl)

Liquid::Template.register_filter(Jekyll::Filters::URLFilters)
