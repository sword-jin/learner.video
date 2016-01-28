<?php

namespace Learner\Services\Forms;

class UpdateSeriesFormService extends CreateSeriesFormService
{
    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'id', 'title', 'description', 'image'
        ]);
    }
}
