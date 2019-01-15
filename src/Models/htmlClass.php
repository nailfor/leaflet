<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor;

trait htmlClass
{

    /**
     * @return string
     * @throws \Throwable
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     * @throws \Throwable
     */
    public function toHtml()
    {
        return $this->render();
    }    
}