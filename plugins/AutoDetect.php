<?php

use \IsaEken\PluginSystem\Plugin;

class AutoDetect extends Plugin
{
    /**
     * @var string $author
     */
    protected string $author = 'İsa Eken';

    /**
     * @var string $name
     */
    protected string $name = 'Auto Detect';

    /**
     * @var string $version
     */
    protected string $version = 'v1.0';

    /**
     * @var string $description
     */
    protected string $description = 'Auto language detect and highlight plugin for privbin.';

    /**
     * @var string $compilerName
     */
    public string $compilerName = 'auto_detect';

    /**
     * Find language and highlight text
     *
     * @param string $text
     * @return string
     */
    public static function compile(string $text): string
    {
        $highlighter = new \Highlight\Highlighter;
        try {
            $highlighted = $highlighter->highlightAuto($text);
            $lines = \HighlightUtilities\splitCodeIntoArray($highlighted->value);
            $response = '<table>';
            $response.= '<tbody>';
            foreach ($lines as $number => $line) {
                $response.= '<tr>';
                $response.= "<td id=\"L{$number}\" data-line-number=\"{$number}\"></td>";
                $response.= "<td id=\"LC{$number}\" class=\"blob-code\"><pre><code>{$line}</code></pre></td>";
                $response.= '</tr>';
            }
            $response.= '</tbody>';
            $response.= '</table>';
            return $response;
        }
        catch (Exception $exception) {
            return '<pre><code>'.$text.'</code></pre>';
        }
    }
}
