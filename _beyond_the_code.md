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

## 2.1 Откат миграции и создание связей между таблицами

Удаляет цепочку миграции и таблицу bbs. Файл миграции остаётся.

    php artisan migrate:rollback --step=1

После внесения изменений в файл миграции, команда

    php artisan migrate

Работа с тинкер.

Создание пользователя в таблице user.

    > use Illuminate\Support\Facades\Hash;
    > use App\Models\User;
    > $user = User::create(['name' => 'admin', 'email' => 'admin@bboard.ru', 'password' => Hash::make('admin')]);

User::create сразу сохраняет данные в БД в users.

Новая запись в таблицу bbs.

    > use App\Models\Bb; 
    > $bb = new Bb(); 
    > $bb->title = 'Пылесос'; 
    > $bb->content = 'Старый, ржавый, без шланга'; 
    > $bb->price = 500; 
    > $user->bbs()->save($bb);

Через ранее заданный объект $user будет создана и сохранена в БД связь с текущим значением user_id.

Создание связи и сразу создание записи в таблицу bbs.

    $user->bbs()->create(['title' => 'Грузовик', 'content' => 'Грузоподъемность - 5 т', 'price' => 10000000]); 

Добавим третье объявление — третьим способом: 

    > $bb = new Bb(['title' => 'Шкаф', 
    .   'content' => 'Совсем новый, полированный, двухстворчатый', 
    .   'price' => 1000]); 

Так создаётся объект bb (в БД он пока не добавляется), который теперь можно связать с юзер и сохранить так.

    > $bb->user()->associate($user); 
    > $bb->save(); 

Вывод данных в консоль

    foreach (Bb::all() as $bb) { 
      $user = $bb->user;
      echo $bb->title, ' | ', $user->name, ' | ', $bb->price, "\r\n"; 
    }

Вывод всех объявлений, оставленных пользователем admin

    $user = User::where('name' ,'admin')->first();
    foreach ($user->bbs as $bb) { echo $bb->title, ' '; }

Свойство bbs пользователя хранит список связанных объявлений.
