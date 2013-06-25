<?php

/*
 * This file is part of the Pagerfanta2 package.
 *
 * (c) Pablo Díez <pablodip@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pagerfanta\Adapter;

/**
 * AdapterInterface.
 *
 * @author Pablo Díez <pablodip@gmail.com>
 */
interface AdapterInterface
{
    /**
     * Returns the number of results.
     *
     * @return integer The number of results.
     */
    function getNbResults();

    /**
     * Returns an slice of the results.
     *
     * @param integer $offset The offset.
     * @param integer $length The length.
     *
     * @return array|\Traversable The slice.
     */
    function getSlice($offset, $length);
}
