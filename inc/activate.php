<?php
class MagikPluginActivate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}