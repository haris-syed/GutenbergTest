<?php

class MagikPluginDeactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}