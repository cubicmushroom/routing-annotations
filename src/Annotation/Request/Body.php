<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 17/02/15
 * Time: 14:24
 */

namespace CubicMushroom\Annotations\Routing\Annotation\Request;

use CubicMushroom\Annotations\Routing\Annotation\AbstractAnnotation;

/**
 * Class Body
 *
 * Annotation class for defining the documentation for the request body
 *
 * @package LIMTool\API\Annotation\API\Request
 *
 * @Annotation
 */
class Body extends AbstractAnnotation
{

    /**
     * @var string
     */
    protected $content;


    /**
     * Returns the name of the default property
     *
     * @return string
     */
    protected function getDefaultProperty()
    {
        return 'content';
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Getters and Setters
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}