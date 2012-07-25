<?php

// Slim handles redirects automatically for routes that end with a slash

return array(
    'index' =>
        array('/', 'Index.render'),

    'old_index' =>
        array('index/', 'StaticPage.redirect_to_index'),

    'redirect' =>
        array('/redirect/(#:vendor/:type/:url)', 'Redirect.render'),

    'static_page' =>
        array('/:page/', 'StaticPage.page', 
            'conditions' => array(
                'page' => 'about|help|faq|link|open-source'
            )),

    'save_page_email_multicampus' =>
        array('/email/save/:email/:school/:campus/:term/:ids', 'Email.savePage'),

    'save_page_email_singlecampus' =>
        array('/email/save/:email/:school/:term/:ids', 'Email.savePage'),

    'friend_email_multicampus' =>
        array('/email/friend/:fromEmail/:toEmail/:school/:campus/:term/:id', 'Email.sendPage'),

    'friend_email_singlecampus' =>
        array('/email/friend/:fromEmail/:toEmail/:school/:term/:id', 'Email.sendPage'),

    'get_campuses' =>
        array('/get/campuses/:school', 'AjaxContent.campuses'),

    'get_terms' =>
        array('/get/terms/:campus', 'AjaxContent.terms'),

    'get_departments' =>
        array('/get/departments/:term', 'AjaxContent.departments'),

    'get_courses' =>
        array('/get/courses/:department', 'AjaxContent.courses'),

    'get_sections' =>
        array('/get/sections/:course', 'AjaxContent.sections'),

    'get_singlecampus_autocomplete' =>
        array('/get/autocomplete/:school/:term/:query', 'AjaxContent.section_autocomplete'),

    'get_multicampus_autocomplete' =>
        array('/get/autocomplete/:school/:campus/:term/:query', 'AjaxContent.section_autocomplete'),

    'get_singlecampus_section' =>
        array('/get/section/:school/:term/:section', 'AjaxContent.section'),

    'get_multicampus_section' =>
        array('/get/section/:school/:campus/:term/:section', 'AjaxContent.section'),

    'get_book' =>
        array('/get/book/:isbn', 'AjaxContent.book'),

    'get_multicampus_results' =>
        array('/get/results/:school/:campus/:term/:ids', 'AjaxContent.results'),

    'get_singlecampus_results' =>
        array('/get/results/:school/:term/:ids', 'AjaxContent.results'),

    'get_isbn_results' =>
        array('/get/results/:ids', 'AjaxContent.results'),

    'cart' =>
        array('/cart/:vendor/:ids/:tag', 'CartRedirect.render', 
            'conditions' => array(
                'vendor' => 'amazon'
            )),

    'abebooks' =>
        array('/abebooks/:isbns', 'AbeBooksRedirect.render'),

    'isbn_selection' =>
        array('/selection/', 'Selection.render'),

    'index_with_school' =>
        array('/:school/', 'Index.render'),

    'selection' =>
        array('/:school/selection/', 'Selection.render'),

    'isbn_results' =>
        array('/results/:ids', 'Results.render'),

    'multicampus_results' =>
        array('/:school/results/:campus/:term/:ids', 'Results.render'),

    'singlecampus_results' =>
        array('/:school/results/:term/:ids', 'Results.render'),

);
