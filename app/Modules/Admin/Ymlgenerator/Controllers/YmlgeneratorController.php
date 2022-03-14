<?php

namespace App\Modules\Admin\Ymlgenerator\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Models\CategoryBase;
use App\Models\PickingBase;
use Illuminate\Support\Facades\URL;
use notdest\yandexYmlGenerator\ymlDocument;

class YmlgeneratorController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Ymlgenerator.title'));
    }

    public function index()
    {

        return view('ymlgenerator.index');
    }

    public function generate()
    {
        set_time_limit(0);
        ini_set('max_execution_time', '900');
        ini_set('max_execution_time', '0');

        $y = new ymlDocument(setting('main.meta_title'), setting('main.meta_description'));

        $y->url(\URL::to('/'));

        $y->currency('RUR', 1);

        foreach (CategoryBase::all() as $category) {
            $y->category($category->id, $category->title, (isset($category->parent) ? $category->parent->id : false));
        }

        foreach (PickingBase::all() as $product) {

            $offer = $y->simple($product->title, $product->id, (int)$product->price, "RUR", $product->category ? $product->category->id : 1);


            /*
            ->vendor(Product::$brands[$product->brand_id]) //      Производитель
            ->dimensions((float)$product->length,(float)$product->width,(float)$product->height) // длина, ширина и высота в сантиметрах
            $images = glob('content/products/'.$product['id'].'/original*.{jpg,JPG,png,PNG}', GLOB_BRACE);
            foreach ($images as $image) {
                $offer->pic(\URL::to($image));
            }*/

            $offer
            ->vendorCode($product->article)                                                      // Код производителя для данного товара.
            //->url(\URL::to(route('catalog-show', $product->path)))                             // условно обязательный. URL страницы товара
            ->url('/')                                                                           // условно обязательный. URL страницы товара
            ->delivery()                                                                         // Возможно доставить
            ->pickup()                                                                           // Возможен самовывоз
            ->description($product->description, true)                                           // Описание товара
            ->warranty()                                                                         // manufacturer_warranty Официальная гарантия производителя.
            ->origin('Россия')                                                                   // country_of_origin. страна производитель из списка Яндекса. Иногда желательно указывать
            ->cpa(true)                                                                          // нельзя сделать "Заказ на Маркете"
            ->weight(round((int)$product->weight / 1000, 0))                       // Вес товара в килограммах с учетом упаковки.
            ->downloadable();                                                                    // можно скачать

            if (!in_array($product->price_old, ['0', ''])) {
                $offer->oldprice((int)$product->price_old);                                      // старая цена
            }

            foreach($product->images as $image) {
                $imageUrl = $product->getImageUrl($image);
                if ($imageUrl) {
                    $offer->pic(URL::to($imageUrl));
                }
            }
        }

        unset($y);

        return redirect()
            ->back()
            ->with('message_success', 'Каталог успешно сгенерирован');
    }

}
