<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByPriceCriteria
 * @package namespace App\Criteria;
 */
class FilterByPriceCriteria extends AppCriteria implements CriteriaInterface
{
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $price_min = $this->request->query->get('price_min');
        $price_max = $this->request->query->get('price_max');
        if ($price_min) {
            $model = $model->where('price','>=', $price_min);
        }
        if ($price_max) {
            $model = $model->where('price','<=', $price_max);
        }
        return $model;
    }
}
