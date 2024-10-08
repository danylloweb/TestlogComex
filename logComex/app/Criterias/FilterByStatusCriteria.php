<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByStatusCriteria
 * @package namespace App\Criteria;
 */
class FilterByStatusCriteria extends AppCriteria implements CriteriaInterface
{
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $status = $this->request->query->get('status');
        if ($status) {
            $status = $status == 'Ativo' ? 1 : 0;
            $model = $model->where('status', $status);
        }
        return $model;
    }
}
