<?php
/**
 * Plugin Name: RSS Media
 * Plugin URI: https://github.com/chrisguitarguy/RSS-Media
 * Description: Add `media:content` elements to WordPress RSS2 feeds
 * Version: 1.0
 * Author: Christopher Davis
 * Author URI: http://christopherdavis.me
 * License: MIT
 *
 * Copyright (c) 2013 Christopher Davis <http://christopherdavis.me>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 * @category    WordPress
 * @package     Chrisguitarguy\RssMedia
 * @author      Christopher Davis <http://christopherdavis.me>
 * @copyright   2013 Christopher Davis
 * @license     http://opensource.org/licenses/MIT MIT
 */

namespace Chrisguitarguy\RssMedia;

require __DIR__ . '/inc/MediaGenerator.php';
require __DIR__ . '/inc/core.php';

add_action('rss2_ns', 'cgg_rssmedia_namespace');
add_action('rss2_item', 'cgg_rssmedia_item');
