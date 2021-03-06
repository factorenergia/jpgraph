<?php
use \Codeception\Util\Debug;

/**
 * @group ready
 */
class TickTest extends \Codeception\Test\Unit
{
    use factorenergia\JpGraph\UnitTest\UnitTestTrait;

    public static $fixTures    = [];
    public static $files       = null;
    public static $exampleRoot = null;
    public static $ranTests    = [];

    public static function setUpBeforeClass(): void
    {
        $className = str_replace('test', '', strtolower(__CLASS__));

        self::$files   = self::getFiles($className);
        $knownFixtures = self::getShallowFixtureArray(self::$fixTures);

        self::$files = array_filter(self::$files, function ($filename) use ($knownFixtures) {
            return !array_key_exists($filename, $knownFixtures);
        });

        Debug::debug(__CLASS__ . ' has ' . count(self::$files) . ' files');

    }

    public function testExampleWithManualTickLabels()
    {
        $this->traverseFixtureGroup($this->fixTures(__METHOD__));

    }

    protected function _before() {}

    protected function _after() {}

    public function testFileIterator()
    {
        self::$genericFixtures = array_reduce(self::$files, function ($carry, $file) {
            $carry = $this->_fileCheck($file, $carry/*, true*/);
            return $carry;
        }, self::$genericFixtures);
    }
}
