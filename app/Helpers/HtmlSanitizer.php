<?php

namespace App\Helpers;

class HtmlSanitizer {
    public static function cleanList($html) {
        $dom = new \DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Remove empty spans
        $xpath = new \DOMXPath($dom);
        foreach ($xpath->query('//span[@class="ql-ui"]') as $node) {
            $node->parentNode->removeChild($node);
        }

        // Force OL/LI rendering
        foreach ($xpath->query('//ol|//ul') as $list) {
            $list->setAttribute('style', 'list-style-type: decimal; padding-left: 20px;');
        }

        return $dom->saveHTML();
    }
}
