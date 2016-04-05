<?php
/**
 * Boss sensei custom excerpt
 * @param type $text
 * @return type
 */
function boss_sensei_custom_excerpt($text) {

     $text = strip_shortcodes($text);

     /** This filter is documented in wp-includes/post-template.php */
     $text = apply_filters('the_content', $text);
     $text = str_replace(']]>', ']]&gt;', $text);

     /**
      * Filter the number of words in an excerpt.
      *
      * @since 2.7.0
      *
      * @param int $number The number of words. Default 55.
      */
     $excerpt_length = apply_filters('excerpt_length', 55);
     /**
      * Filter the string in the "more" link displayed after a trimmed excerpt.
      *
      * @since 2.9.0
      *
      * @param string $more_string The string shown within the more link.
      */
     $excerpt_more = apply_filters('excerpt_more', ' ' . '[&hellip;]');
     $text = wp_trim_words($text, $excerpt_length, $excerpt_more);
     return $text;
 }
