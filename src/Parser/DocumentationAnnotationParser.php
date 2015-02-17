<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 16/02/15
 * Time: 21:58
 */

namespace CubicMushroom\Annotations\Routing\Parser;

use CubicMushroom\Annotations\Routing\Annotation\Response\Body as ResponseBody;
use CubicMushroom\Annotations\Routing\Annotation\Request\Body as RRequestBody;
use CubicMushroom\Annotations\Routing\Annotation\Route;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\Reader;

/**
 * Class DocumentationAnnotationParser
 *
 * Parses classes for any Route annotations
 *
 * @package LIMTool\API\Annotation\Parser
 */
class DocumentationAnnotationParser
{

    const ANNOTATION_CLASS = 'LIMTool\API\Annotation\API\Route';

    /**
     * @var Reader
     */
    protected $reader;


    /**
     * Stores the reader object
     *
     * @param Reader $reader Annotation reader object
     */
    public function __construct(Reader $reader)
    {
        $this->setReader($reader);

        $loader = require(VENDOR_DIR . DS . 'autoload.php');
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);
    }


    /**
     * Parses the files provided by the SeekableIterator
     *
     * @param array $classes Array of classes to parse
     *
     * @return \LIMTool\API\Annotation\API\Route[]
     */
    public function parse(array $classes)
    {
        $APIAnnotations = [];
        foreach ($classes as $class) {
            $reflectionClass = new \ReflectionClass($class);

            foreach ($reflectionClass->getMethods() as $reflectionMethod) {
                $annotations = $this->getReader()->getMethodAnnotations($reflectionMethod);
                if (!empty($annotations)) {
                    foreach ($annotations as $annotation) {

                        switch (true) {

                            case ($annotation instanceof Route):
                                $APIAnnotations[$class][$reflectionMethod->getName()]['routes'][] = $annotation;
                                break;

                            case ($annotation instanceof ResponseBody):
                                $APIAnnotations[$class][$reflectionMethod->getName()]['requestBody'][] = $annotation;
                                break;

                            case ($annotation instanceof RequestBody):
                                $APIAnnotations[$class][$reflectionMethod->getName()]['responseBody'][] = $annotation;
                                break;

                            default:
                                // Do nothing
                        }
                    }
                }
            }
        }

        return $APIAnnotations;
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Getters and Setters
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * @return Reader
     */
    public function getReader()
    {
        return $this->reader;
    }


    /**
     * @param Reader $reader
     */
    public function setReader(Reader $reader)
    {
        $this->reader = $reader;
    }
}