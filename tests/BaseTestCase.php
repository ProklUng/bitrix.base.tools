<?php

namespace Council\Setup;

use Exception;
use Faker\Factory;
use Faker\Generator;
use Mockery;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class BaseTestCase
 * @package Council\Setup
 */
class BaseTestCase extends TestCase
{
    /**
     * @var mixed $obTestObject
     */
    protected $obTestObject;

    /**
     * @var Generator | null $faker
     */
    protected $faker;

    /**
     * @var array $matched_dirs
     */
    private $matched_dirs = [];

    /**
     * @inheritDoc
     * @throws Exception
     */
    protected function setUp(): void
    {
        Mockery::resetContainer();
        parent::setUp();

        $this->faker = Factory::create();
    }

    /**
     * @inheritDoc
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    /**
     * Creates a unique temporary file name.
     *
     * The directory in which the file is created depends on the environment configuration.
     *
     * @return string|boolean Path on success, else false.
     */
    public function tempFilename()
    {
        $tmp_dir = '';
        $dirs = ['TMP', 'TMPDIR', 'TEMP'];

        foreach ($dirs as $dir) {
            if (isset($_ENV[$dir]) && !empty($_ENV[$dir])) {
                $tmp_dir = $dir;
                break;
            }
        }

        if (empty($tmp_dir)) {
            $tmp_dir = sys_get_temp_dir();
        }

        $tmp_dir = realpath($tmp_dir);

        return tempnam($tmp_dir, 'wpunit');
    }

    /**
     * Returns a list of all files contained inside a directory.
     *
     * @param string $dir Path to the directory to scan.
     *
     * @return array List of file paths.
     */
    protected function filesInDir(string $dir): array
    {
        $files = [];

        $iterator = new RecursiveDirectoryIterator($dir);
        $objects = new RecursiveIteratorIterator($iterator);
        foreach ($objects as $name => $object) {
            if (is_file($name)) {
                $files[] = $name;
            }
        }

        return $files;
    }

    /**
     * Deletes all directories contained inside a directory.
     *
     * @param string $path Path to the directory to scan.
     *
     * @return void
     *
     */
    protected function deleteFolders(string $path) : void
    {
        $this->matched_dirs = [];
        if (!is_dir($path)) {
            return;
        }

        $this->scandir($path);
        foreach (array_reverse($this->matched_dirs) as $dir) {
            rmdir($dir);
        }

        rmdir($path);
    }

    /**
     * Retrieves all directories contained inside a directory and stores them in the `$matched_dirs` property. Hidden
     * directories are ignored.
     *
     * This is a helper for the `delete_folders()` method.
     *
     * @param string $dir Path to the directory to scan.
     *
     * @return void
     */
    protected function scandir(string $dir) : void
    {
        foreach (scandir($dir) as $path) {
            if (0 !== strpos($path, '.') && is_dir($dir . '/' . $path)) {
                $this->matched_dirs[] = $dir . '/' . $path;
                $this->scandir($dir . '/' . $path);
            }
        }
    }
}
