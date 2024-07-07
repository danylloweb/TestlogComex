<?php

namespace App\Repositories;

use App\Presenters\ProductPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductRepository;
use App\Entities\Product;
use App\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends AppRepository implements ProductRepository
{

    protected $fieldSearchable = [
        'name'          => 'like',
        'description'   => 'like',
    ];

    /**
     * Regras para busca
     *
     * @var array
     */
    protected $fieldsRules = [
        'name'           => ['string', 'max:18'],
        'description'    => ['string', 'max:150'],
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return ProductValidator::class;
    }

    /**
     * @return string
     */
   public function presenter()
   {
       return ProductPresenter::class;
   }

}
