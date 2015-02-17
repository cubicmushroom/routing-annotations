<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 16/02/15
 * Time: 21:08
 */

namespace CubicMushroom\Annotations\Routing\Annotation;

/**
 * Class AbstractAnnotation
 *
 * Abstract class to extend all annotation classes from
 *
 * @package LIMTool\API\Annotation
 */
abstract class AbstractAnnotation
{
    /**
     * Stores annotation properties
     *
     * @param array $options
     */
    function __construct(array $options)
    {
        if (isset($options['value'])) {
            $property = $this->getDefaultProperty();

            if ('value' !== $property) {
                $options[$property] = $options['value'];
                unset($options['value']);
            }
        }

        foreach ($options as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                call_user_func([$this, $setter], $value);
            } elseif (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                throw new \InvalidArgumentException(sprintf('Property "%s" does not exist', $key));
            }
        }
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Helper methods
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * Parses an annotation string and strips out the leading spaces & *s
     *
     * @param string $annotation Contents of the annotation
     *
     * @return string
     */
    protected function parseMultiLineAnnotation($annotation)
    {
        $return = preg_replace('/\n\s*\* /', "\n", $annotation);

        return $return;
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Abstract methods
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * Returns the name of the default property
     *
     * @return string
     */
    abstract protected function getDefaultProperty();
}