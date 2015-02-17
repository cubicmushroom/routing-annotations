<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 17/02/15
 * Time: 12:01
 */

namespace CubicMushroom\Annotations\Routing\Annotation\Response;

use CubicMushroom\Annotations\Routing\Annotation\AbstractAnnotation;

/**
 * Class Body
 *
 * Parses the @ API\Response\Body tags of controllers
 *
 * @package Annotation\API\Response
 *
 * @Annotation
 */
class Body extends AbstractAnnotation
{

    /**
     * @var string
     */
    protected $success;


    /**
     * Returns the name of the default property
     *
     * @return string
     */
    protected function getDefaultProperty()
    {
        return 'success';
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Getters and Setters
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getSuccess()
    {
        return $this->success;
    }


    /**
     * @param string $success
     */
    public function setSuccess($success)
    {
        $this->success = $this->parseMultiLineAnnotation($success);
    }
}