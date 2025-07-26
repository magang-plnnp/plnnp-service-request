<?php

use Illuminate\Support\HtmlString;

if (!function_exists('renderStatChange')) {
    function renderStatChange($percent)
    {
        $iconUp = '<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l10-10M17 7v10" />
        </svg>';

        $iconDown = '<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 7l-10 10M7 17V7" />
        </svg>';

        $iconSame = '<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16" />
        </svg>';

        if ($percent > 0) {
            $class = 'positive';
            $icon = $iconUp;
            $text = '+' . $percent . '% dari bulan lalu';
        } elseif ($percent < 0) {
            $class = 'negative';
            $icon = $iconDown;
            $text = $percent . '% dari bulan lalu';
        } else {
            $class = 'neutral';
            $icon = $iconSame;
            $text = '0% dari bulan lalu';
        }

        return new HtmlString('<div class="stat-change ' . $class . '">' . $icon . ' ' . $text . '</div>');
    }
}
