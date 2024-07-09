<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Criterias\FilterByPriceCriteria;
use App\Criterias\FilterByStatusCriteria;
use App\Criterias\FilterByTypeCriteria;
use App\Criterias\FilterByWarrantyCriteria;
use App\Repositories\ProductRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * PatientService
 */
class PatientService extends AppService
{
    protected $repository;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param int $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function all(int $limit = 20)
    {
        return $this->repository
            ->resetCriteria()
            ->pushCriteria(app(FilterByWarrantyCriteria::class))
            ->pushCriteria(app(FilterByPriceCriteria::class))
            ->pushCriteria(app(FilterByTypeCriteria::class))
            ->pushCriteria(app(FilterByStatusCriteria::class))
            ->pushCriteria(app(AppRequestCriteria::class))
            ->paginate($limit);
    }

}
