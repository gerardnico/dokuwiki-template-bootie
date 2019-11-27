# dokuwiki-template-bootie

## About

`Bootie` is a [Dokuwiki Template](https://www.dokuwiki.org/template:bootie) integrating the [bootstrap technology](http://getbootstrap.com/) developed for the site [gerardnico.com](http://gerardnico.com)

Developed with PHP 7.2.5.

## Features

  
  * [Top Fixed Navbar](http://getbootstrap.com/components/#navbar-fixed-top)
  * `Footer` page called `footerbar`. Same functionality than for the [sidebar](https://www.dokuwiki.org/faq:sidebar#i_have_a_sidebar_functionality_how_can_i_create_or_edit_a_sidebar_now) but with a page called `footer`.
  * `header` page called `headerbar`. Same functionality than for the [sidebar](https://www.dokuwiki.org/faq:sidebar#i_have_a_sidebar_functionality_how_can_i_create_or_edit_a_sidebar_now) but with a page called `footer`.
  * `Right` page called `rightbar`. Same functionality than for the [sidebar](https://www.dokuwiki.org/faq:sidebar#i_have_a_sidebar_functionality_how_can_i_create_or_edit_a_sidebar_now) but with a page called `footer`. 
  * Performance: All Javascript and CSS stylesheet are served asynchronously (defer for js and at the end for css)
  * Resources (Javascript or Stylesheet) served from CDN or locally
  * Load the third library via CDN or locally

Options:

  * `Menu in sidebar` via [Panel](http://getbootstrap.com/components/#panels-heading) with the [mini-map plugin](https://gerardnico.com/dokuwiki/minimap). It will add a list of page of the current namespace.
  * `Headers numbering` and [Toc](https://www.dokuwiki.org/toc) below the first header with the [Rplus rendering](https://www.dokuwiki.org/plugin:rplus) plugin

## Configuration

The configuration can be change with the [Configuration Manager Plugin](https://www.dokuwiki.org/plugin:config)

  * `footer`: the footer name page to search. Default to `footerbar`
  * `header`: the header name page to search. Default to `headerbar`
  * `right`: the name page if the right side bar. Default to `rightbar`
  * `cdn`: if this configuration switch is on, you'll get the Javascript whenever possible from a CDN

Other configuration:

  * Add you icon by creating a svg file at one of this location:
     * :wiki:logo.svg
     * or :logo.svg
  
## Support

  * The [styling plugin](https://www.dokuwiki.org/plugin:styling) will complain that it doesn't found some Javascript. You can disable it
    
## Release

### Current

  * Breaking changes: 
     * the grid is now 1280 large on 16 columns which means that the bootstrap CSS is served locally
     * the sidebar is now on the left side
  * A new sidebar `rightbar` was introduced.

### 2019-06-14

  * Added a header and footer bar functionality
  * Add the CDN configuration possibility
  * The toolbar (pagetool) is now on the right side relative positioned
  * Added two events (TPL_DOCUMENT_CLOSING, TPL_PAGE_TOP_OUTPUT) to be able to output HTML
  
### 2019-03-11

Performance release:

  * All Javascript and CSS stylesheet are served asynchronously (defer for js and at the end for css)
  * The addition of the resources are now done via the call of a event system (TPL_METAHEADER_OUTPUT)
  * The dokuwiki jquery.php script is removed only in the SHOW act (when displaying a page) and is replaced by the bootstrap one.
  * The resources can be served locally in order to work without connection

### 2018-07-21

  * Works now on Bootstrap 4
  * The new [menu system](https://www.dokuwiki.org/devel:menus) was implemented
   
### 2017-02-22 (Frusterick Manners)

  * Bootstrap 3.3.7 - The dokuwiki "Frusterick Manners" version comes with Jquery 3.0 and Bootstrap 3.3.6 doesn't allow that.



## Note

  * The site tool and the page tool are in the same menu called Tools.
  
  * There is two entry points:
  
     * the file [main.php](main.php) - that shows the page
     * the file [detail.php](detail.php) - that shows the image

## Todo ?

  * [JqueryUI Bootstrap](https://cdn.rawgit.com/arschmitz/jqueryui-bootstrap-adapter/v0.3.0/index.html)
  * [tagline](https://www.dokuwiki.org/config:tagline) is used in the [manifest](https://www.dokuwiki.org/devel:manifest) description
  
## Dev Note

  * To beat the CSS cache, just open the file `local.php` and modify it