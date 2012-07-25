<?php

abstract class PageController {

    /**
     * Meta tags that will appear immediately after <title>
     */
    public $metaTags = array();

    /**
     * Inline CSS snippets, which will be combined and placed in a <style> tag in <head>.
     */
    public $inlineCSS = array();

    /**
     * Inline JavaScript snippets, which will be combined and placed in a <script> tag in <head>.
     */
    public $inlineJS = array();

    /**
     * JS files to include with <script> tags in <head>, can be either files in
     * js/ or URLs.
     *
     * This is a map of compressed bundle names to their components, which is used
     * by the compressor and used to decide which to link to depending on
     * whether it's production or development. Other files (such as but not
     * limited to remote files) can simply be appended to this array (i.e., with
     * a numerical key), and they will ignored for the purposes of compression.
     */
    public $jsFiles = array(
        'getchabooks.js' => array(
            "underscore.js",
            "common.js",
            "analytics.js",
            "jquery.scrollTo.js",
            "jquery.friendlyHover.js",
            "jquery.hoverIntent.js",
            "lightbox.js",
            "jquery.tooltip.js",
            "jquery.fittext.js",
            "jquery.autocomplete.js",
            "jquery.cachedAjax.js",
            "modernizr.touch.js"
        )
    );

    /**
     * CSS files to include with <link> tags in <head>, must be files in css/.
     */
    public $cssFiles = array(
        'getchabooks.css' => array(
            'common.css',
            'tooltip.css',
            'lightbox.css'
        )
    );

    /**
     * Miscellaneous text to output before the end of <head>.
     */
    public $misc = array();

    public function redirect_to_index() {
        header("Location: " . BASE_URL);
        exit();
    }

    /**
     * Add a tag <meta name="$name" content="$content" />
     */
    public function addMetaTag($name, $content) {
        $this->metaTags[] = "<meta name=\"$name\" content=\"$content\" />";
    }

	/**
	 * On some pages (selection and results), we want a manual pageView call
	 * instead of the default too-verbose one (/selection instead of /tufts/selection/comp10).
	 * This passes a URL to be used for the trackPageView call instead of the actual URL.
	*/
	public function overrideAnalyticsPageUrl($url) {
		$this->inlineJS[] = "Globals.PAGE_TRACK_URL = '/" . $url . "';";
	}

    /**
     * Set the variable portion of the HTML title, which will be combined with a prefix.
     */
    public function setTitle($title) {
        global $school, $siteName;

        if ($school) {
            $this->title = $school->getShortName() . " $siteName";
        } else {
            $this->title = "$siteName ";
        }

        $this->title .= " &#8250; " . $title;
    }

    public function __construct() {
        global $prodAnalyticsId, $devAnalyticsId, $siteName;

        /* Define default page attributes here */

        $this->addMetaTag("google-site-verification", "PJfDjprjNE3dc_kjzSSAkjwWQj8bi6u0hBIalrUOp1w");
        $this->addMetaTag("og:image", BASE_URL . "images/og_image.png");
        $this->metaTags[] = "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"" . BASE_URL . "images/favicon.ico\" />";
        $this->metaTags[] = "<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"" . BASE_URL . "images/apple-touch-icon-precomposed.png\" />";
        $this->metaTags[] = "<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"" . BASE_URL . "images/apple-touch-icon-precomposed-retina.png\" />";
        $js = "var Globals = {};\n";
        $js .= "Globals.SITE_NAME = '$siteName';\n";
        $js .= "Globals.PROD_ANALYTICS_UA = '$prodAnalyticsId';\n";
        $js .= "Globals.DEV_ANALYTICS_UA = '$devAnalyticsId';\n";
        $js .= "Globals.BASE_URL = '" . BASE_URL . "';\n";
        $js .= "Globals.PRODUCTION = " . (defined('PRODUCTION') ? "true" : "false") . ";\n";
        $js .= "Globals.IMG_PATH = '" . BASE_URL . "images/';\n";
        $js .= "var ref = '{$_SESSION['ref']}';\n";
        $this->inlineJS[] = $js;

        /* jQuery must be first */
        $jquery = "http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js";
        $this->jsFiles = array_merge(array($jquery => $jquery), $this->jsFiles);

        /* IE hack */
        $baseUrl = BASE_URL;
        $this->misc[] = <<<END

   <!--[if IE 9]>
   <link rel="stylesheet" type="text/css" href="{$baseUrl}css/ie9.css" />
   <![endif]-->

END;

    }

    public function getHeadHtml() {
        /* Construct the page here */

        $metaTags = implode("  \n", $this->metaTags);
        $inlineJs = implode("\n", $this->inlineJS);
        $inlineCss = implode("\n", $this->inlineCSS);
        $miscTags = implode("\n", $this->misc);

        $cssFiles = array();
        $jsFiles = array();

        foreach ($this->jsFiles as $bundle => $components) {
            if (defined('PRODUCTION')) {
                $jsFiles[] = $bundle;
            } else if (is_array($components)) {
                $jsFiles = array_merge((array)$jsFiles, $components);
            } else {
                $jsFiles[] = $components;
            }
        }

        foreach ($this->cssFiles as $bundle => $components) {
            if (defined('PRODUCTION')) {
                $cssFiles[] = $bundle;
            } else {
                $cssFiles = array_merge($cssFiles, $components);
            }
        }

        $cssFileTags = "";
        $jsFileTags = "";

        foreach ($cssFiles as $file) {
            $cssFileTags .= "<link href='" . BASE_URL . "css/$file' type='text/css' rel='stylesheet' />\n";
        }

        foreach ($jsFiles as $file) {
            if ("http" !== substr($file, 0, 4)) {
                $file = BASE_URL . "js/$file";
            }
            $jsFileTags .= "<script type='text/javascript' src='$file'></script>\n";
        }

        return <<<END
    <title>{$this->title}</title>

    $metaTags

    <script type="text/javascript">
        $inlineJs
    </script>

    $cssFileTags
    $jsFileTags

    <style type="text/css">
        $inlineCss
    </style>

    $miscTags
END;

    }

    public function renderPage($view, $params=array()) { ?>
<!DOCTYPE html>
<html lang="en">
<head><?= $this->getHeadHTML() ?></head>
<body>
<?php
    $this->renderView("partials/logo_and_navigation", $params);
?>
<div id="main">
<?php
    $this->renderView($view, $params);
    $this->renderView("partials/footer", $params);
?>
</div>
</body>
</html>

<?php
    }

    public function renderPlain($view, $params=array()) {
        $this->renderView($view, $params);
    }

    private function renderView($view, $params=array()) {
        extract($GLOBALS);
        extract($params);
        require_once BASE_DIR . "/views/$view.php";
    }

    /**
     * Minify the CSS files associated with this page.
     *
     * Since multiple pages use the same CSS file, running
     * this function for all pages requires that minification be
     * idempotent.
     */
    public function minifyCss() {
        $inputDir = BASE_DIR . '/assets/css/compiled/';
        $outputDir = BASE_DIR . '/public/css/';
        foreach ($this->cssFiles as $bundle => $components) {
            $css = '';
            foreach ($components as $file) {
                $css .= exec(BASE_DIR . "/vendor/sass/bin/sass " . $inputDir.$file . " --scss --style compressed");
            }
            file_put_contents($outputDir . $bundle, $css);
        }
    }

    /**
     * Remove Byte Order Marks, originally a problem with scrollTo.
     */
    protected static function removeBOM($str="") {
        if(substr($str, 0,3) == pack("CCC", 0xef, 0xbb, 0xbf)) {
            $str = substr($str, 3);
        }
        return $str;
    }

    /**
     * Bundle (after removing Byte Order Marks) and then minify the JS files
     * associated with this page.
     */
    public function minifyJs() {
        $inputDir = BASE_DIR . '/assets/js/';
        $outputDir = BASE_DIR . '/public/js/';
        foreach ($this->jsFiles as $bundle => $components) {
            if (is_numeric($bundle) || substr($bundle, 0, 4) == 'http') {      // not a bundle
                continue;
            } else {
                $js = '';
                foreach ($components as $file) {
                    $js .= self::removeBOM(file_get_contents($inputDir . $file));
                }

                $outputFile = $outputDir . $bundle;
                $cmd = BASE_DIR . "/vendor/uglifyjs/bin/uglifyjs --no-seqs";
                $descriptor = array(
                    0 => array("pipe", "r"),
                    1 => array("file", $outputFile, 'w')
                );

                $process = proc_open($cmd, $descriptor, $pipes);
                fwrite($pipes[0], $js);
                fclose($pipes[0]);
                fclose($pipes[1]);
                $return = proc_close($process);
            }
        }
    }

}

