<?php

namespace App\Http\Controllers;



class XmlToCsvController extends Controller
{
    public function export()
    {
        $url = "https://it-delta.ru/local/docs/yandex_not_sku.xml";

        // Открываем XML по ссылке
        $xml = simplexml_load_file($url);

        if ($xml === false) {
            return response()->json(['message' => 'Не удалось открыть XML'], 500);
        }

       
        $csvFileName = storage_path('app/offers.csv');
        $csvFile = fopen($csvFileName, "w");

        // Заголовки столбцов
        fputcsv($csvFile, ["Категория", "Название товара", "Ссылка", "Цена", "Описание", "Страна"]);

        // Создаем массив с названиями категорий
        $categories = [];
        foreach ($xml->shop->categories->category as $category) {
            $categories[(string) $category['id']] = (string) $category;
        }

        $offers = $xml->shop->offers;
        $counter = 0;

        foreach ($offers->offer as $offer) {
            if ($counter >= 10) {
                break; // Останавливаемся после 10 товаров
            }

            // Вытаскиваем данные о товаре
            $url = (string) $offer->url;
            $price = (string) $offer->price;
            $categoryId = (string) $offer->categoryId;
            $name = (string) $offer->name;
            $description = (string) $offer->description;
            $country_of_origin = (string) $offer->country_of_origin;

            // Заменяем id категории ее названием
            $categoryName = isset($categories[$categoryId]) ? $categories[$categoryId] : "Неизвестно";

            // Записываем данные в CSV
            fputcsv($csvFile, [$categoryName, $name, $url, $price, $description, $country_of_origin]);

            $counter++;
        }

        fclose($csvFile);

        // Возвращаем ссылку на скачивание файла
        return response()->download($csvFileName);
    }
}
