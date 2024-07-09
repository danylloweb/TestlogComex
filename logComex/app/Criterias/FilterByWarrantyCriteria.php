<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByWarrantyCriteria
 * @package namespace App\Criteria;
 */
class FilterByWarrantyCriteria extends AppCriteria implements CriteriaInterface
{
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $warranty = $this->request->query->get('warranty');
        if ($warranty) {
            if ($warranty == "Sem garantia"){
                $warranty = 0;
            }elseif ($warranty == "Um ano") {
                $warranty = 1;
            }else{
                $warranty = 2;
            }
            $model = $model->where('warranty', $warranty);
        }
        return $model;
    }
}
