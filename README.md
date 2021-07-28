> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/CREATE_DATABASE_CurrencyConverter#L2
> 
> убирай закоментированный код из репозиториев. так же можно добавить if not exists при удалении что бы небыло ошибки если базы нету
> зачем эти команды здесь?

> > **команды для удобного создания и использования базы и таблиц (чтобы тебе не пришлось писать все самому)**

> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/CREATE_DATABASE_CurrencyConverter#L6-L10
> 
> 
> зачем SHOW?
>> **чтобы ты видел что создается**

> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/CREATE_DATABASE_CurrencyConverter#L15-L26
> 
> 
> объясни зачем нужно каждое из полей
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/history.php#L2
> 

-  checked_value — проверяемое значение 
-  checked_r030 — проверяемый номер валюты
-  checked_txt — проверяемое название валюты
-  checked_rate — курс проверяемой валюты относительно гривне
-  checked_cc — проверяемый код валюты
-  checked_exchangedate — дата последнее обновления курса валют
-  received_value — полученное значение 
-  received_r030 — номер переведенной валюты
-  received_txt — название переведенной валюты
-  received_rate — курс переведенной валюты относительно гривне
-  received_cc — полученный код валюты
-  received_exchangedate — дата конвертации

> 
> убирай это, когда кидаешь на проверку. эти настройки нужны только для разработки
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/history.php#L5
> 
> 
> почитай про composer и его автозагрузку. и используй ее
> думаю в проекте должен быть только один require_once и это подключение автозагрузчика композера
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/history.php#L7
> 
> 
> выработай у себя привычку писать имена переменных полностью и понятно. почитай книгу или выжимку "Чистый код" Роберта Мартина
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/history.php#L12
> 
> 
> пиши переменные/методы в одном стиле или $camelCase или $snake_case
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/history.php#L15
> 
> 
> почему у тебя скрипт с именем hystory занимается конвертацией? по названию логичнее предположить что он для отображения истории. нужно выбрать другое имя или я не что то не понял?
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/history.php#L19
> 
> 
> убирай коментарии
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/history.php#L20
> 
> 
> это контроллер должен делать
>>  **тут не понял**
>> **перенаправлять страницу должен контроллер?**

> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L2

> 
> 
> убирай
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L9
> 
> 
> коментарии удаляй
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L11
> 
> 
> полностью имя
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L14
> 
> 
> неплохое название, понятно что делает. лайк
> > **я как раз думал, что не очень, слишком длинное** 
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L57
> 
> 
> почему свитч только на один случай? думаю тут if подойдет
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L86-L88
> 
> 
> посмотри про альтернативный синтаксис для вьюх. как п омне он симпатичнее
> типа
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L122
> 
> 
> приучи себя сразу использовать DateTimeImmutable. он безопаснее т.к. объект не будет изменятся
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L126
> 
> 
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L133
> 
> 
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L166
> 
> 
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L171
> 
> 
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L183
> 
> 
> имя переменной
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/index.php#L195
> 
> 
> пустой цикл
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/setting.php#L3
> 
> 
> убирай
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/setting.php#L24-L26
> 
> 
> имена
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/setting.php#L32
> 
> 
> это в контроллер вынести
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L1
> 
> 
> приучи себя добавлять сразу директивку strict_types
> ` declare(strict_types=1);`
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L6
> 
> 
> я б убрал из имени Controller. он и так лежит в директории с таким именем.
> И сразу приучи себя использовать неймспейсы. именуй их по стандартам https://www.php-fig.org/psr/psr-1/ и https://www.php-fig.org/psr/psr-2/. можешь найти рус версию
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L8
> 
> 
> этому место в репозитории
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L25
> 
> 
> имя метода мне не нравится. есть стандартная функция с таким именем. + этто метод еще и делает запрос на апи
> и добавляй везде в методых return type - тип возвращаемого значения везде где есть return
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L35
> 
> 
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L40
> 
> 
> добавляй везде типы аргументов(тайпхинты) везде где есть аргументы
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L37
> 
> 
> а зачем это через контроллер делать? контроллер должен принимать запрос на страницу и обрабатывать весь запрос сразу и каждый метод контроллера должен обрабатывать запрос или быть приватным
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L50
> 
> 
> именуй одинаково методы у тебя без заглавной буквы вначале
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L52
> 
> 
> имя переменной
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L95
> 
> 
> это не обязанность контроллера что то там подсвечивать
> https://github.com/OlegBNK/CurrencyConverter/blob/d238428c7190ac7eeb611ab4a4229d6d59117aff/Controller/CurrencyController.php#L105
> 
> 
> почему у тебя return true?
> Позже продолжу ревью

