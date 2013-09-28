<?php
/**
 * RSS Media
 *
 * @category    WordPress
 * @package     Chrisguitarguy\RssMedia
 * @author      Christopher Davis <http://christopherdavis.me>
 * @copyright   2013 Christopher Davis
 * @license     http://opensource.org/licenses/MIT MIT
 */

use Chrisguitarguy\RssMedia\MediaGenerator;

function cgg_rssmedia_namespace()
{
    echo ' xmlns:media="http://search.yahoo.com/mrss/" ';
}

function cgg_rssmedia_item()
{
    global $post;
    MediaGenerator::instance()->generate($post);
}
