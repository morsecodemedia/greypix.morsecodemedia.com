# GreyPix Photo Blog
- - - -
## Server Requirements
At the time of development, I am running:

- Ubuntu 14.04
- Apache 2.4.7
- PHP 5.5.9
- MySQL 5.5.44

## Front-End
For this project, I opted not to design and develop the front-end, instead I purchased a template. The Outdoor Photography/Portfolio Template was developed by user [KWST](https://themeforest.net/user/kwst). 

### CSS
- [Bootstrap 3.X](http://getbootstrap.com/)

### Javascript
- [Easing](http://gsgd.co.uk/sandbox/jquery/easing/)
- [Font Awesome 4.3](http://fortawesome.github.io/Font-Awesome/)
- [Superslides](https://github.com/nicinabox/superslides)
- [Owl Carousel](http://www.owlcarousel.owlgraphic.com/)
- [Isotope](http://isotope.metafizzy.co/)
- [Magnific Popup](http://dimsemenov.com/plugins/magnific-popup/)

## Back-End
- [CodeIgniter 3.X](https://codeigniter.com)
- [phpFlickr Wrapper](https://github.com/dan-coulter/phpflickr)
- [Flickr API CodeIgniter Library](https://github.com/desta88/Flickr-API-Codeigniter)

Being that the wrapper and the CI library utilizing the wrapper were both written prior to BCIT taking over development from EllisLabs, there were some tweaks that needed ot be made for everything to play nice with the new CI 3.X.

### CodeIgniter Customizations
- TBD

### Flickr API
- TBD

- - - -
#To-Do
## Project Overall
- Documentation
- Create logo
- Write blog post
- Create project page on morsecodemedia.com

## Photography Section

- Update the database scheme - there doesn't need to be a picture_sizes_lookup. This will require rewriting a large portion of the import and the rendering functionality - however, reducing the amount of database calls should help the speed issue.
- Create functionality to remove photos/albums from database that no longer return from Flickr API
- Implement tagging on albums
	- Create filtering functionality
- Implement Database Caching
	
## Video Section
- Implement Vimeo API
- Build out Video functionality