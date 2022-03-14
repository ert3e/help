<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{

    private $countries = array(
        array('id' => '36','name' => 'Австралия','alpha_2' => 'au','alpha_3' => 'aus'),
        array('id' => '40','name' => 'Австрия','alpha_2' => 'at','alpha_3' => 'aut'),
        array('id' => '31','name' => 'Азербайджан','alpha_2' => 'az','alpha_3' => 'aze'),
        array('id' => '8','name' => 'Албания','alpha_2' => 'al','alpha_3' => 'alb'),
        array('id' => '12','name' => 'Алжир','alpha_2' => 'dz','alpha_3' => 'dza'),
        array('id' => '24','name' => 'Ангола','alpha_2' => 'ao','alpha_3' => 'ago'),
        array('id' => '20','name' => 'Андорра','alpha_2' => 'ad','alpha_3' => 'and'),
        array('id' => '28','name' => 'Антигуа и Барбуда','alpha_2' => 'ag','alpha_3' => 'atg'),
        array('id' => '32','name' => 'Аргентина','alpha_2' => 'ar','alpha_3' => 'arg'),
        array('id' => '51','name' => 'Армения','alpha_2' => 'am','alpha_3' => 'arm'),
        array('id' => '4','name' => 'Афганистан','alpha_2' => 'af','alpha_3' => 'afg'),
        array('id' => '44','name' => 'Багамы','alpha_2' => 'bs','alpha_3' => 'bhs'),
        array('id' => '50','name' => 'Бангладеш','alpha_2' => 'bd','alpha_3' => 'bgd'),
        array('id' => '52','name' => 'Барбадос','alpha_2' => 'bb','alpha_3' => 'brb'),
        array('id' => '48','name' => 'Бахрейн','alpha_2' => 'bh','alpha_3' => 'bhr'),
        array('id' => '84','name' => 'Белиз','alpha_2' => 'bz','alpha_3' => 'blz'),
        array('id' => '112','name' => 'Белоруссия','alpha_2' => 'by','alpha_3' => 'blr'),
        array('id' => '56','name' => 'Бельгия','alpha_2' => 'be','alpha_3' => 'bel'),
        array('id' => '204','name' => 'Бенин','alpha_2' => 'bj','alpha_3' => 'ben'),
        array('id' => '100','name' => 'Болгария','alpha_2' => 'bg','alpha_3' => 'bgr'),
        array('id' => '68','name' => 'Боливия','alpha_2' => 'bo','alpha_3' => 'bol'),
        array('id' => '70','name' => 'Босния и Герцеговина','alpha_2' => 'ba','alpha_3' => 'bih'),
        array('id' => '72','name' => 'Ботсвана','alpha_2' => 'bw','alpha_3' => 'bwa'),
        array('id' => '76','name' => 'Бразилия','alpha_2' => 'br','alpha_3' => 'bra'),
        array('id' => '96','name' => 'Бруней','alpha_2' => 'bn','alpha_3' => 'brn'),
        array('id' => '854','name' => 'Буркина-Фасо','alpha_2' => 'bf','alpha_3' => 'bfa'),
        array('id' => '108','name' => 'Бурунди','alpha_2' => 'bi','alpha_3' => 'bdi'),
        array('id' => '64','name' => 'Бутан','alpha_2' => 'bt','alpha_3' => 'btn'),
        array('id' => '548','name' => 'Вануату','alpha_2' => 'vu','alpha_3' => 'vut'),
        array('id' => '826','name' => 'Великобритания','alpha_2' => 'gb','alpha_3' => 'gbr'),
        array('id' => '348','name' => 'Венгрия','alpha_2' => 'hu','alpha_3' => 'hun'),
        array('id' => '862','name' => 'Венесуэла','alpha_2' => 've','alpha_3' => 'ven'),
        array('id' => '626','name' => 'Восточный Тимор','alpha_2' => 'tl','alpha_3' => 'tls'),
        array('id' => '704','name' => 'Вьетнам','alpha_2' => 'vn','alpha_3' => 'vnm'),
        array('id' => '266','name' => 'Габон','alpha_2' => 'ga','alpha_3' => 'gab'),
        array('id' => '332','name' => 'Гаити','alpha_2' => 'ht','alpha_3' => 'hti'),
        array('id' => '328','name' => 'Гайана','alpha_2' => 'gy','alpha_3' => 'guy'),
        array('id' => '270','name' => 'Гамбия','alpha_2' => 'gm','alpha_3' => 'gmb'),
        array('id' => '288','name' => 'Гана','alpha_2' => 'gh','alpha_3' => 'gha'),
        array('id' => '320','name' => 'Гватемала','alpha_2' => 'gt','alpha_3' => 'gtm'),
        array('id' => '324','name' => 'Гвинея','alpha_2' => 'gn','alpha_3' => 'gin'),
        array('id' => '624','name' => 'Гвинея-Бисау','alpha_2' => 'gw','alpha_3' => 'gnb'),
        array('id' => '276','name' => 'Германия','alpha_2' => 'de','alpha_3' => 'deu'),
        array('id' => '340','name' => 'Гондурас','alpha_2' => 'hn','alpha_3' => 'hnd'),
        array('id' => '308','name' => 'Гренада','alpha_2' => 'gd','alpha_3' => 'grd'),
        array('id' => '300','name' => 'Греция','alpha_2' => 'gr','alpha_3' => 'grc'),
        array('id' => '268','name' => 'Грузия','alpha_2' => 'ge','alpha_3' => 'geo'),
        array('id' => '208','name' => 'Дания','alpha_2' => 'dk','alpha_3' => 'dnk'),
        array('id' => '262','name' => 'Джибути','alpha_2' => 'dj','alpha_3' => 'dji'),
        array('id' => '212','name' => 'Доминика','alpha_2' => 'dm','alpha_3' => 'dma'),
        array('id' => '214','name' => 'Доминиканская Республика','alpha_2' => 'do','alpha_3' => 'dom'),
        array('id' => '180','name' => 'Демократическая Республика Конго','alpha_2' => 'cd','alpha_3' => 'cod'),
        array('id' => '818','name' => 'Египет','alpha_2' => 'eg','alpha_3' => 'egy'),
        array('id' => '894','name' => 'Замбия','alpha_2' => 'zm','alpha_3' => 'zmb'),
        array('id' => '716','name' => 'Зимбабве','alpha_2' => 'zw','alpha_3' => 'zwe'),
        array('id' => '376','name' => 'Израиль','alpha_2' => 'il','alpha_3' => 'isr'),
        array('id' => '356','name' => 'Индия','alpha_2' => 'in','alpha_3' => 'ind'),
        array('id' => '360','name' => 'Индонезия','alpha_2' => 'id','alpha_3' => 'idn'),
        array('id' => '400','name' => 'Иордания','alpha_2' => 'jo','alpha_3' => 'jor'),
        array('id' => '368','name' => 'Ирак','alpha_2' => 'iq','alpha_3' => 'irq'),
        array('id' => '364','name' => 'Иран','alpha_2' => 'ir','alpha_3' => 'irn'),
        array('id' => '372','name' => 'Ирландия','alpha_2' => 'ie','alpha_3' => 'irl'),
        array('id' => '352','name' => 'Исландия','alpha_2' => 'is','alpha_3' => 'isl'),
        array('id' => '724','name' => 'Испания','alpha_2' => 'es','alpha_3' => 'esp'),
        array('id' => '380','name' => 'Италия','alpha_2' => 'it','alpha_3' => 'ita'),
        array('id' => '887','name' => 'Йемен','alpha_2' => 'ye','alpha_3' => 'yem'),
        array('id' => '132','name' => 'Кабо-Верде','alpha_2' => 'cv','alpha_3' => 'cpv'),
        array('id' => '398','name' => 'Казахстан','alpha_2' => 'kz','alpha_3' => 'kaz'),
        array('id' => '116','name' => 'Камбоджа','alpha_2' => 'kh','alpha_3' => 'khm'),
        array('id' => '120','name' => 'Камерун','alpha_2' => 'cm','alpha_3' => 'cmr'),
        array('id' => '124','name' => 'Канада','alpha_2' => 'ca','alpha_3' => 'can'),
        array('id' => '634','name' => 'Катар','alpha_2' => 'qa','alpha_3' => 'qat'),
        array('id' => '404','name' => 'Кения','alpha_2' => 'ke','alpha_3' => 'ken'),
        array('id' => '196','name' => 'Кипр','alpha_2' => 'cy','alpha_3' => 'cyp'),
        array('id' => '417','name' => 'Киргизия','alpha_2' => 'kg','alpha_3' => 'kgz'),
        array('id' => '296','name' => 'Кирибати','alpha_2' => 'ki','alpha_3' => 'kir'),
        array('id' => '408','name' => 'КНДР (Корейская Народно-Демократическая Республика)','alpha_2' => 'kp','alpha_3' => 'prk'),
        array('id' => '156','name' => 'КНР (Китайская Народная Республика)','alpha_2' => 'cn','alpha_3' => 'chn'),
        array('id' => '170','name' => 'Колумбия','alpha_2' => 'co','alpha_3' => 'col'),
        array('id' => '174','name' => 'Коморы','alpha_2' => 'km','alpha_3' => 'com'),
        array('id' => '188','name' => 'Коста-Рика','alpha_2' => 'cr','alpha_3' => 'cri'),
        array('id' => '384','name' => 'Кот-д’Ивуар','alpha_2' => 'ci','alpha_3' => 'civ'),
        array('id' => '192','name' => 'Куба','alpha_2' => 'cu','alpha_3' => 'cub'),
        array('id' => '414','name' => 'Кувейт','alpha_2' => 'kw','alpha_3' => 'kwt'),
        array('id' => '418','name' => 'Лаос','alpha_2' => 'la','alpha_3' => 'lao'),
        array('id' => '428','name' => 'Латвия','alpha_2' => 'lv','alpha_3' => 'lva'),
        array('id' => '426','name' => 'Лесото','alpha_2' => 'ls','alpha_3' => 'lso'),
        array('id' => '430','name' => 'Либерия','alpha_2' => 'lr','alpha_3' => 'lbr'),
        array('id' => '422','name' => 'Ливан','alpha_2' => 'lb','alpha_3' => 'lbn'),
        array('id' => '434','name' => 'Ливия','alpha_2' => 'ly','alpha_3' => 'lby'),
        array('id' => '440','name' => 'Литва','alpha_2' => 'lt','alpha_3' => 'ltu'),
        array('id' => '438','name' => 'Лихтенштейн','alpha_2' => 'li','alpha_3' => 'lie'),
        array('id' => '442','name' => 'Люксембург','alpha_2' => 'lu','alpha_3' => 'lux'),
        array('id' => '480','name' => 'Маврикий','alpha_2' => 'mu','alpha_3' => 'mus'),
        array('id' => '478','name' => 'Мавритания','alpha_2' => 'mr','alpha_3' => 'mrt'),
        array('id' => '450','name' => 'Мадагаскар','alpha_2' => 'mg','alpha_3' => 'mdg'),
        array('id' => '807','name' => 'Македония','alpha_2' => 'mk','alpha_3' => 'mkd'),
        array('id' => '454','name' => 'Малави','alpha_2' => 'mw','alpha_3' => 'mwi'),
        array('id' => '458','name' => 'Малайзия','alpha_2' => 'my','alpha_3' => 'mys'),
        array('id' => '466','name' => 'Мали','alpha_2' => 'ml','alpha_3' => 'mli'),
        array('id' => '462','name' => 'Мальдивы','alpha_2' => 'mv','alpha_3' => 'mdv'),
        array('id' => '470','name' => 'Мальта','alpha_2' => 'mt','alpha_3' => 'mlt'),
        array('id' => '504','name' => 'Марокко','alpha_2' => 'ma','alpha_3' => 'mar'),
        array('id' => '584','name' => 'Маршалловы Острова','alpha_2' => 'mh','alpha_3' => 'mhl'),
        array('id' => '484','name' => 'Мексика','alpha_2' => 'mx','alpha_3' => 'mex'),
        array('id' => '583','name' => 'Микронезия','alpha_2' => 'fm','alpha_3' => 'fsm'),
        array('id' => '508','name' => 'Мозамбик','alpha_2' => 'mz','alpha_3' => 'moz'),
        array('id' => '498','name' => 'Молдавия','alpha_2' => 'md','alpha_3' => 'mda'),
        array('id' => '492','name' => 'Монако','alpha_2' => 'mc','alpha_3' => 'mco'),
        array('id' => '496','name' => 'Монголия','alpha_2' => 'mn','alpha_3' => 'mng'),
        array('id' => '104','name' => 'Мьянма','alpha_2' => 'mm','alpha_3' => 'mmr'),
        array('id' => '516','name' => 'Намибия','alpha_2' => 'na','alpha_3' => 'nam'),
        array('id' => '520','name' => 'Науру','alpha_2' => 'nr','alpha_3' => 'nru'),
        array('id' => '524','name' => 'Непал','alpha_2' => 'np','alpha_3' => 'npl'),
        array('id' => '562','name' => 'Нигер','alpha_2' => 'ne','alpha_3' => 'ner'),
        array('id' => '566','name' => 'Нигерия','alpha_2' => 'ng','alpha_3' => 'nga'),
        array('id' => '528','name' => 'Нидерланды','alpha_2' => 'nl','alpha_3' => 'nld'),
        array('id' => '558','name' => 'Никарагуа','alpha_2' => 'ni','alpha_3' => 'nic'),
        array('id' => '554','name' => 'Новая Зеландия','alpha_2' => 'nz','alpha_3' => 'nzl'),
        array('id' => '578','name' => 'Норвегия','alpha_2' => 'no','alpha_3' => 'nor'),
        array('id' => '784','name' => 'ОАЭ','alpha_2' => 'ae','alpha_3' => 'are'),
        array('id' => '512','name' => 'Оман','alpha_2' => 'om','alpha_3' => 'omn'),
        array('id' => '586','name' => 'Пакистан','alpha_2' => 'pk','alpha_3' => 'pak'),
        array('id' => '585','name' => 'Палау','alpha_2' => 'pw','alpha_3' => 'plw'),
        array('id' => '591','name' => 'Панама','alpha_2' => 'pa','alpha_3' => 'pan'),
        array('id' => '598','name' => 'Папуа — Новая Гвинея','alpha_2' => 'pg','alpha_3' => 'png'),
        array('id' => '600','name' => 'Парагвай','alpha_2' => 'py','alpha_3' => 'pry'),
        array('id' => '604','name' => 'Перу','alpha_2' => 'pe','alpha_3' => 'per'),
        array('id' => '616','name' => 'Польша','alpha_2' => 'pl','alpha_3' => 'pol'),
        array('id' => '620','name' => 'Португалия','alpha_2' => 'pt','alpha_3' => 'prt'),
        array('id' => '178','name' => 'Республика Конго','alpha_2' => 'cg','alpha_3' => 'cog'),
        array('id' => '410','name' => 'Республика Корея','alpha_2' => 'kr','alpha_3' => 'kor'),
        array('id' => '643','name' => 'Россия','alpha_2' => 'ru','alpha_3' => 'rus'),
        array('id' => '646','name' => 'Руанда','alpha_2' => 'rw','alpha_3' => 'rwa'),
        array('id' => '642','name' => 'Румыния','alpha_2' => 'ro','alpha_3' => 'rou'),
        array('id' => '222','name' => 'Сальвадор','alpha_2' => 'sv','alpha_3' => 'slv'),
        array('id' => '882','name' => 'Самоа','alpha_2' => 'ws','alpha_3' => 'wsm'),
        array('id' => '674','name' => 'Сан-Марино','alpha_2' => 'sm','alpha_3' => 'smr'),
        array('id' => '678','name' => 'Сан-Томе и Принсипи','alpha_2' => 'st','alpha_3' => 'stp'),
        array('id' => '682','name' => 'Саудовская Аравия','alpha_2' => 'sa','alpha_3' => 'sau'),
        array('id' => '748','name' => 'Свазиленд','alpha_2' => 'sz','alpha_3' => 'swz'),
        array('id' => '690','name' => 'Сейшельские Острова','alpha_2' => 'sc','alpha_3' => 'syc'),
        array('id' => '686','name' => 'Сенегал','alpha_2' => 'sn','alpha_3' => 'sen'),
        array('id' => '670','name' => 'Сент-Винсент и Гренадины','alpha_2' => 'vc','alpha_3' => 'vct'),
        array('id' => '659','name' => 'Сент-Китс и Невис','alpha_2' => 'kn','alpha_3' => 'kna'),
        array('id' => '662','name' => 'Сент-Люсия','alpha_2' => 'lc','alpha_3' => 'lca'),
        array('id' => '688','name' => 'Сербия','alpha_2' => 'rs','alpha_3' => 'srb'),
        array('id' => '702','name' => 'Сингапур','alpha_2' => 'sg','alpha_3' => 'sgp'),
        array('id' => '760','name' => 'Сирия','alpha_2' => 'sy','alpha_3' => 'syr'),
        array('id' => '703','name' => 'Словакия','alpha_2' => 'sk','alpha_3' => 'svk'),
        array('id' => '705','name' => 'Словения','alpha_2' => 'si','alpha_3' => 'svn'),
        array('id' => '90','name' => 'Соломоновы Острова','alpha_2' => 'sb','alpha_3' => 'slb'),
        array('id' => '706','name' => 'Сомали','alpha_2' => 'so','alpha_3' => 'som'),
        array('id' => '729','name' => 'Судан','alpha_2' => 'sd','alpha_3' => 'sdn'),
        array('id' => '740','name' => 'Суринам','alpha_2' => 'sr','alpha_3' => 'sur'),
        array('id' => '840','name' => 'США','alpha_2' => 'us','alpha_3' => 'usa'),
        array('id' => '694','name' => 'Сьерра-Леоне','alpha_2' => 'sl','alpha_3' => 'sle'),
        array('id' => '762','name' => 'Таджикистан','alpha_2' => 'tj','alpha_3' => 'tjk'),
        array('id' => '764','name' => 'Таиланд','alpha_2' => 'th','alpha_3' => 'tha'),
        array('id' => '834','name' => 'Танзания','alpha_2' => 'tz','alpha_3' => 'tza'),
        array('id' => '768','name' => 'Того','alpha_2' => 'tg','alpha_3' => 'tgo'),
        array('id' => '776','name' => 'Тонга','alpha_2' => 'to','alpha_3' => 'ton'),
        array('id' => '780','name' => 'Тринидад и Тобаго','alpha_2' => 'tt','alpha_3' => 'tto'),
        array('id' => '798','name' => 'Тувалу','alpha_2' => 'tv','alpha_3' => 'tuv'),
        array('id' => '788','name' => 'Тунис','alpha_2' => 'tn','alpha_3' => 'tun'),
        array('id' => '795','name' => 'Туркмения','alpha_2' => 'tm','alpha_3' => 'tkm'),
        array('id' => '792','name' => 'Турция','alpha_2' => 'tr','alpha_3' => 'tur'),
        array('id' => '800','name' => 'Уганда','alpha_2' => 'ug','alpha_3' => 'uga'),
        array('id' => '860','name' => 'Узбекистан','alpha_2' => 'uz','alpha_3' => 'uzb'),
        array('id' => '804','name' => 'Украина','alpha_2' => 'ua','alpha_3' => 'ukr'),
        array('id' => '858','name' => 'Уругвай','alpha_2' => 'uy','alpha_3' => 'ury'),
        array('id' => '242','name' => 'Фиджи','alpha_2' => 'fj','alpha_3' => 'fji'),
        array('id' => '608','name' => 'Филиппины','alpha_2' => 'ph','alpha_3' => 'phl'),
        array('id' => '246','name' => 'Финляндия','alpha_2' => 'fi','alpha_3' => 'fin'),
        array('id' => '250','name' => 'Франция','alpha_2' => 'fr','alpha_3' => 'fra'),
        array('id' => '191','name' => 'Хорватия','alpha_2' => 'hr','alpha_3' => 'hrv'),
        array('id' => '140','name' => 'ЦАР','alpha_2' => 'cf','alpha_3' => 'caf'),
        array('id' => '148','name' => 'Чад','alpha_2' => 'td','alpha_3' => 'tcd'),
        array('id' => '499','name' => 'Черногория','alpha_2' => 'me','alpha_3' => 'mne'),
        array('id' => '203','name' => 'Чехия','alpha_2' => 'cz','alpha_3' => 'cze'),
        array('id' => '152','name' => 'Чили','alpha_2' => 'cl','alpha_3' => 'chl'),
        array('id' => '756','name' => 'Швейцария','alpha_2' => 'ch','alpha_3' => 'che'),
        array('id' => '752','name' => 'Швеция','alpha_2' => 'se','alpha_3' => 'swe'),
        array('id' => '144','name' => 'Шри-Ланка','alpha_2' => 'lk','alpha_3' => 'lka'),
        array('id' => '218','name' => 'Эквадор','alpha_2' => 'ec','alpha_3' => 'ecu'),
        array('id' => '226','name' => 'Экваториальная Гвинея','alpha_2' => 'gq','alpha_3' => 'gnq'),
        array('id' => '232','name' => 'Эритрея','alpha_2' => 'er','alpha_3' => 'eri'),
        array('id' => '233','name' => 'Эстония','alpha_2' => 'ee','alpha_3' => 'est'),
        array('id' => '231','name' => 'Эфиопия','alpha_2' => 'et','alpha_3' => 'eth'),
        array('id' => '710','name' => 'ЮАР','alpha_2' => 'za','alpha_3' => 'zaf'),
        array('id' => '728','name' => 'Южный Судан','alpha_2' => 'ss','alpha_3' => 'ssd'),
        array('id' => '388','name' => 'Ямайка','alpha_2' => 'jm','alpha_3' => 'jam'),
        array('id' => '392','name' => 'Япония','alpha_2' => 'jp','alpha_3' => 'jpn')
    );


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->countries as $country) {
            \App\Models\Country::create($country);
        }
    }
}
