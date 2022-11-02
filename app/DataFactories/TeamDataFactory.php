<?php

namespace App\DataFactories;

use Fligno\StarterKit\Abstracts\BaseDataFactory;
use Illuminate\Database\Eloquent\Builder;

// Model
use App\Models\Team;

/**
 * Class TeamDataFactory
 *
 * @author James Carlo Luchavez <jamescarlo.luchavez@fligno.com>
 */
class TeamDataFactory extends BaseDataFactory
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string|null
     */
    public string|null $display_name = null;

    /**
     * @var string|null
     */
    public string|null $description = null;

    /**
     * @return Builder
     * @example User::query()
     */
    public function getBuilder(): Builder
    {
        return Team::query();
    }
}
