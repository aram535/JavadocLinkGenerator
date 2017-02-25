<?php
/**
 * Created by PhpStorm.
 * User: Aram Mirzadeh
 * Date: 2/25/2017
 * Time: 10:47 AM
 */

use PHPUnit\Framework\TestCase;
require_once "JavadocLinker.php";

class JavadocLinkerTest extends PHPUnit_Framework_TestCase {

    var $my = null;

    public function setUp() {
        $this->my = new JavadocLinker();
    }

    public function tearDown() {
        $this->my = null;
    }

    public function testConvertDotToPathSimple() {
        $this->assertEquals("java/util/Collection",$this->my->convertDotToPath("java.util.Collection"));
    }
    public function testConvertDotToPathEmpty() {
        $this->assertEquals("",$this->my->convertDotToPath());
    }
    public function testConvertDotToPathInvalid() {
        $this->assertEquals("foo",$this->my->convertDotToPath("foo"));
    }

    public function testGetLatestVersion() {
        $this->assertEquals($this->my->getLatestVersion(),8);
    }

    public function testGetLink_Collection() {
        $oLink ="https://docs.oracle.com/javase/8/docs/api/java/util/Collection.html";
        $this->assertEquals($oLink,$this->my->getLink("java.util.Collection"));
    }
    public function testGetLink_Clock() {
        $oLink ="https://docs.oracle.com/javase/8/docs/api/java/time/Clock.html";
        $this->assertEquals($oLink,$this->my->getLink("java.time.Clock"));
    }
    public function testGetLink_Collection1() {
        $oLink ="https://docs.oracle.com/javase/8/docs/api/java/sql/Driver.html";
        $this->assertEquals($oLink,$this->my->getLink("java.sql/Driver"));
    }
}
