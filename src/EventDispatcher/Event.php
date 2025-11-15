<?php

declare(strict_types=1);

namespace Webware\Feature\EventDispatcher;

use PhpDb\TableGateway\Feature\EventFeatureEventsInterface as FeatureEvents;

enum Event: string
{
    case PreInitialize  = FeatureEvents::EVENT_PRE_INITIALIZE;
    case PostInitialize = FeatureEvents::EVENT_POST_INITIALIZE;

    case PreSelect  = FeatureEvents::EVENT_PRE_SELECT;
    case PostSelect = FeatureEvents::EVENT_POST_SELECT;

    case PreInsert  = FeatureEvents::EVENT_PRE_INSERT;
    case PostInsert = FeatureEvents::EVENT_POST_INSERT;

    case PreDelete   = FeatureEvents::EVENT_PRE_DELETE;
    case PostDelete  = FeatureEvents::EVENT_POST_DELETE;

    case PreUpdate  = FeatureEvents::EVENT_PRE_UPDATE;
    case PostUpdate = FeatureEvents::EVENT_POST_UPDATE;
}
