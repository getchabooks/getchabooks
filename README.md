GetchaBooks
===========

[GetchaBooks.com](http://getchabooks.com/) is a web service that combines
school textbook listings with an easy-to-use price comparison system. For more
information, see http://getchabooks.com/about and
http://getchabooks.com/open-source.

GetchaBooks is licensed under the MIT License.  We hope you'll use the code to
create your own version of GetchaBooks at your school, as long as you use
a different name and different branding. GetchaBooks.com is no longer being
actively developed, but we will still gladly accept pull requests that fix bugs or 
add new functionality.

Features
--------

A PHP/MySQL backend built with [Slim](http://slimframework.com) and
[Propel](http://propelorm.org), including:

- a comprehensive multi-book price comparison engine
- an efficient bookstore scraping system with real-time and batch modes
- the ability to augment limited bookstore metadata with department, course, and
  professor names, which increases usability
- fast results page loading through prefetching of bookstore results and online
  prices

An easy-to-use front-end optimized for desktop (modern WebKit, Gecko, Opera, and
IE8+) and tablet web browsers, including:

- a streamlined interface for selecting a school, term, and courses or simply
  entering ISBNs
- a results interface with both a plain English summary of the best combined
  options and a grid displaying all book prices
- a comprehensive analytics system to gather data on user behavior patterns

Dependencies
------------

GetchaBooks works out of the box with Apache, but should work with any server
that supports URL rewriting.  Just have your server configuration point to
`public/`, and be sure to enable the `FollowSymlinks` option.

GetchaBooks requires PHP 5.3+, MySQL, [Propel](http://propelorm.org)
1.6.5 (although other versions may work), and Memcached. These can be
installed on Ubuntu as follows:

    sudo apt-get install apache2 libapache2-mod-php5 mysql-server php5-mysql \
    php5-cli memcached php5-memcache

    pear channel-discover pear.propelorm.org
    pear install -a propel/propel_generator
    pear install -a propel/propel_runtime

Other dependencies are handled using git submodules, so you will need to run
`git submodule init && git submodule update` after cloning the repository.

Additionally, our CSS and JS minification tools (installed via git submodule)
require Ruby and Node.js to be installed.

Setup
-----

    # edit config.php to specify API keys, affiliate IDs, etc.
    cp config/config.php.example config/config.php

    # edit build.properties and runtime-conf.xml to specify db connection
    cd models/propel
    cp build.properties.example build.properties
    cp runtime-conf.xml.example runtime-conf.xml

    # rebuild propel runtime files from configuration files
    propel-gen

    # create and initialize databases
    mysql -u root -p
    $ create database gbprod;
    $ use gbprod;
    $ source sql/schema.sql
    $ create database gbdev;
    $ use gbdev;
    $ source sql/schema.sql

    # edit XML files to define some schools
    cd ../../
    vim config/BnCollege.xml

    # load schools from XML files into database
    ./gb load

    # generate schools.json, which is cached and used to build the homepage
    ./gb json

    # make logs writeable
    touch error_log slim_log

Usage
-----

There are several flags defined in `init.php` that affect site behavior, which
are set based on the existence of dummy files in the root directory.  Most
significantly, the `production` flag determines which database and memcached
prefix are used and whether to point to native JS and CSS files or minified and
packaged versions.

There are a number of scripts that can be run by doing `./gb <script> [args]`
from the root directory, including:

    # Switch to a given mode and re-package assets
    ./gb {prod,dev}

    # Tell Sass daemon to watch the stylesheets and update their corresponding
    # .css files with each change
    ./gb watch

    # Spider all schools, but only down to departments.  This ensures that the
    # first load of the selection page will be fast for all schools.
    ./gb spider

    # Fully spider the bookstore dropdown data for a particular school. This
    # enables lightning-fast dropdowns.
    ./gb spider <school slug>

    # Fetch metadata (department, course and professor names) about all known
    # data for a school
    ./gb courseinfo <school slug>

Extending the Codebase
----------------------
You can add functionality to GetchaBooks by writing a new implementation of one
of three interfaces:

- A `Vendor` represents an online bookseller, with methods for fetching price
  information and generating referral URLs. GetchaBooks currently supports
  Amazon, Amazon Marketplace, Half, AbeBooks, and Chegg.

- A `Bookstore`, which is also a `Vendor`, represents an online college
  bookstore system, with a fully de-coupled interface for fetching data from the
  School->Campus->Term->Department->Course->Section->Books hierarchy.

  GetchaBooks currently supports BNCollege and Follett bookstores, with
  implementations for four other bookstore chains based on TextYard.com's
  [Open-Textbooks](https://github.com/bsgreenb/Open-Textbooks) library in the
  works.

- Bookstore websites use department abbreviations and course and section numbers
  for selecting courses, which is difficult if you don't remember your course or
  section number. GetchaBooks allows you to provide a better experience by
  defining a school `CourseInfoProvider` that provides department names, course
  names, and professor names. Schools with course info also give the user the
  option of using an autocompletion interface for selecting courses instead of
  dropdowns.

Making It Your Own
------------------
The code to GetchaBooks is open for you to use however you want.
However, the GetchaBooks name and logo are trademarked. If you use our codebase,
we ask you to come up with your own unique brand distinct from ours.
Customizing the site is easy:

- All colors used on the site are defined as SASS variables in the
  `_constants.scss` file.

- The logo in the top-left corner is `public/images/logo.png`. You'll need to
  throw in your own image file, as we have not included our trademarked
  GetchaBooks assets. You'll also likely want to include your own favicon
  (`favicon.ico`), FB open graph image (`og_image.png`), and iOS home screen
  icon (`apple-touch-icon-precomposed[-retina].png`).

- `config/config.php` contains variables that determine the site name, referral
  tags, Google Analytics ID, outgoing Facebook and Twitter URLs (if any), and
  other customizable aspects of the site.

Above all, don't be afraid of coming up with a brand that's opinionated.
Although it's easy to launch your own generic GetchaBooks-like site that works
at hundreds of schools, we recommend focusing on a single school or geographical
region where you can put a concerted effort into marketing. Despite our best
efforts to support as many colleges as possible, we found that we did best by
focusing on a small number of schools where we were able to make a meaningful
impact.

Designing a brand around a single school (using school colors, including the
school's name or sports mascot in the title, etc) is a great way to set yourself
up for success, especially if it's a school you're familiar with.

Related Work
------------

While developing GetchaBooks, we came across a number of people creating
similar services. As we made technical and design decisions, we were grateful
for the opportunity to learn from their work.

- [Book.ly](http://book.ly)
- [CrimsonReading][1]
- [FindMyText](http://findmytext.com)
- [NinjaBooks](http://ninjabooks.com)
- [Slugbooks](http://www.slugbooks.com)
- [SwoopThat](http://www.swoopthat.com)
- [TextbookFind](http://www.textbookfind.com)
- [TextYard](http://www.textyard.com) (who open sourced their [textbook API][2])

[1]: http://www.thecrimson.com/article/2009/5/8/the-coop-issues-legal-threat-against/
[2]: http://www.textyard.com/blog/an-open-source-solution-to-expensive-textbooks/

Authors
-------

- Ricky Mondello (<rmondello@gmail.com>)
- Mike Walker (<michael.scott.walker@gmail.com>)
- Mike White (<m@mwhite.info>; https://www.gittip.com/mwhite/)
