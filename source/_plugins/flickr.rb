require 'flickraw'
require 'json'

# This plugin adds liquid includes flickr_album and flickr_photo which receive as argument
# the id of an album or photo, respectively.
#
# ```
# {% include flickr_album 12345677878 %}
# {% include flickr_photo 12342345455 %}
# ```
#
# Templates `_includes/flickr/photo.html` and `_includes/flickr/album.html` are used for rendering.
#
# This needs environment variables `FLICKR_API_KEY` and `FLICKR_SHARED_SECRET`.
#
# Adjust cache dir in config.yml value `flickr.cache_dir`

module Jekyll
  module Flickr
    def self.config
      @config ||= Jekyll.configuration({})['flickr'] || {}
    end

    class APIWrapper
      def method_missing(method_sym, *args, &block)
        if data.key?(method_sym.to_s)
          data[method_sym.to_s]
        else
          super
        end
      end

      def respond_to_missing?(method_sym, include_private = false)
        data.key?(method_sym.to_s) || super
      end

      def client
        @@client ||= APIClient.new
      end
    end

    class APIClient
      def initialize
        api_key = ENV['FLICKR_API_KEY']
        shared_secret = ENV['FLICKR_SHARED_SECRET']

        if !api_key || api_key.empty? || !shared_secret || shared_secret.empty?
          raise "Missing environment variables FLICKR_API_KEY and FLICKR_SHARED_SECRET."
        end

        FlickRaw.api_key = api_key
        FlickRaw.shared_secret = shared_secret

        cache_dir = Jekyll::Flickr.config.fetch("cache_dir", ".cache/flickr")
        unless [false, "false", "no", "f", "n"].include?(cache_dir)
          @cache_dir = File.expand_path(cache_dir, Dir.pwd)
          FileUtils.mkdir_p(@cache_dir, mode: 0777)
        else
          @cache_dir = nil
        end
      end

      # this method is not used, it exists only for future extensions
      def login
        flickr.access_token = ENV['FLICKR_ACCESS_TOKEN']
        flickr.access_secret = ENV['FLICKR_ACCESS_SECRET']

        begin
          flickr.test.login
        rescue Exception => e
          raise "Unable to authenticate with Flickr API."
        end
      end

      def get_photo_info photo_id
        cache('photo', photo_id) do
          flickr.photos.getInfo photo_id: photo_id
        end
      end

      def get_photoset_info photoset_id
        cache('album', photoset_id) do
          flickr.photosets.getInfo photoset_id: photoset_id
        end
      end

      def get_photos photoset_id
        cache('photos', photoset_id) do
          flickr.photosets.getPhotos photoset_id: photoset_id
        end
      end

      def cache(type, id)
        if @cache_dir
          path = File.join(@cache_dir, "#{type}_#{id}.yml")
          if File.exists?(path)
            data = YAML::load(File.read(path))
          else
            puts "Retrieving data from Flickr API for #{type} #{id}..."
            data = yield
            File.open(path, "w") do |f|
              f.write(YAML::dump(data))
            end
          end
        else
          data = yield
        end

        return data
      end
    end

    class Photo < APIWrapper
      PHOTO_SIZES = { square: 'q', thumbnail: 't', small: 'm', small320: 'n', medium: 'z', large: 'b', large1600: 'h', original: 'o'}

      attr_reader :photo_id

      def initialize(photo_id)
        if photo_id.is_a? String
          @photo_id = photo_id
        else
          @data = photo_id
          @photo_id = data['photo_id']
        end
      end

      def data
        @data ||= client.get_photo_info photo_id
      end

      def url(size = :medium)
        size = PHOTO_SIZES[size] if PHOTO_SIZES.key? size

        "https://farm#{farm}.staticflickr.com/#{server}/#{id}_#{secret}_#{size}.jpg"
      end

      def data_hash
        variables = {
          "id" =>    id,
          "title" => title,
          "description" => data["description"],
        }

        if dates = data["dates"]
          variables["date"] = Time.parse(dates["taken"])
        end

        if owner = data["owner"]
          variables["username"] = owner["username"]
          variables["author_name"] = owner["realname"],
          variables["url"] = "https://www.flickr.com/photos/#{data["owner"]["path_alias"]}/#{id}"
        end

        variables["img"] = {}
        PHOTO_SIZES.each do |size, _|
          variables["img"][size.to_s] = url(size)
        end

        variables
      end
    end

    class PhotoSet < APIWrapper
      attr_reader :photoset_id

      def initialize(photoset_id)
        @photoset_id = photoset_id
      end

      def data
        @data ||= client.get_photoset_info photoset_id
      end

      def photos
        @photos ||= begin
            raw = client.get_photos photoset_id
            raw['photo'].lazy.map do | photo_raw |
              Photo.new photo_raw
            end
        end
      end

    end

    class PhotoTag < Jekyll::Tags::IncludeTag
      include Jekyll::LiquidExtensions

      attr_reader :photo_id, :photo

      def initialize(tag_name, markup, token)
        super

        @photo_id = @file
        @file = "flickr/photo.html"
      end

      def render(context)
        if @photo_id =~ /([\w]+\.[\w]+)/i
          @photo_id = lookup_variable(context, set_id)
        end

        @photo = Jekyll::Flickr::Photo.new @photo_id.strip

        context.stack do
          context["photo"] = photo.data_hash

          super
        end
      end
    end

    class AlbumTag < Jekyll::Tags::IncludeTag
      include Jekyll::LiquidExtensions

      attr_reader :set_id, :set

      def initialize(tag_name, markup, token)
        super

        @set_id = @file
        @file = "flickr/album.html"
      end

      def render(context)
        if set_id =~ /([\w]+\.[\w]+)/i
          @set_id = lookup_variable(context, set_id)
        end

        @set = Jekyll::Flickr::PhotoSet.new set_id

        variables = {
          "id" => set.id,
          "username" => set.username,
          "title" => set.title,
          "description" => set.description,
          "date" => Time.at(set.date_create.to_i),
          "photos" => []
        }

        set.photos.each do |photo|
          variables["photos"] << photo.data_hash
        end

        context.stack do
          context["album"] = variables

          super
        end
      end
    end
  end
end

Liquid::Template.register_tag('flickr_photo', Jekyll::Flickr::PhotoTag)
Liquid::Template.register_tag('flickr_album', Jekyll::Flickr::AlbumTag)

# Jekyll::Hooks.register :site, :pre_render do |site|
#   Jekyll::Flickr.initialize
# end

module FlickRaw
  class Response
    def key?(key)
      @h.key? key
    end
  end
end
