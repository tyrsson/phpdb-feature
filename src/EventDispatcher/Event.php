<?php

declare(strict_types=1);

namespace Webware\Feature\EventDispatcher;

enum Event: string
{
    case PreInitialize  = 'preInitialize';
    case PostInitialize = 'postInitialize';

    case PreSelect  = 'preSelect';
    case PostSelect = 'postSelect';

    case PreInsert  = 'preInsert';
    case PostInsert = 'postInsert';

    case PreDelete   = 'preDelete';
    case PostDelete  = 'postDelete';

    case PreUpdate  = 'preUpdate';
    case PostUpdate = 'postUpdate';
}
