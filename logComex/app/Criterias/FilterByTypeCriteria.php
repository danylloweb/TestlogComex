<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByTypeCriteria
 * @package namespace App\Criteria;
 */
class FilterByTypeCriteria extends AppCriteria implements CriteriaInterface
{
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $type = $this->request->query->get('type');
        if ($type) {
            $model = $model->where('type', $type);
        }
        return $model;
    }
}
