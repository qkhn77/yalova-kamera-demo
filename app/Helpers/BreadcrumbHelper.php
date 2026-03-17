<?php

namespace App\Helpers;

class BreadcrumbHelper
{
    private static $breadcrumbs = [];

    public static function add($title, $url = null)
    {
        self::$breadcrumbs[] = [
            'title' => $title,
            'url' => $url,
        ];
    }

    public static function set(array $breadcrumbs)
    {
        self::$breadcrumbs = $breadcrumbs;
    }

    public static function get()
    {
        return self::$breadcrumbs;
    }

    public static function render()
    {
        if (empty(self::$breadcrumbs)) {
            return '';
        }

        $html = '<nav class="wow fadeInUp" data-wow-delay="0.2s"><ol class="breadcrumb">';

        foreach (self::$breadcrumbs as $index => $crumb) {
            if ($index === count(self::$breadcrumbs) - 1) {
                // Son öğe, aktif
                $html .= '<li class="breadcrumb-item active" aria-current="page">' . $crumb['title'] . '</li>';
            } else {
                // Link
                $html .= '<li class="breadcrumb-item"><a href="' . $crumb['url'] . '">' . $crumb['title'] . '</a></li>';
            }
        }

        $html .= '</ol></nav>';

        return $html;
    }

    public static function clear()
    {
        self::$breadcrumbs = [];
    }
}