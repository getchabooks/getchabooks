<?php

require_once(__DIR__ . '/../functions.php');

$departments = array(
    'AA'    => "African American Studies",
    'AC'    => "Accounting",
    'AD'    => "Administrative Studies",
    'AH'    => "Art History",
    'AM'    => "American & New England Studies",
    'GMS AN'=> "Anatomy & Neurobiology",
    'CAS AN'=> "Anthropology",
    'GRS AN'=> "Anthropology",
    'MET AN'=> "Anthropology",
    'AP'    => "Policy, Planning, & Administration",
    'PDP AQ' => "Aquatics",  
    'CAS AR'=> "Archaeology",
    'GRS AR'=> "Archaeology",
    'MET AR'=> "Arts Administration",
    'CFA AR'=> "Visual Arts",
    'CAS AS'=> "Astronomy",
    'GRS AS'=> "Astronomy",
    'OTP AS'=> "Aerospace Studies (Air Force)",
    'MET AT'=> "Actuarial Science",
    'SAR AT'=> "Athletic Training",
    'BB'    => "Biochemistry & Molecular Biology",
    'BE'    => "Biomedical Engineering",
    'BF'    => "Bioinformatics",
    'SED BI'=> "Bilingual Education",
    'GMS BI'=> "Biochemistry",
    'CAS BI'=> "Biology",
    'GRS BI'=> "Biology",
    'MET BI'=> "Biology",
    'UHC BI'=> "Biology",
    'BK'    => "Banking & Financial Law",
    'BN'    => "Behavioral Neuroscience",
    'BS'    => "Biostatistics",
    'BT'    => "Biomedical Laboratory and Clinical Sciences",
    'BY'    => "Biophysics",
    'CE'    => "Counseling",
    'CC'    => "Core Curriculum",
    'CG'    => "Modern Greek",
    'CAS CH'=> "Chemistry",
    'SED CH'=> "Childhood Education",
    'GRS CH'=> "Chemistry",
    'MET CH'=> "Chemistry",
    'CI'    => "Clinical Investigation",
    'CJ'    => "Criminal Justice",
    'CL'    => "Classical Studies",
    'CM'    => "Communication",
    'CN'    => "Cognitive & Neural Systems",
    'CO'    => "COM Core Courses",
    'CP'    => "Clinical Practice",
    'PDP CS' => "Court Sports",
    'CAS CS'=> "Computer Science",
    'GRS CS'=> "Computer Science",
    'MET CS'=> "Computer Science",
    'CT'    => "Curriculum & Training",
    'PDP DA' => "Dance",
    'DE'    => "Deaf Studies",
    'DR'    => "Theatre Arts",
    'ENG EC'=> "Electrical & Computer Engineering",
    'CAS EC'=> "Economics",
    'SED EC'=> "Early Chilhood Education",
    'GRS EC'=> "Economics",
    'MET EC'=> "Economics",
    'ED'    => "Education",
    'EH'    => "Environmental Health",
    'EI'    => "Editorial Studies",
    'EK'    => "Engineering Core",
    'EM'    => "Educational Media & Technology",
    'SED EN'=> "English & Language Arts Education",
    'CAS EN'=> "English",
    'GRS EN'=> "English",
    'MET EN'=> "English",
    'SMG EN'=> "Entrepreneurship",
    'EP'    => "Epidemiology",
    'PDP ER' => "Emergency Response",
    'ES'    => "Earth Sciences",
    'GSM ES'=> "ES",
    'FA'    => "Forensic Anthropology",
    'SSW FE'=> "Field Education",
    'SMG FE'=> "Finance/Economics",
    'GSM FE'=> "Finance",
    'FI'    => "Finance",
    'FS'    => "Forensic Science",
    'PDP FT' => "Fitness/Aerobics",
    'COM FT'=> "Film & Television",
    'GMS GE'=> "Genetics and Genomics",
    'CAS GE'=> "Geography",
    'GRS GE'=> "Geography",
    /*'GE'  => "Environmental Studies",*/
    'PDP GS' => "General Sports",
    'HB'    => "Human Behavior",
    'PDP HE' => "Health Education",
    'HE'    => "Health Education",
    'HF'    => "Hospitality Administration",
    'HI'    => "History",
    'HM'    => "Health Sector Management",
    'HP'    => "Health Professions",
    'HR'    => "Human Resource Education",
    'HS'    => "Health Science",
    'HU'    => "Humanities",
    'IE'    => "International Education",
    'IH'    => "International Health",
    'IM'    => "International Management",
    'IR'    => "International Relations",
    'GSM IS'=> "Information Systems",
    'SMG IS'=> "Information Systems",
    'MET IS'=> "Interdisciplinary Studies",
    'JO'    => "Journalism",
    'LAW LA'=> "Core Curriculum (law)",
    'SMG LA'=> "Law and Business",
    'LC'    => "Chinese",
    'LF'    => "French",
    'LG'    => "German",
    'LH'    => "Hebrew",
    'LI'    => "Italian",
    'LJ'    => "Japanese",
    'LK'    => "Korean",
    'LP'    => "Portuguese",
    'SED LR'=> "LR",
    'CAS LR'=> "Russian",
    'CAS LS'=> "Spanish",
    'LS'    => "Language & Literacy Studies",
    'LT'    => "Turkish",
    'SPH LW'=> "Health Law",
    'CAS LW'=> "Wolof",
    'LX'    => "Linguistics",
    'LY'    => "Arabic",
    'LZ'    => "Persian",
    'MET MA'=> "Mathematics",
    'GRS MA'=> "Mathematics and Statistics",
    'GMS MA'=> "Medical Anthropology",
    'CGS MA'=> "Mathematics",
    'CAS MA'=> "Mathematics",
    'PDP MA' => "Martial Arts",  
    'GRS MB'=> "Molecular Biology, Cell Biology, Biochemistry",
    'PDP MB' => "Mind/Body",  
    'MC'    => "Maternal & Child Health",
    'ENG ME'=> "Mechanical Engineering",
    'SED ME'=> "Mathematics Education",
    'MF'    => "Mathematical Finance",
    'MG'    => "Management",
    'MI'    => "Microbiology",
    'ML'    => "Gastronomy",
    'MM'    => "Molecular Medicine",
    'MK'    => "Marketing",
    'MP'    => "Marco Social Work Practice",
    'MED MS'=> "MS",
    'OTP MS'=> "Military Science (AM)",
    'GMS MS'=> "Medical Sciences",
    'ENG MS'=> "Materials Science and Engineering",
    'MU'    => "Music",
    'NE'    => "Neuroscience",
    'CGS NS'=> "Natural Science",
    'CAS NS'=> "Natural Sciences",
    'OTP NS'=> "Naval Science (Navy)",
    'PDP NT' => "Nutrition",  
    'NU'    => "Medical Nutrition Sciences",
    'GSM OB'=> "Organizational Behavior",
    'GMS OB'=> "Oral Biostatistics",
    'SMG OB'=> "Organizational Behavior",
    'OM'    => "Operations Management",
    'OT'    => "Occupational Therapy",
    'PA'    => "Pathology & Laboratory Medicine",
    'PDP PE' => "Physical Education", 
    'SED PE' => "Physical Education",
    'GMS PH'=> "Physiology",
    'CAS PH'=> "Philosophy",
    'GRS PH'=> "Philosophy",
    'MET PH'=> "Philosophy",
    'PM'    => "Pharmacology & Experimental Therapeutics",
    'PO'    => "Political Science",
    'PS'    => "Psychology",
    'PT'    => "Physical Therapy",
    'PY'    => "Physics",
    'QM'    => "Quantitative Methods",
    'RH'    => "Rhetoric",
    'RN'    => "Religion",
    'RS'    => "Research",
    'SB'    => "Social & Behavioral Science",
    'SC'    => "Science Education",
    'ENG SE'=> "Systems Engineering",
    'SED SE'=> "Special Education",
    'GSM SI'=> "Strategy & Innovation",
    'PDP SK' => "Skating",
    'SED SO'=> "Social Studies Education",
    'CAS SO'=> "Sociology",
    'GRS SO'=> "Sociology",
    'MET SO'=> "Sociology",
    'SR'    => "Social Work Research",
    'SS'    => "Social Sciences",
    'ST'    => "Studio",
    'TA'    => "Church Music and the Arts",
    'TC'    => "Preaching, Worship, Admin, Field Ed, Spirituality",
    'TE'    => "Religion & Education, Religious Development & Human Learning",
    'TH'    => "Church History & Historical Theology",
    'TJ'    => "Practical Theology",
    'TL'    => "Teaching English to Speakers of Other Languages (TESOL)",
    'TM'    => "Missions",
    'TN'    => "New Testament",
    'TO'    => "Old Testament/Hebrew Bible",
    'TS'    => "Ethics/Sociology of Religion",
    'TT'    => "Philosophy & Systematics Theology", 
    'TX'    => "Taxation",
    'TY'    => "Pastoral of Psychology & Psychology of Religion",
    'UA'    => "Urban Affairs",
    'PDP WF' => "Waterfront",
    'WP'    => "Welfare Policy",
    'WR'    => "Writing",
    'WS'    => "Women's Studies",
    'XL'    => "Comparative Literature"
);

$school = SchoolQuery::create()->filterByBnSubdomain('bu')->findOne();

echo "updating departments.\n";
$depts = DeptQuery::create()->filterBySchool($school)->find();
foreach ($depts as $d) {
    if (preg_match("/([A-Z]+)\s([A-Z]{2})/", $d->getAbbr(), $matches)) {
        foreach ($departments as $abbr => $name) {
            if ($abbr == $matches[2] || $abbr == $d->getAbbr()) {
                $d->setName("{$matches[1]} $name")->save();
                break;
            }
        }
    }
}

$keySem = '20114';
echo "updating courses.\n";
$courses = CourseQuery::create()->filterBySchool($school)->find();
foreach ($courses as $c) {
    $courseKey = urlencode( $c->getDept()->getAbbr() . ' ' . $c->getNum() );
    $url = "http://www.bu.edu/link/bin/uiscgi_studentlink.pl/1280445488?ModuleName=course_desc/start.pl&CourseKey=$courseKey&KeySem=$keySem";
    $result = curl_get($url);
    if (preg_match("/Title:\<\/TH\>\s*\<TD\>(.+?)\<\/TD\>/", $result, $matches)) {
        $c->setName(trim($matches[1]))->save();
    }
}

echo "updating sections.\n";
$sections = SectionQuery::create()->filterBySchool($school)->find();
foreach ($sections as $s) {
    $deptAbbr = $s->getCourse()->getDept()->getAbbr();
    $courseNum = $s->getCourse()->getNum();
    $sectionNum = $s->getNum();
    if (preg_match("/([A-Z]+)\s([A-Z]+)/", $deptAbbr , $matches)) {
        $url = "http://www.bu.edu/link/bin/uiscgi_studentlink/1280538735?ModuleName=univschr.pl&SearchOptionDesc=Class+Number"
            ." &SearchOptionCd=S&KeySem=$keySem&College={$matches[1]}&Dept={$matches[2]}&Course="
            . "$courseNum&Section=$sectionNum";
        $result = curl_get($url);

        $regex = "/". str_replace(" ", "&nbsp;", "{$deptAbbr}{$courseNum} {$sectionNum}").
            preg_quote("</a></font></td>", "/")."\s*".
            preg_quote("<td><font size=-1 color=#330000 face=\"Verdana, Helvetica, Arial, sans-serif\">", "/").
            "[^\<]*".preg_quote("<br>", "/").
            "(\<A[^\<]*\>)?" . "([^\<]*)"."(\<\/A\>)?" .
            preg_quote("</font>", "/") . "/s";

        if (preg_match($regex, $result, $matches)) {
            if ($matches[2] != "TBA") {
                $s->setProfessor($matches[2])->save();
            }
        }
    }       
}
echo "Done.\n";
