<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 16/02/15
 * Time: 21:26
 */

namespace CubicMushroom\Annotations\Routing\Annotation;

/**
 * Class Route
 *
 * @package LIMTool\API\Annotation\API
 *
 * @Annotation
 */
class Route extends AbstractAnnotation
{

    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var string
     */
    protected $methods;

    /**
     * @var string
     */
    protected $name = null;


    /**
     * Returns the name of the default property
     *
     * @return string
     */
    protected function getDefaultProperty()
    {
        return 'pattern';
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Getters and Setters
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }


    /**
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }


    /**
     * Returns the methods split into an array, or null if no methods defined
     *
     * @return array|null
     */
    public function getMethods()
    {
        if (empty($this->methods)) {
            return null;
        }

        return array_map('trim', explode(',', $this->methods));
    }


    /**
     * @param string $methods
     */
    public function setMethods($methods)
    {
        $this->methods = $methods;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}