<?php

namespace fpcm\modules\nkorg\example\events\article;

final class getByCondition extends \fpcm\modules\nkorg\example\events\eventBase {

    public function run()
    {
        return $this->data;
    }

}