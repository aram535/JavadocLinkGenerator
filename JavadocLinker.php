<?php

/**
 * Created by PhpStorm.
 * User: Aram Mirzadeh
 * Date: 2/25/2017
 * Time: 10:46 AM
 */
final class JavadocLinker {

    var $pre = "https://docs.oracle.com/javase/";
    var $post = "/docs/api/";

    const DEFAULT_VERSION = 8;

    /**
     * @param null $pkg
     * @return mixed|string
     */
    protected function convertDotToPath($pkg = null) {
        if ($pkg == null) {
            return "";
        }
        return str_replace(".","/",$pkg);
    }

    /**
     * @return int|mixed
     */
    protected function getLatestVersion() {
        $url = "http://javadl-esd-secure.oracle.com/update/baseline.version";
        $content = @file_get_contents($url);
        if ($content == null || strlen($content) == 0)
            return self::DEFAULT_VERSION;
        else {
            preg_match_all('/\.(\d+)\.\d+\_\d+/ix', $content, $result, PREG_PATTERN_ORDER);
            return max($result[1]);
        }
    }

    /**
     * @param null $className
     * @return string
     */
    public function getLink($className = null) {
        if ($className == null || strlen($className) == 0) {
            return $this->pre;
        }

        return $this->pre . $this->getLatestVersion() . $this->post . $this->convertDotToPath($className) . ".html";
    }
}