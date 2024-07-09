<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Product;

/**
 * Class ProductTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{
    /**
     * Transform the Product entity.
     *
     * @param \App\Entities\Product $model
     *
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id'          => (int) $model->id,
            'name'        => $model->name,
            'description' => $model->description,
            'price'       => $model->price,
            'price_formated' => "R$".number_format($model->price,2,',','.'),
            'status'      => $model->status,
            'status_title'=> $model->status == 1 ? 'Ativo':'Inativo',
            'type_title'  => $model->type,
            'type'        => $model->type,
            'warranty'    => $model->warranty == 0 ? 'Sem garantia':$model->warranty.' ano(s)',
            'created_at'  => $model->created_at->toDateTimeString(),
            'updated_at'  => $model->updated_at->toDateTimeString()
        ];
    }
}
