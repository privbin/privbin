<?php

namespace App\Models;

use App\Interfaces\HighlighterPluginInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use IsaEken\PluginSystem\PluginSystem;

class ContentType extends Model
{
    use HasFactory;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'highlighter',
    ];

    /**
     * @param PluginSystem $pluginSystem
     * @return Collection
     */
    public static function highlighters(PluginSystem $pluginSystem) : Collection
    {
        $plugins = collect();
        foreach ($pluginSystem->plugins as $plugin)
        {
            if (!method_exists(get_class($plugin), "getName") || !($plugin instanceof HighlighterPluginInterface)) {
                continue;
            }

            $plugins->put(get_class($plugin), $plugin);
        }
        return $plugins;
    }

    /**
     * @param string $name
     * @param PluginSystem $pluginSystem
     * @return HighlighterPluginInterface|null
     */
    public static function highlighter(string $name, PluginSystem $pluginSystem) : ?HighlighterPluginInterface
    {
        $highlighters = self::highlighters($pluginSystem);
        $highlighter = null;

        foreach ($highlighters as $class => $item) {
            if ($item->getName() === $name) {
                $highlighter = $item;
            }
        }

        return $highlighter;
    }
}
