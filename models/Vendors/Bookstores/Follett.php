<?php

class FollettError extends BookstoreError {}

class Follett extends BaseBookstore implements Vendor, Bookstore {

    protected static $proxy = array(PROXY2_URL, PROXY2_AUTH);

    public static function getUrl(array $prices) {
        global $school, $sections, $numItems;

        return self::getSectionsUrl($sections, $school);
    }

    public static function getSectionsUrl($sections, $school) {
        return "http://www.bkstr.com/Home/10001-" . $school['BId'] . "-1?demoKey=d";
    }

    public static function getItemUrl($school, $item) {

    }

    public static function getItemSubtotal($item) {
        $used = $item['BUsed'];
        $new = $item['BNew'];

        if ($used && $new) {
            return min($used, $new);
        } else if ($used || $new) {
            return $used ?: $new;
        } else {
            return null;
        }
    }

    public static function showAsterisk() {
        return false;
    }

    public static function getTax($subtotal, $state=null) {
        return 0;
    }

    protected static function doFollettRequest($obj, $view, array $data) {
        $base = "http://www.bkstr.com/webapp/wcs/stores/servlet/";

        $storeId = $obj instanceof School ? $obj['BId'] : $obj['SchoolBId'];
        $referer = "http://www.bkstr.com/Home/10001-$storeId-1";

        static $uses = 0;
        if (++$uses % 10 == 0 || !isset($_SESSION['FollettSession'])) {
            self::get($referer);
            $_SESSION['FollettSession'] = true;
        }

        if ($view == 'LocateCourseMaterialsServlet') {
            $params = array(
                'demoKey' => 'd',
                'storeId' => $storeId,
                '_' => ''
            );
        } else {
            $params = array();
        }

        $params = array_merge($params, $data);

        // todo: check whether CURLOPT_HTTPPROXYTUNNEL as used in Open-Textbooks is necessary
        $r = self::get($base . $view, $params, array(CURLOPT_REFERER => $referer));

        if ($view == 'LocateCourseMaterialsServlet') {
            if (strpos($r, 'ERROR') === false && preg_match("/({.+})/", $r, $matches)) {
                $json = json_decode($matches[1], true);
                return $json['data'][0];
            } else {
                throw new FollettError("Unrecognized Follett dropdown response: $r");
            }
        } else {
            return $r;
        }

    }

    public static function getCampuses($data) {
        $campuses = self::doFollettRequest($data, 'LocateCourseMaterialsServlet', array(
            'requestType' => 'INITIAL',
        ));

        $ret = array();
        foreach ($campuses as $name => $id) {
            $ret[] = array(
                'BId' => html_entity_decode($id),
                'Name' => html_entity_decode($name)
            );
        }

        return $ret;
    }

    public static function getTerms($data) {
        $terms = self::doFollettRequest($data, 'LocateCourseMaterialsServlet', array(
            'requestType' => 'TERMS',
            'programId' => $data['BId']
        ));

        $ret = array();
        foreach ($terms as $name => $id) {
            $ret[] = array(
                'BId' => html_entity_decode($id),
                'Name' => html_entity_decode($name)
            );
        }

        return $ret;
    }

    public static function getDepts($data) {
        $divisions = self::doFollettRequest($data, 'LocateCourseMaterialsServlet', array(
            'requestType' => 'DIVISIONS',
            'programId' => $data['CampusBId'],
            'termId' => $data['BId']
        ));

        // we don't support parts of follett school trees that require
        // Divisions. Spidering a school down to departments will make sure all
        // such parts of its tree will be deleted.
        if (count($divisions) > 1) {
            error_log("Term requires divisions, disabling "
                      . "(School {$data['SchoolBId']}, Term {$data['BId']})");
            return false;
        }

        $depts = self::doFollettRequest($data, 'LocateCourseMaterialsServlet', array(
            'requestType' => 'DEPARTMENTS',
            'programId' => $data['CampusBId'],
            'termId' => $data['BId'],
        ));

        $uniquePrefix = "{$data['SchoolBId']}.{$data['CampusBId']}.{$data['BId']}";

        $ret = array();
        foreach ($depts as $abbr) {
            $abbr = html_entity_decode($abbr);
            $ret[] = array(
                'BId' => "$uniquePrefix.$abbr",
                'Abbr' => $abbr
            );
        }

        return $ret;
    }

    public static function getCourses($data) {
        $courses = self::doFollettRequest($data, 'LocateCourseMaterialsServlet', array(
            'requestType' => 'COURSES',
            'programId' => $data['CampusBId'],
            'termId' => $data['TermBId'],
            'divisionName' => ' ',
            'departmentName' => $data['Abbr']
        ));

        $uniquePrefix = "{$data['SchoolBId']}.{$data['CampusBId']}"
                        . ".{$data['TermBId']}.{$data['Abbr']}";

        $ret = array();
        foreach ($courses as $num) {
            $num = html_entity_decode($num);
            $ret[] = array(
                'BId' => "$uniquePrefix.$num",
                'Num' => $num
            );
        }

        return $ret;

    }

    public static function getSections($data) {
        $sections = self::doFollettRequest($data, 'LocateCourseMaterialsServlet', array(
            'requestType' => 'SECTIONS',
            'programId' => $data['CampusBId'],
            'termId' => $data['TermBId'],
            'divisionName' => ' ',
            'departmentName' => $data['DeptAbbr'],
            'courseName' => $data['Num']
        ));

        $uniquePrefix = "{$data['SchoolBId']}.{$data['CampusBId']}.{$data['TermBId']}"
                        . ".{$data['DeptAbbr']}.{$data['Num']}";

        $ret = array();
        foreach ($sections as $num) {
            $num = html_entity_decode($num);
            $ret[] = array(
                'BId' => "$uniquePrefix.$num",
                'Num' => $num,
                'RequiresBooks' => 1
            );
        }

        return $ret;
    }

    public static function getSectionHasItems($section) {
        $params = array(
            'catalogId' => '10001',
            'categoryId' => '9604',
            'storeId' => $section['SchoolBId'],
            'langId' => '-1',
            'programId' => $section['CampusBId'],
            'termId' => $section['TermBId'],
            'divisionDisplayName' => ' ',
            'departmentDisplayName' => $section['DeptAbbr'],
            'courseDisplayName' => $section['CourseNum'],
            'sectionDisplayName' => $section['Num'],
            'demoKey' => 'd',
            'purpose' => 'browse'
        );

        $result = self::doFollettRequest($section, 'CourseMaterialsResultsView',
                                          $params);

        if (!$result) {
            throw new FollettError("Empty response for section " . $section['Slug']);
        }

        if (preg_match('/courseId_1"[^\>]*value\="(\d+)"/', $result, $matches)) {
            $sectionNum = $matches[1];
        }

        if (preg_match('/No\sInformation\sReceived/', $result)
            || preg_match('/No\sinformation\sregarding/', $result))
        {
            return array();
        }

        if (preg_match('/No\sBooks\sRequired/', $result)) {
            return null;
        }

        if (preg_match('/course_notes_label"\>.+?\<\/p\>(.+?)\</s', $result, $matches)) {
            $courseNote = $matches[1];
            error_log("Course note for " . $section['Slug'] . ":  $courseNote");
            // todo!!! -- some sections specify here that they require the books 
            // that a particular other section requires
        }

        $result = substr($result, strpos($result, 'efMaterialHeader'));

        // bookstore suggested items may contain package components of required items
        $indices = array(
            SectionHasItem::REQUIRED    => strpos($result, 'Required'),
            SectionHasItem::RECOMMENDED => strpos($result, 'Recommended'),  // todo: verify is correct string
            SectionHasItem::BOOKSTORE_RECOMMENDED => strpos($result, 'Suggested'),
            'END' => 10000000
        );

        $indices = array_filter($indices, function($i) {
            return $i !== false;
        });

        if (!$indices) {
            throw new FollettError("nothing found for Section {$section['Slug']}");
        }

        uasort($indices, function($i,$j) {
            return $i < $j ? -1 : 1;
        });

        $ret = array();

        $statuses = array_keys($indices);
        $indexValues = array_values($indices);
        for ($i=0, $c=count($indices); $i<$c-1; $i++) {
            $text = substr($result, $indexValues[$i], $indexValues[$i+1]);
            $items = explode('materialRow', $text);
            unset($items[0]);
            foreach ($items as $item) {
                if (strpos($item, 'Digital') && !(strpos($item, 'New') || strpos($item, 'Used'))) {
                    continue;
                }
                $details = self::processItemText($item, $section);
                if (!isset($details['author']) && !isset($details['isbn']) && !isset($details['title'])) {
                    continue;
                }
                $details['requiredStatus'] = $statuses[$i];
                $ret[] = $details;
            }
        }

        /*if (preg_match('/courseId_1[^>]+value\="(\d*)"/', $items[1], $matches)) {
            $section->setFId($matches[1])->save();            // todo: enable
        }*/

        return $ret;
    }

    protected static function processItemText($item) {
        $details = array();
        if (preg_match('/Author\:\&nbsp\;([^<]*)\</', $item, $matches)) {
            $details['author'] = ucname(trim($matches[1]));
        }
        if (preg_match('/Edition\:\&nbsp\;([^<]*)\</', $item, $matches)) {
            $details['edition'] = trim($matches[1]);
        }
        if (preg_match('/src\="(http[^"]+([X0-9]{10,13}|noBookImage)[^"]+?)"[^>]*?alt\="([^"]+?)"/', $item, $matches)) {
            if (strpos($matches[1], 'noBookImage')) {
                $details['imageUrl'] = false;
                $details['isbn'] = null;
            } else {
                $details['imageUrl'] = trim($matches[1]);
                $details['isbn'] = Isbn::to13(Isbn::clean($matches[2]));
            }

            $details['title'] = titleCase(trim(html_entity_decode($matches[3])));
        }
        $details['newPrice'] = $details['usedPrice'] = null;
        if (!strpos($item, 'Buy Digital') && preg_match('/buynewradio[^>]+?\>\s*?\$([\d\.]+)/', $item, $matches)) {
            $details['newPrice'] = $matches[1];
        }
        if (preg_match('/buyusedradio[^>]+?\>\s*?\$([\d\.]+)/', $item, $matches)) {
            $details['usedPrice'] = $matches[1];
        }
        if (preg_match('/ISBN:\s*(?:\&nbsp\;)?(\d{10,13})/', $item, $matches)) {
            $details['isbn'] = Isbn::to13(Isbn::clean($matches[1]));
        }
        
        // lowercase c in catEntry ensures that the rental item id is not selected, because it is like rentalCatEntry.
        //  the new item id seems to always be exactly one less than the used
        // note: we don't use this as a unique identifier because we don't want to deal with which
        // is used and which is new, and because availability changes
        if (preg_match_all('/catEntryId_\d+[^>]+?value\="(\d*)"/', $item, $matches)) {
            //$details['productId'] = count($matches[1] == 1) ? $matches[1][0] : call_user_func_array('min', $matches[1]);
        }
        $details['partNumber'] = null;
        $details['publisher'] = null;
        $details['isPackage'] = false;
        $details['components'] = array();

        return $details;

    }

    protected static function getState($stateAbbrev) {   
        self::get("http://www.efollett.com");
        
        $url = 'http://www.efollett.com/webapp/wcs/stores/servlet/StoreFinderAJAX?requestType=INSTITUTESUS'
            . '&pageType=FLGStoreCatalogDisplay&pageSubType=US&langId=-1&demoKey=d&stateProvinceId='
            . $stateAbbrev ;     
        preg_match("/({.+})/", self::get($url), $matches);
        $json = json_decode($matches[1], true);

        $ret = array();
        foreach ($json['data'][0] as $name => $id) {
            $ret = array_merge($ret, self::getInstitution($id, $name, $stateAbbrev));
        }
        return $ret;

    }

    protected static function getInstitution($id, $schoolName, $stateAbbrev) {
        $url = "http://www.efollett.com/webapp/wcs/stores/servlet/StoreFinderAJAX?requestType=CAMPUSUS"
            . "&pageType=FLGStoreCatalogDisplay&pageSubType=US&langId=-1&demoKey=d&institutionId=$id&_=";           

        preg_match("/({.+})/", self::get($url), $matches);
        $json = json_decode($matches[1], true);

        $singleCampus = (count($json['data'][0]) <= 1);

        $ret = array();
        foreach ($json['data'][0] as $name => $id) {
            $ret[] = self::getCampus($id, $name, $schoolName, $singleCampus, $stateAbbrev);
        }

        return $ret;
    }

    protected static function getCampus($id, $campusName, $schoolName, $singleCampus, $stateAbbrev) {

        $url = 'http://www.efollett.com/webapp/wcs/stores/servlet/StoreFinderAJAX'
            . '?campusId=' . $id . '&requestType=STOREDOMAIN&pageType=FLGStoreCatalogDisplay&langId=-1';

        preg_match("/({.+})/", self::get($url), $matches);
        $json = json_decode($matches[1], true);

        $storeId = $json['data'][0]['store'];

        if ($storeId == 0) {        // not a bkstr store, i.e. devry.efollett.com
            return array();
        }

        if ($singleCampus || $schoolName == $campusName) {
            $schoolName = $schoolName;
        } else {
            $schoolName = "$schoolName - $campusName";
        }

        // get the school's .edu domain, use it for slug
        $url = "http://www.bkstr.com/Home/10001-$storeId-1?demoKey=d";

        $result =  self::get($url);
        $regex = '/href\="([^"]+)"\stitle\="Visit/';
        if (preg_match($regex, $result, $matches)) {
            if (preg_match("/\.(.+?)\.(edu|org|com).*$/", $matches[1], $matches)) {
                $slug = str_replace( '.', '', $matches[1]);
            } else {
                $slug = null;
            }
        }

        return array(
            'BId' => $storeId,
            'Subdomain' => $slug,
            'Slug' => $slug,
            'Name' => $schoolName,
            'State' => $stateAbbrev
        );
    }

    public static function getSchools() {
        global $taxRates;

        $ret = array();
        foreach (array_keys($taxRates) as $state) {
            $ret = array_merge($ret, self::getState($state));
        }

    }
}
