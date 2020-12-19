<?php

namespace App\Models;

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
        'compiler',
    ];

    /**
     * @param PluginSystem $pluginSystem
     * @return Collection
     */
    public static function plugins(PluginSystem $pluginSystem): Collection
    {
        $plugins = collect();
        foreach ($pluginSystem->plugins as $plugin)
        {
            if (!isset($plugin->compilerName)) {
                continue;
            }

            $plugins->add($plugin);
        }
        return $plugins;
    }

    /**
     * @param PluginSystem $pluginSystem
     * @return Collection
     */
    public static function classes(PluginSystem $pluginSystem): Collection
    {
        $plugins = collect();
        foreach ($pluginSystem->plugins as $plugin)
        {
            if (!isset($plugin->compilerName)) {
                continue;
            }

            $plugins->add(get_class($plugin));
        }
        return $plugins;
    }
}
