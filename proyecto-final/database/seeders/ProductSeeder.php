<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product= new Product([
            
            'imagePath'=>'https://resources.sears.com.mx/medios-plazavip/fotos/productos_sears1/original/2558756.jpg',
            'title'=>'Boxer algodon',
            'description'=>'Boxer 100% de algodon',
            'price'=>80
        ]);
        $product->save();
        $product= new Product([
            
            'imagePath'=>'https://www.chedraui.com.mx/medias/7500503299930-00-CH515Wx515H?context=bWFzdGVyfHJvb3R8Mjg5MjZ8aW1hZ2UvanBlZ3xoODUvaGJlLzEwOTgwNDY0MDY2NTkwLmpwZ3wyMzJhNjE0MmFmM2Q5OTMzNDU4YWJiZjZmZTA3MmQzMTNmYThjZDNiM2Q4NDE0MDYyYmJjOGI3MmU5ZDk5NmI2',
            'title'=>'Bikini',
            'description'=>'Bikini para caballero con resorte externo',
            'price'=>50
        ]);
        $product->save();
        $product= new Product([
            
            'imagePath'=>'https://secretwear.es/516-large_default/boxer-caballero-tela-guasch-blanco.jpg',
            'title'=>'Boxer',
            'description'=>'Boxer holgado de poliéster con algodon',
            'price'=>70
        ]);
        $product->save();
        $product= new Product([
           
            'imagePath'=>'https://uniformes.com.mx/1270-superlarge_default/ifs-tin-deportivo-unisex.jpg',
            'title'=>'Tines',
            'description'=>'Tines deportivos blancos',
            'price'=>20
        ]);
        $product->save();
        $product= new Product([
           
            'imagePath'=>'https://m.media-amazon.com/images/I/71323eM0MCL._AC_SX425_.jpg',
            'title'=>'Calcetines',
            'description'=>'calcetines de vestir paquete de 5 pares',
            'price'=>100
        ]);
        $product->save();
    }
}
