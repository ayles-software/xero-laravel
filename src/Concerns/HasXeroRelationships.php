<?php

namespace AylesSoftware\XeroLaravel\Concerns;

use Exception;
use BadMethodCallException;
use Illuminate\Support\Str;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use AylesSoftware\XeroLaravel\Utils;
use AylesSoftware\XeroLaravel\QueryBuilder;

trait HasXeroRelationships
{
    /**
     * Map between relationship names and Xero PHP library models.
     *
     * @var array
     */
    private $relationshipToModelMap = [];

    /**
     * Populates all relationship to model maps.
     *
     * @throws Exception
     */
    public function populateRelationshipToModelMaps()
    {
        $this->populateRelationshipToModelMap('Accounting', '');
        $this->populateRelationshipToModelMap('Assets', 'assets');
        $this->populateRelationshipToModelMap('Files', 'files');
        $this->populateRelationshipToModelMap('PayrollAU', 'payrollAU');
        $this->populateRelationshipToModelMap('PayrollUS', 'payrollUS');
    }

    /**
     * Populate the relationship to model map, for all models within
     * a specified model subdirectory.
     *
     * @param $modelSubdirectory
     * @param $prefix
     * @throws Exception
     */
    public function populateRelationshipToModelMap($modelSubdirectory, $prefix)
    {
        $vendor = Utils::getVendorDirectory();

        $dependencyDirectory = Utils::normalizePath(
            $vendor.'/calcinai/xero-php/src/'
        );

        $modelsDirectory = Utils::normalizePath(
            $dependencyDirectory.'/XeroPHP/Models/'.$modelSubdirectory
        );

        $di = new RecursiveDirectoryIterator($modelsDirectory);

        foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
            if ($file->isDir() || ! Str::endsWith($filename, '.php')) {
                continue;
            }

            $relationship = Str::camel(
                $prefix.Str::plural(
                    str_replace([$modelsDirectory, '.php', DIRECTORY_SEPARATOR], '', $filename)
                )
            );

            $this->relationshipToModelMap[$relationship] = str_replace(
                [$dependencyDirectory, DIRECTORY_SEPARATOR, '.php'], ['', '\\'],
                $filename
            );
        }
    }

    /**
     * Call a relationship method, and return a QueryWrapper.
     * Syntax: $xero->contacts().
     *
     * @param $name
     * @param $arguments
     * @return QueryBuilder
     */
    public function __call($name, $arguments)
    {
        $relationships = array_keys($this->relationshipToModelMap);

        if (! in_array($name, $relationships)) {
            throw new BadMethodCallException();
        }

        return new QueryBuilder($this->load($this->relationshipToModelMap[$name]), $this);
    }

    /**
     * Call a relationship method and get results.
     * Syntax: $xero->contacts.
     *
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        $relationships = array_keys($this->relationshipToModelMap);

        if (! in_array($name, $relationships)) {
            return;
        }

        return $this->{$name}()->get();
    }
}
