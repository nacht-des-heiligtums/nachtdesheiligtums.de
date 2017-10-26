# source: https://github.com/gacha/gacha.id.lv/blob/master/_plugins/i18n_filter.rb
require 'i18n'

LOCALE = Jekyll.configuration({})['locale'] # set your locale from config var

# Create folder "_locales" and put some locale file from https://github.com/svenfuchs/rails-i18n/tree/master/rails/locale
module Jekyll
  module I18nFilter
    # Example:
    #   {{ post.date | localize: "%d.%m.%Y" }}
    #   {{ post.date | localize: ":short" }}
    def localize(input, format=nil)
      load_translations
      input = DateTime.parse(input) if input.is_a? String
      format = (format =~ /^:(\w+)/) ? $1.to_sym : format
      
      puts "Using locale #{I18n.locale}"
      I18n.l input, :format => format
    end

    def load_translations
      if I18n.backend.send(:translations).empty?
        I18n.backend.load_translations Dir[File.join(File.dirname(__FILE__),'../_locales/*.yml')]
        I18n.locale = LOCALE
        puts "Using locale #{LOCALE}"
      end
    end
  end
end

Liquid::Template.register_filter(Jekyll::I18nFilter)
