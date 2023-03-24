## 1.7 Migration

    php artisan make:migration create_bbs_table --create=bbs

Вручную подготовка миграции и запуск

    php artisan migrate


## 1.8. Модели

    php artisan make:model Bb


## 1.10 Работа с tinker

Запустить тинкер

    php artisan tinker

Создать объект

    use App\Models\Bb;
    $bb = new Bb(); 

Заполнить и сохранить объект в БД

    $bb->title = 'Шкаф';
    $bb->content = 'Совсем новый, полированный, двухстворчатый'; 
    $bb->price = 2000; 

    $bb->save();

Создать новые объекты

    $bb = $bb->create(['title' => 'Пылесос',
      'content' => 'Старый, ржавый, без шланга', 'price' => 1000]); 

    $bb = Bb::create(['title' => 'Грузовик', 
      'content' => 'Грузоподъемность - 5 т', 'price' => 10000000]);

    $bb = Bb::create(['title' => 'Снег', 'content' => 'Прошлогодний', 'price' => 50]);

Показать объект по id

    $bb = Bb::find(2);
    echo $bb->title, ' | ', $bb->content, ' | ', $bb->price; 

Изменить свойство и сохранить в БД 

    $bb->price = 500; 
    $bb->save();

Показать все объекты отсортированными

    $bbs = Bb::orderBy('price')->get();

Посмотреть объекты через цикл

    foreach ($bbs as $bb) { 
        echo $bb->title, ' | ', $bb->content, ' | ', $bb->price, "\r\n"; 
    }

Показ сортировки в обратной хронологии (latest)

    $bbs = Bb::where('price', '>', 1000)->latest()->get(); 

    foreach ($bbs as $bb) {
        echo $bb->title, ' | ', $bb->created_at, "\r\n"; 
    }

Удалить запись

    $bb = Bb::where('title', 'Снег')->first();
    $bb->delete();

    