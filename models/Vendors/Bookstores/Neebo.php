<?php

/**
 * This bookstore implementation is incomplete.
 */

/**
 * This file incorporates code from Open-Textbooks by TextYard.com.  
 * Open-Textbooks is copyright 2012 Ben Greenberg and released under the MIT 
 * License.  The project and license can be found at
 * https://github.com/bsgreenb/Open-Textbooks.  The original license is reproduced below.
 *
 * The MIT License (MIT)
 * 
 * Copyright © 2012 Ben Greenberg
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the “Software”), to deal
 * in the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

class NeeboError extends BookstoreError {}

class Neebo extends BaseBookstore implements Vendor, Bookstore {
    public static function getUrl(array $prices) {

    }

    public static function getSectionsUrl($sections, $school) {

    }

    public static function getItemUrl($school, $item) {

    }

    public static function getItemSubtotal($item) {
        // in-store availability of used options is not guaranteed
        return $item['BNew'];
    }

    public static function showAsterisk() {
        return true;
    }

    public static function getTax($subtotal, $state=null) {
        return 0;
    }

    protected static function doRequest($path, $data=null) {
        if ($data !== null && !isset($_SESSION['NeeboSession'])) {
            self::get("http://www.neebo.com/{$data['SchoolBId']}");
            $_SESSION['NeeboSession'] = true;
        }

        return self::get("http://www.neebo.com/$path");
    }


    public static function getTerms($data) {
        $doc = new DOMDocument();
        @$doc->loadHTML(self::doRequest("{$data['SchoolBId']}"));
        $finder = new DomXPath($doc);
        $select = $finder->query('//select[@id="school-term-select"]');

        if ($select->length != 0) {
            $ret = array();
            $select = $select->item(0);

            for ($i = 0; $i < $select->childNodes->length; $i++) {
                $option = $select->childNodes->item($i);
                $ret[] = array(
                    'BId' => $option->getAttribute('value'),
                    'Name' => $option->nodeValue
                );
            }

            return $ret;
        } else {
            throw new NeeboError("Missing term select tag response for {$data['BId']}");
        }
    }

    public static function getDepts($data) {
        $doc = new DOMDocument();
        $path = 'Course/GetDepartments?termId=' . urlencode($data['BId']);
        @$doc->loadHTML(self::doRequest($path, $data));
        $finder = new DomXPath($doc);
        $as = $finder->query('//ul[@class="dept-list filtered"]//a');

        if ($as->length != 0) {
            $ret = array();

            for ($i = 0; $i < $as->length; $i++) {
                $a = $as->item($i);
                $dept_td = $finder->query('..//td', $a)->item(0);
                $ret[] = array(
                    'Abbr' => trim($dept_td->nodeValue), 
                    'BId' => trim($a->getAttribute('id'))
                );
            }

            return $ret;
        } else {
            throw new NeeboError("Missing department ul for {$data['BId']}");
        }
    }

    public static function getCourses($data) {
        $doc = new DOMDocument();
        $path = 'Course/GetCourses?departmentId=' . urlencode($data['BId']);
        @$doc->loadHTML(self::doRequest($path, $data));
        $finder = new DomXPath($doc);
        $lis = $finder->query('//ul[@class="course-list filtered"]/li');

        if ($lis->length != 0) {
            $ret = array();
            for ($i = 0; $i < $lis->length; $i++) {
                $li = $lis->item($i);
                $course_code = $li->childNodes->item(1)->nodeValue;
                $course_value = null;
                $sections = array();
                
                $section_as = $finder->query('.//ul/li/a', $li);

                if ($section_as->length) {
                    for ($j = 0; $j < $section_as->length; $j++) {
                        $section_a = $section_as->item($j);
                        $sections[] = array(
                            'BId' => trim($section_a->getAttribute('id')),
                            'Num' => trim($section_a->nodeValue),
                            'RequiresBooks' => true
                        );
                    }
                }

                $ret[] = array(
                    'BId' => trim($course_code),
                    'Num' => trim($course_value),
                    'Sections' => $sections
                );
            }

            return $ret;
        } else {
            throw new NeeboError("Missing course ul for {$data['BId']}");
        }
    }

    public static function getSections($data) {
        // sections are gotten at the same time as courses.
        
        // this is a hack
        return $data->getSections();
    }

    public static function getSectionsHaveItems($sections) {

        $result_url = $base . 'Course/Results';

        foreach ($sections as $section) {
            self::doRequest('CourseMaterials/AddSection?sectionId=' . urlencode($section['BId']), $sections[0]);
        }

        $doc = new DOMDocument();
        @$doc->loadHTML(self::doRequest('Course/Results', $sections[0]));
        $finder = new DomXPath($doc);

        $ret = array();
        foreach ($finder->query('//div[@class="course-info"]') as $course) {
            $tds = $finder->query('//td[@class="course-materials-description"]', $course);

            $items = array();
            foreach ($tds as $td) {
                $item = array();
                $item['Title'] = $finder->query('.//p[@class="title"]', $td)->item(0)->nodeValue;

                $info = explode('<br>', innerHTML($finder->query('.//p[@class="info"]', $td)->item(0)));
                foreach ($info as $subject) {
                    list($key, $value) = array_map('trim', explode(':', strip_tags($subject)));

                    if ($key == 'Edition') { //we need to get Edition and Publisher here..
                        $values = explode(',', $value);
                        $item['edition'] = trim($values[0]);
                        //$item['Year'] = preg_replace('([^0-9]*)', '', $values[1]); 
                    } else if ($key == 'Author') {
                        $item['author'] = $value;
                    } else if ($key == 'ISBN' && Isbn::validate(Isbn::clean($value))) {
                        $item['isbn'] = $value;
                    }
                }

                $required = strtolower($finder->query('.//a[@rel="/Help/RequirementHelp"]//strong', $td)->item(0)->nodeValue);

                $item['isComponent'] = ($required == 'part of set');

                if ($required == 'required') {
                    $required = SectionHasItem::REQUIRED;
                } else if ($required == 'recommended' || $required == 'optional') {
                    $required = SectionHasItem::RECOMMENDED;
                } else if ($required == 'neebo-suggested') {
                    $required = SectionHasItem::BOOKSTORE_RECOMMENDED;
                } else {
                    $required = SectionHasItem::REQUIRED;
                }

                $item['requiredStatus'] = $required;

                $prices = $finder->query('.//td[@class="course-product-price"]/label');
                $priceList = array();
                foreach ($prices as $price) {
                    $priceList[] = preg_replace('([^0-9\.]*)', '', $price->nodeValue);
                }

                $item['BNew'] = max($priceList);
                $items[] = $item;
            }

            list(, $sectionId) = explode('=', $finder->query('//h4/a', $course)->item(0)->getAttribute('href'));
            $ret[$sectionId] = self::processItems($items);
        }

        return $ret;
    }	

    public static function getSchools() {
        $dom = new DOMDocument();
        $dom->loadHTML(self::get("http://www.neebo.com/School/List"));
        $xpath = new DomXPath($dom);
        $schools = $xpath->query('//tr[@class="even"]/td/a | //tr[@class="odd"]/td/a');

        $ret = array();

        foreach ($schools as $schoolNode) {
            $bId = ltrim($schoolNode->getAttribute('href'), '/');
            $name = trim($schoolNode->nodeValue);

            $ret[] = array(
                'BId' => $bId,
                'Slug' => $bId,
                'Subdomain' => $bId,
                'Name' => $name
            );
        }

        return $ret;
    }

}
