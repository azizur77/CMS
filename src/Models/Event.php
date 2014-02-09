<?php

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\Core\Models\AbstractModel;
use GrahamCampbell\Core\Models\Interfaces\DateModelInterface;
use GrahamCampbell\Core\Models\Common\DateModelTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\BelongsToUserInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\BelongsToUserTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\BelongsToManyUsersInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\BelongsToManyUsersTrait;

/**
 * This is the event model class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class Event extends AbstractModel implements DateModelInterface, BelongsToUserInterface, BelongsToManyUsersInterface
{
    use DateModelTrait, BelongsToUserTrait, BelongsToManyUsersTrait;

    /**
     * The table the events are stored in.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'event';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'date');

    /**
     * The max events per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 10;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'date';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * The event validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'    => 'required',
        'location' => 'required',
        'date'     => 'required',
        'body'     => 'required',
        'user_id'  => 'required'
    );

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        $this->invites()->sync(array());
    }
}
