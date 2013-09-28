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

namespace Chrisguitarguy\RssMedia;

/**
 * An object to wrap up <media:content> genrate.
 *
 * @since   1.0
 */
class MediaGenerator
{
    /**
     * Fake a singleton.
     *
     * @since   1.0
     * @access  protected
     * @var     MediaGenerator
     */
    protected static $instance = null;

    public static function instance()
    {
        null === self::$instance && self::$instance = new self();
        return self::$instance;
    }

    public function generate($post)
    {
        if (!has_post_thumbnail($post->ID)) {
            return;
        }

        $thumb_id = get_post_thumbnail_id($post->ID);
        $attachment = get_post($thumb_id);

        $doc = new \DomDocument('1.0', 'UTF-8');
        $group = $doc->createElement('media:group');
        $has_media = false;

        foreach ($this->getSizes($post) as $size) {
            // returns an array: [$img_url, $width, $height]
            $img = wp_get_attachment_image_src($thumb_id, $size);
            if (!$img) {
                continue;
            }

            $has_media = true;

            $content = $doc->createElement('media:content');
            $content->setAttribute('url', $this->filterAttr('url', $size, $img[0], $attachment, $post));
            $content->setAttribute('width', $this->filterAttr('width', $size, $img[1], $attachment, $post));
            $content->setAttribute('height', $this->filterAttr('height', $size, $img[2], $attachment, $post));
            $content->setAttribute('expression', $this->filterAttr('expression', $size, $size, $attachment, $post));
            $content->setAttribute('medium', $this->filterAttr('medium', $size, 'image', $attachment, $post));
            if ($mime = $this->filterAttr('type', $size, $attachment->post_mime_type, $attachment, $post)) {
                $content->setAttribute('type', $mime);
            }

            do_action('cgg_rssmedia_alter_content', $content, $size, $attachment, $post);

            $group->appendChild($content);
        }

        do_action('cgg_rssmedia_alter_group', $group, $attachment, $post);

        $doc->appendChild($group);

        if ($has_media) {
            echo $doc->saveXML($group);
        }
    }

    protected function getSizes($post)
    {
        return apply_filters('cgg_rssmedia_sizes', array(
            'thumbnail',
            'medium',
            'large',
            'full',
        ), $post);
    }

    protected function filterAttr($attr, $size, $value, $attachment, $post)
    {
        return esc_attr(apply_filters(
            "cgg_rssmedia_{$attr}_{$size}",
            $value,
            $attachment,
            $post
        ));
    }
}
