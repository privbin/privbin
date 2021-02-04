<?php


namespace App\Interfaces;


use Illuminate\Http\Request;

interface HighlighterPluginInterface
{
    /**
     * Plugin unique name.
     *
     * @return string
     */
    public static function getName() : string;

    /**
     * Plugin version.
     *
     * @return string
     */
    public static function getVersion() : string;

    /**
     * Plugin description.
     *
     * @return string
     */
    public static function getDescription() : string;

    /**
     * Plugin author.
     *
     * @return string
     */
    public static function getAuthor() : string;

    /**
     * Convert text to highlighted text.
     *
     * @param string $text
     * @param Request|null $request
     * @return string
     */
    public static function convert(string $text, Request $request = null) : string;
}
